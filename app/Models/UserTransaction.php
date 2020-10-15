<?php

namespace App\Models;

    use App\Classes\BitcoinAPI;
    use App\Models\Bonus;
    use App\Models\Setting;
    use App\Models\User;
    use Denpa\Bitcoin\Client as BitcoinClient;
    use Illuminate\Database\Eloquent\Model;

    class UserTransaction extends Model
    {
        protected $table = 'users_transactions';

        protected $fillable = [
            'user_id', 'wallet', 'txids', 'confirmations', 'status', 'amount', 'amount_cent', 'payment_method',
        ];

        public static function getById($id)
        {
            return self::where('id', $id)->first();
        }

        public function getFormattedAmount()
        {
            if (strtolower($this->getPaymentMethod()) == 'btc') {
                return $this->getFormattedBTC().' ('.$this->getFormattedPrice().')';
            }

            return $this->getFormattedPrice();
        }

        public function getFormattedBTC()
        {
            return number_format($this->amount / 100000, 5, ',', '.').' BTC';
        }

        public function getFormattedPrice()
        {
            return number_format($this->amount_cent / 100, 2, ',', '.').' '.Setting::getShopCurrency();
        }

        public function isPaid()
        {
            return strtolower($this->status) == 'paid';
        }

        public function isPending()
        {
            return strtolower($this->status) == 'pending';
        }

        public function isWaiting()
        {
            return strtolower($this->status) == 'waiting';
        }

        public function getPaymentMethod()
        {
            return strtolower($this->payment_method);
        }

        public function getUsername()
        {
            $name = '-/-';

            $user = User::where('id', $this->user_id)->get()->first();

            if ($user != null) {
                $name = $user->username;
            }

            return $name;
        }

        public function getDate()
        {
            return $this->created_at->format('d.m.Y');
        }

        public function updateWhenPaidBtc()
        {
            if (strlen($this->wallet) && $this->isWaiting()) {
                $bitcoind = BitcoinAPI::getBitcoinClient();
                $receivedInfo = $bitcoind->listreceivedbyaddress(0, true, true, (string) decrypt($this->wallet))[0];

                $rAmount = $receivedInfo['amount'];
                if ($rAmount > 0) {
                    $txIDs = $receivedInfo['txids'];

                    $amountCent = intval(BitcoinAPI::convertBtc($rAmount) * floatval(Setting::get('shop.bonus_in_percent', '1')));

                    $bonuses = Bonus::orderByDESC('min_amount')->get();

                    foreach ($bonuses as $bonus) {
                        if ($amountCent >= $bonus->min_amount) {
                            $amountCent = $amountCent * floatval($bonus->percent);
                            break;
                        }
                    }

                    $this->update([
                        'status' => 'pending',
                        'amount' => intval($rAmount * 100000),
                        'amount_cent' => intval($amountCent),
                        'txid' => encrypt(implode(',', $txIDs)),
                    ]);

                    return true;
                }
            } elseif (strlen($this->wallet) > 0 && $this->isPending()) {
                $bitcoind = BitcoinAPI::getBitcoinClient();
                $receivedInfo = $bitcoind->listreceivedbyaddress(Setting::get('shop.btc_confirms_needed'), true, true, (string) decrypt($this->wallet))[0];

                $rAmount = $receivedInfo['amount'];
                if ($rAmount > 0) {
                    $this->update([
                        'status' => 'paid',
                    ]);

                    $user = User::where('id', $this->user_id)->get()->first();

                    if ($user != null) {
                        $balance_in_cent = $user->balance_in_cent;

                        $user->update([
                            'balance_in_cent' => $balance_in_cent + $this->amount_cent,
                        ]);
                    }

                    return true;
                }
            }

            return false;
        }
    }

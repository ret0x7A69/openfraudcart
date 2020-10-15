<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Notification extends Model
    {
        protected $table = 'notifications';

        protected $fillable = [
            'custom_id', 'extra_data', 'type', 'readed',
        ];

        public static function getById($id)
        {
            return self::where('id', $id)->first();
        }

        public static function getByType($type)
        {
            return self::where('type', $type)->first();
        }

        public function isReaded()
        {
            return strtolower($this->readed) == 'true';
        }

        public function getIcon()
        {
            $icon = 'flaticon-bell-1';

            if (strtolower($this->type) == 'order') {
                $icon = 'flaticon-time-2';
            } elseif (strtolower($this->type) == 'user') {
                $icon = 'flaticon-users';
            }

            return $icon;
        }

        public function getMessage()
        {
            $message = '-/-';

            if (strtolower($this->type) == 'order') {
                $message = __('backend/main.notifications.order.message', [
                    'user' => $this->getUser(),
                ]);
            } elseif (strtolower($this->type) == 'user') {
                $message = __('backend/main.notifications.user.message', [
                    'user' => $this->getUser(),
                ]);
            }

            return $message;
        }

        public function getUser()
        {
            $name = 'UNKNOWN';

            $user = User::where('id', $this->custom_id)->get()->first();

            if ($user != null) {
                $name = $user->username;
            }

            return $name;
        }
    }

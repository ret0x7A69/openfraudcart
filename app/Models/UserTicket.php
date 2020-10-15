<?php

namespace App\Models;

    use App\Models\User;
    use App\Models\UserTicketCategory;
    use App\Models\UserTicketReply;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Auth;

    class UserTicket extends Model
    {
        protected $table = 'users_tickets';

        protected $fillable = [
            'user_id', 'category_id', 'content', 'subject', 'status',
        ];

        public static function getById($id)
        {
            return self::where('id', $id)->first();
        }

        public static function getOpenTicketsCountByUserId($user_id)
        {
            return self::where('user_id', $user_id)->where('status', 'open')->count();
        }

        public function getCategory()
        {
            $ticketCategory = UserTicketCategory::where('id', $this->category_id)->first();

            if ($ticketCategory != null) {
                return $ticketCategory;
            }

            return (object) [
                'name' => __('frontend/user.tickets.no_category'),
                'slug' => 'no-category',
            ];
        }

        public function getUser()
        {
            $name = '-/-';

            $user = User::where('id', $this->user_id)->get()->first();

            if ($user != null) {
                $name = $user->username;
            }

            return (object) [
                'name' => $name,
                'username' => $name,
            ];
        }

        public function getDate()
        {
            return $this->created_at->format('d.m.Y');
        }

        public function getDateTime()
        {
            return $this->created_at->format('d.m.Y H:i');
        }

        public function isOpen()
        {
            return strtolower($this->status) != 'closed';
        }

        public function isClosed()
        {
            return strtolower($this->status) == 'closed';
        }

        public function isReplied()
        {
            return $this->getLastReply() != null && $this->getLastReply()->user_id != Auth::user()->id;
        }

        public function getLastReply()
        {
            $ticketReply = UserTicketReply::where('ticket_id', $this->id)->orderByDesc('created_at')->get()->first();

            return $ticketReply;
        }
    }

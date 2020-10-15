<?php

namespace App\Models;

    use App\Models\User;
    use Illuminate\Database\Eloquent\Model;

    class UserTicketReply extends Model
    {
        protected $table = 'users_tickets_replies';

        protected $fillable = [
            'user_id', 'ticket_id', 'content',
        ];

        public static function getById($id)
        {
            return self::where('id', $id)->first();
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
            ];
        }

        public function getDateTime()
        {
            return $this->created_at->format('d.m.Y H:i');
        }
    }

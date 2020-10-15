<?php

namespace App\Http\Controllers\Backend\API;

    use App\Http\Controllers\Controller;
    use App\Models\Notification;
    use App\Models\User;
    use App\Models\UserOrder;
    use App\Models\UserTicket;
    use Auth;

    class JSONController extends Controller
    {
        public function __construct()
        {
        }

        public function getRecentOrders()
        {
            if (! Auth::user() || ! Auth::user()->hasPermission('access_backend')) {
                return response()->json([
                    'error' => true,
                ]);
            }

            $userOrders = UserOrder::orderByDesc('created_at')->limit(10)->get()->all();

            $response = [
                'meta' => [
                    'page' => 1,
                    'pages' => 1,
                    'perpage' => -1,
                    'total' => count($userOrders),
                    'sort' => 'asc',
                    'field' => 'RecordID',
                ],
                'data' => [],
            ];

            foreach ($userOrders as $userOrder) {
                $userOrderName = 'UNKNOWN';
                $userOrderCustomer = User::where('id', $userOrder->user_id)->get()->first();

                if ($userOrderCustomer != null) {
                    $userOrderName = $userOrderCustomer->username;
                }

                $response['data'][] = [
                    'id' => $userOrder->id,
                    'customer_name' => $userOrderName,
                    'price' => $userOrder->getFormattedPrice(),
                    'hire_date' => $userOrder->created_at->format('d.m.Y H:i'),
                    'product' => strlen($userOrder->name) > 0 ? $userOrder->name : 'UNKNOWN',
                ];
            }

            return response()->json($response);
        }

        public function getNotifications()
        {
            if (! Auth::user() || ! Auth::user()->hasPermission('access_backend')) {
                return response()->json([
                    'error' => true,
                ]);
            }

            $notifications = Notification::where('readed', 'false')->orderByDesc('created_at')->limit(25)->get()->all();

            $response = [
                'notifications' => [],
            ];

            foreach ($notifications as $notification) {
                $response['notifications'][] = [
                    'message' => $notification->getMessage(),
                    'icon' => $notification->getIcon(),
                    'datetime' => $notification->created_at->format('d.m.Y H:i'),
                ];

                $notification->update([
                    'readed' => 'true',
                ]);
            }

            return response()->json($response);
        }

        public function getRecentTickets()
        {
            if (! Auth::user() || ! Auth::user()->hasPermission('access_backend')) {
                return response()->json([
                    'error' => true,
                ]);
            }

            $userTickets = UserTicket::orderByDesc('created_at')->limit(10)->get()->all();

            $response = [
                'meta' => [
                    'page' => 1,
                    'pages' => 1,
                    'perpage' => -1,
                    'total' => count($userTickets),
                    'sort' => 'asc',
                    'field' => 'RecordID',
                ],
                'data' => [],
            ];

            foreach ($userTickets as $userTicket) {
                $userTicketUsername = 'UNKNOWN';
                $userTicketUser = User::where('id', $userTicket->user_id)->get()->first();

                if ($userTicketUser != null) {
                    $userTicketUsername = $userTicketUser->username;
                }

                if ($userTicket->isClosed()) {
                    $userTicketStatus = 'closed';
                } elseif ($userTicket->isReplied()) {
                    $userTicketStatus = 'replied';
                } else {
                    $userTicketStatus = 'open';
                }

                $response['data'][] = [
                    'id' => $userTicket->id,
                    'user' => $userTicketUsername,
                    'status' => $userTicketStatus,
                    'url' => route('backend-management-ticket-edit', $userTicket->id),
                    'subject' => substr(htmlspecialchars($userTicket->subject), 0, 255),
                    'hire_date' => $userTicket->created_at->format('d.m.Y H:i'),
                ];
            }

            return response()->json($response);
        }
    }

<?php

namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use App\Models\Notification;
    use Illuminate\Http\Request;

    class NotificationsController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
        }

        public function deleteAllNotifications()
        {
            Notification::truncate();

            return redirect()->route('backend-notifications');
        }

        public function deleteNotification($id)
        {
            Notification::where('id', $id)->delete();

            return redirect()->route('backend-notifications');
        }

        public function showNotificationsPage(Request $request, $pageNumber = 0)
        {
            $notifications = Notification::orderByDesc('created_at')->paginate(10, ['*'], 'page', $pageNumber);

            if ($pageNumber > $notifications->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-notifications-with-pageNumber', 1);
            }

            return view('backend.notifications.list', [
                'notifications' => $notifications,
            ]);
        }
    }

<?php

namespace App\Http\Controllers\Backend\Management;

    use App\Http\Controllers\Controller;
    use App\Models\User;
    use App\Models\UserOrder;
    use App\Models\UserPermission;
    use App\Models\UserTicket;
    use Auth;
    use Illuminate\Http\Request;
    use Validator;

    class UsersController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:manage_users');
        }

        public function loginAsUser($id)
        {
            if (User::where('id', $id)->exists()) {
                Auth::loginUsingId($id, true);

                return redirect()->route('shop');
            }

            return redirect()->route('backend-management-users');
        }

        public function deleteUser($id)
        {
            User::where('id', $id)->delete();

            return redirect()->route('backend-management-users');
        }

        public function updateUserPermissionsForm(Request $request)
        {
            if (! Auth::user()->hasPermission('manage_users_permissions')) {
                return redirect()->route('no-permissions');
            }

            if ($request->getMethod() == 'POST') {
                if ($request->get('user_edit_id')) {
                    $user = User::where('id', $request->input('user_edit_id'))->get()->first();

                    if ($user != null) {
                        $validator = Validator::make($request->all(), [
                            'user_edit_permissions' => 'array',
                        ]);

                        if (! $validator->fails()) {
                            $perms = $request->input('user_edit_permissions');

                            UserPermission::where('user_id', $user->id)->delete();
                            if ($perms != null) {
                                foreach ($perms as $permId) {
                                    UserPermission::create([
                                        'user_id' => $user->id,
                                        'permission_id' => $permId,
                                    ]);
                                }
                            }

                            return redirect()->route('backend-management-user-edit', $user->id)->with([
                                'successMessage' => __('backend/main.changes_successfully'),
                            ]);
                        }

                        $request->flash();

                        return redirect()->route('backend-management-user-edit', $user->id)->withErrors($validator)->withInput();
                    }
                }
            }

            return redirect()->route('backend-management-users');
        }

        public function editUserForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                if ($request->get('user_edit_id')) {
                    $user = User::where('id', $request->input('user_edit_id'))->get()->first();

                    if ($user != null) {
                        $validator = Validator::make($request->all(), [
                            'user_edit_name' => 'required|max:30',
                            'user_edit_balance' => 'required|integer',
                            'user_edit_jabber' => 'required|unique:users,jabber_id,'.$user->id,
                        ]);

                        if (! $validator->fails()) {
                            $name = $request->input('user_edit_name');
                            $jabber = $request->input('user_edit_jabber');
                            $balance = $request->input('user_edit_balance');

                            $user->update([
                                'name' => $name,
                                'jabber_id' => $jabber,
                                'balance_in_cent' => $balance,
                            ]);

                            return redirect()->route('backend-management-user-edit', $user->id)->with([
                                'successMessage' => __('backend/main.changes_successfully'),
                            ]);
                        }

                        $request->flash();

                        return redirect()->route('backend-management-user-edit', $user->id)->withErrors($validator)->withInput();
                    }
                }
            }

            return redirect()->route('backend-management-users');
        }

        public function showTickets($id, $pageNumber = 0)
        {
            $user = User::where('id', $id)->get()->first();

            if ($user == null) {
                return redirect()->route('backend-management-users');
            }

            $tickets = UserTicket::where('user_id', $id)->orderByDesc('created_at')->paginate(10, ['*'], 'page', $pageNumber);

            if ($pageNumber > $tickets->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-management-user-tickets-with-pageNumber', [$id, 1]);
            }

            return view('backend.management.users.tickets', [
                'user' => $user,
                'tickets' => $tickets,
                'managementPage' => true,
            ]);
        }

        public function showOrders($id, $pageNumber = 0)
        {
            $user = User::where('id', $id)->get()->first();

            if ($user == null) {
                return redirect()->route('backend-management-users');
            }

            $orders = UserOrder::where('user_id', $id)->orderByDesc('created_at')->paginate(10, ['*'], 'page', $pageNumber);

            if ($pageNumber > $orders->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-management-user-orders-with-pageNumber', [$id, 1]);
            }

            return view('backend.management.users.orders', [
                'user' => $user,
                'orders' => $orders,
                'managementPage' => true,
            ]);
        }

        public function showUserEditPage($id)
        {
            $user = User::where('id', $id)->get()->first();

            if ($user == null) {
                return redirect()->route('backend-management-users');
            }

            $tickets = UserTicket::where([
                ['user_id', '=', $id],
                ['status', '!=', 'closed'],
            ])->orderByDesc('updated_at')->get();

            return view('backend.management.users.edit', [
                'user' => $user,
                'tickets' => $tickets,
                'managementPage' => true,
            ]);
        }

        public function showUsersPage(Request $request, $pageNumber = 0)
        {
            $users = User::orderByDesc('created_at')->paginate(10, ['*'], 'page', $pageNumber);

            if ($pageNumber > $users->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-management-users-with-pageNumber', 1);
            }

            return view('backend.management.users.list', [
                'users' => $users,
                'managementPage' => true,
            ]);
        }
    }

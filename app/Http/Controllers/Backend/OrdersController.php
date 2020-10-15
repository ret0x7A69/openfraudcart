<?php

namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use App\Models\User;
    use App\Models\UserOrder;
    use App\Models\UserOrderNote;
    use Illuminate\Http\Request;
    use Validator;

    class OrdersController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:manage_orders');
        }

        public function deleteUserOrder($userid, $id)
        {
            UserOrder::where('id', $id)->delete();

            return redirect()->route('backend-management-user-orders', [$userid]);
        }

        public function cancelUserOrder($userid, $id)
        {
            $order = UserOrder::where('id', $id)->get()->first();

            if ($order != null) {
                $order->update([
                    'status' => 'cancelled',
                ]);

                $user = User::where('id', $order->user_id)->get()->first();

                if ($user != null) {
                    $newBalance = $user->balance_in_cent + ($order->price_in_cent + $order->delivery_price);

                    $user->update([
                        'balance_in_cent' => $newBalance,
                    ]);
                }
            }

            return redirect()->route('backend-management-user-orders', [$userid]);
        }

        public function completeUserOrder($userid, $id)
        {
            $order = UserOrder::where('id', $id)->get()->first();

            if ($order != null) {
                $order->update([
                    'status' => 'completed',
                ]);
            }

            return redirect()->route('backend-management-user-orders', [$userid]);
        }

        public function deleteOrder($id)
        {
            UserOrder::where('id', $id)->delete();

            return redirect()->route('backend-orders');
        }

        public function cancelOrder($id)
        {
            $order = UserOrder::where('id', $id)->get()->first();

            if ($order != null) {
                $order->update([
                    'status' => 'cancelled',
                ]);

                $user = User::where('id', $order->user_id)->get()->first();

                if ($user != null) {
                    $newBalance = $user->balance_in_cent + ($order->price_in_cent + $order->delivery_price);

                    $user->update([
                        'balance_in_cent' => $newBalance,
                    ]);
                }
            }

            return redirect()->route('backend-orders');
        }

        public function completeOrder($id)
        {
            $order = UserOrder::where('id', $id)->get()->first();

            if ($order != null) {
                $order->update([
                    'status' => 'completed',
                ]);
            }

            return redirect()->route('backend-orders');
        }

        public function addNote($id, Request $request)
        {
            if ($request->getMethod() == 'POST') {
                $validator = Validator::make($request->all(), [
                    'order_note' => 'required|max:500',
                ]);

                if (! $validator->fails()) {
                    $noteText = $request->input('order_note');

                    UserOrderNote::create([
                        'order_id' => $id,
                        'note' => encrypt($noteText),
                    ]);

                    return redirect()->route('backend-order-id', ['id' => $id])->with([
                        'successMessage' => __('backend/main.added_successfully'),
                    ]);
                }

                $request->flash();

                return redirect()->route('backend-order-id', ['id' => $id])->withErrors($validator)->withInput();
            }

            return redirect()->route('backend-orders');
        }

        public function showOrder($id)
        {
            $order = UserOrder::where('id', $id)->get()->first();
            $notes = UserOrderNote::orderByDesc('created_at')->where('order_id', $id)->get();

            if ($order != null) {
                return view('backend.orders.show', [
                    'order' => $order,
                    'notes' => $notes,
                ]);
            }

            return redirect()->route('backend-orders');
        }

        public function showOrdersPage($pageNumber = 0)
        {
            $orders = UserOrder::orderByDesc('created_at')->where('cart_entry_id', 0)->paginate(10, ['*'], 'page', $pageNumber);

            if ($pageNumber > $orders->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-orders-with-pageNumber', 1);
            }

            return view('backend.orders.list', [
                'orders' => $orders,
                'ordersPage' => true,
            ]);
        }
    }

<?php

namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use App\Models\UserCartShopping;
    use Illuminate\Http\Request;
    use Validator;

    class ShoppingsController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:manage_orders');
        }

        public function done($id)
        {
            $shopping = UserCartShopping::where('id', $id)->get()->first();

            if ($shopping != null) {
                $shopping->done();
            }

            return redirect()->route('backend-shoppings');
        }

        public function showShopping($id)
        {
            $shopping = UserCartShopping::where('id', $id)->get()->first();

            if ($shopping != null) {
                return view('backend.orders.show2', [
                    'shopping' => $shopping,
                ]);
            }

            return redirect()->route('backend-shoppings');
        }

        public function show($pageNumber = 0)
        {
            $shoppings = UserCartShopping::orderByDesc('created_at')->paginate(10, ['*'], 'page', $pageNumber);

            if ($pageNumber > $shoppings->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-shoppings-with-pageNumber', 1);
            }

            return view('backend.orders.list2', [
                'shoppings' => $shoppings,
                'shoppingsPage' => true,
            ]);
        }
    }

<?php

namespace App\Http\Controllers\Backend\Management;

    use App\Http\Controllers\Controller;
    use App\Models\Coupon;
    use Auth;
    use Illuminate\Http\Request;
    use Validator;

    class CouponsController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:manage_coupons');
        }

        public function deleteCoupon($id)
        {
            Coupon::where('id', $id)->delete();

            return redirect()->route('backend-management-coupons');
        }

        public function editCouponForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                if ($request->get('coupon_edit_id')) {
                    $coupon = Coupon::where('id', $request->input('coupon_edit_id'))->get()->first();

                    if ($coupon != null) {
                        $validator = Validator::make($request->all(), [
                            'coupon_edit_code' => 'required|max:255|unique:coupons,code,'.$coupon->id,
                            'coupon_edit_amount' => 'required|integer',
                            'coupon_edit_max_usable' => 'required|integer',
                        ]);

                        if (! $validator->fails()) {
                            $code = $request->input('coupon_edit_code');
                            $amount = $request->input('coupon_edit_amount');
                            $maxUsable = $request->input('coupon_edit_max_usable');

                            $isPercent = 0;

                            if ($request->get('coupon_edit_is_percent')) {
                                $isPercent = 1;
                            }

                            $coupon->update([
                                'code' => $code,
                                'amount' => $amount,
                                'max_usable' => $maxUsable,
                                'is_percent' => $isPercent,
                            ]);

                            return redirect()->route('backend-management-coupon-edit', $coupon->id)->with([
                                'successMessage' => __('backend/main.changes_successfully'),
                            ]);
                        }

                        $request->flash();

                        return redirect()->route('backend-management-coupon-edit', $coupon->id)->withErrors($validator)->withInput();
                    }
                }
            }

            return redirect()->route('backend-management-coupons');
        }

        public function showCouponEditPage($id)
        {
            $coupon = Coupon::where('id', $id)->get()->first();

            if ($coupon == null) {
                return redirect()->route('backend-management-coupons');
            }

            return view('backend.management.coupons.edit', [
                'coupon' => $coupon,
                'managementPage' => true,
            ]);
        }

        public function addCouponForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                $validator = Validator::make($request->all(), [
                    'coupon_add_code' => 'required|max:255|unique:coupons,code',
                    'coupon_add_amount' => 'required|integer',
                    'coupon_add_max_usable' => 'required|integer',
                ]);

                if (! $validator->fails()) {
                    $code = $request->input('coupon_add_code');
                    $amount = $request->input('coupon_add_amount');
                    $maxUsable = $request->input('coupon_add_max_usable');

                    $isPercent = 0;

                    if ($request->get('coupon_add_is_percent')) {
                        $isPercent = 1;
                    }

                    Coupon::create([
                        'code' => $code,
                        'amount' => $amount,
                        'max_usable' => $maxUsable,
                        'used' => 0,
                        'is_percent' => $isPercent,
                    ]);

                    return redirect()->route('backend-management-coupon-add')->with([
                        'successMessage' => __('backend/main.added_successfully'),
                    ]);
                }

                $request->flash();

                return redirect()->route('backend-management-coupon-add')->withErrors($validator)->withInput();
            }

            return redirect()->route('backend-management-coupon-add');
        }

        public function showCouponAddPage(Request $request)
        {
            return view('backend.management.coupons.add', [
                'managementPage' => true,
            ]);
        }

        public function showCouponsPage(Request $request, $pageNumber = 0)
        {
            $coupons = Coupon::orderByDesc('created_at')->paginate(10, ['*'], 'page', $pageNumber);

            if ($pageNumber > $coupons->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-management-coupons-with-pageNumber', 1);
            }

            return view('backend.management.coupons.list', [
                'coupons' => $coupons,
                'managementPage' => true,
            ]);
        }
    }

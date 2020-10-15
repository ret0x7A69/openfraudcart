<?php

namespace App\Http\Controllers\FAQ;

    use App\Http\Controllers\Controller;
    use App\Models\FAQCategory;
    use App\Models\Setting;

    class FAQController extends Controller
    {
        public function __construct()
        {
            if (Setting::get('app.access_only_for_users', false)) {
                $this->middleware('auth');
            }
        }

        public function showFAQPage()
        {
            $faqCategories = FAQCategory::orderByDesc('updated_at')->get();

            return view('frontend/faq.faq', [
                'metaTITLE' => __('frontend/shop.meta.title.faq'),
                'metaDESC' => __('frontend/shop.meta.desc.faq'),
                'faqCategories' => $faqCategories,
            ]);
        }
    }

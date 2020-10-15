<?php

namespace App\Http\Controllers\Backend\Management;

    use App\Http\Controllers\Controller;
    use App\Models\FAQCategory;
    use App\Models\Translation;
    use Illuminate\Http\Request;
    use Validator;

    class FAQsCategoriesController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:manage_faqs_categories');
        }

        public function deleteFAQCategory($id)
        {
            FAQCategory::where('id', $id)->delete();

            return redirect()->route('backend-management-faqs-categories');
        }

        public function editFAQCategoryForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                if ($request->get('faq_category_edit_id')) {
                    $faqCategory = FAQCategory::where('id', $request->input('faq_category_edit_id'))->get()->first();

                    if ($faqCategory != null) {
                        if ($request->get('translation_lng') && strlen($request->get('translation_lng'))) {
                            $lng = strtolower($request->input('translation_lng'));
                            $translation = Translation::where([
                                ['lang', '=', $lng],
                                ['type', '=', 'faq-category'],
                                ['entry_id', '=', $faqCategory->id],
                            ])->get()->first();

                            if ($translation == null) {
                                Translation::create([
                                    'lang' => $lng,
                                    'entry_id' => $faqCategory->id,
                                    'value' => $request->input('faq_category_edit_name') ?? '',
                                    'type' => 'faq-category',
                                ]);
                            } else {
                                $translation->update([
                                    'value' => $request->input('faq_category_edit_name') ?? '',
                                ]);
                            }

                            return redirect()->route('lang-edit-faq-category', [$lng, $faqCategory->id])->with([
                                'successMessage' => __('backend/main.changes_successfully'),
                            ]);
                        }

                        $validator = Validator::make($request->all(), [
                            'faq_category_edit_name' => 'required|max:255',
                        ]);

                        if (! $validator->fails()) {
                            $name = $request->input('faq_category_edit_name');

                            $faqCategory->update([
                                'name' => $name,
                            ]);

                            return redirect()->route('backend-management-faq-category-edit', $faqCategory->id)->with([
                                'successMessage' => __('backend/main.changes_successfully'),
                            ]);
                        }

                        $request->flash();

                        return redirect()->route('backend-management-faq-category-edit', $faqCategory->id)->withErrors($validator)->withInput();
                    }
                }
            }

            return redirect()->route('backend-management-faqs-categories');
        }

        public function showFAQCategoryEditPageLang($lang, $id)
        {
            if (! in_array(strtolower($lang), \App\Models\Setting::getAvailableLocales())) {
                return redirect()->route('backend-management-faqs-categories');
            }

            return $this->showFAQCategoryEditPage($id, $lang);
        }

        public function showFAQCategoryEditPage($id, $lang = null)
        {
            $faqCategory = FAQCategory::where('id', $id)->get()->first();

            if ($faqCategory == null) {
                return redirect()->route('backend-management-faqs-categories');
            }

            return view('backend.management.faqs.categories.edit', [
                'faqCategory' => $faqCategory,
                'lang' => $lang,
                'managementPage' => true,
            ]);
        }

        public function addFAQCategoryForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                $validator = Validator::make($request->all(), [
                    'faq_category_add_name' => 'required|max:255',
                ]);

                if (! $validator->fails()) {
                    $name = $request->input('faq_category_add_name');

                    FAQCategory::create([
                        'name' => $name,
                    ]);

                    return redirect()->route('backend-management-faq-category-add')->with([
                        'successMessage' => __('backend/main.added_successfully'),
                    ]);
                }

                $request->flash();

                return redirect()->route('backend-management-faq-category-add')->withErrors($validator)->withInput();
            }

            return redirect()->route('backend-management-faq-category-add');
        }

        public function showFAQCategoryAddPage(Request $request)
        {
            return view('backend.management.faqs.categories.add', [
                'managementPage' => true,
            ]);
        }

        public function showFAQsCategoriesPage(Request $request, $pageNumber = 0)
        {
            $faqsCategories = FAQCategory::orderByDesc('created_at')->paginate(10, ['*'], 'page', $pageNumber);

            if ($pageNumber > $faqsCategories->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-management-faqs-categories-with-pageNumber', 1);
            }

            return view('backend.management.faqs.categories.list', [
                'faqsCategories' => $faqsCategories,
                'managementPage' => true,
            ]);
        }
    }

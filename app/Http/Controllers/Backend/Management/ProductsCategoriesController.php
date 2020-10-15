<?php

namespace App\Http\Controllers\Backend\Management;

    use App\Http\Controllers\Controller;
    use App\Models\ProductCategory;
    use App\Models\Translation;
    use Illuminate\Http\Request;
    use Validator;

    class ProductsCategoriesController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:manage_products_categories');
        }

        public function deleteProductCategory($id)
        {
            ProductCategory::where('id', $id)->delete();

            return redirect()->route('backend-management-products-categories');
        }

        public function editProductCategoryForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                if ($request->get('product_category_edit_id')) {
                    $productCategory = ProductCategory::where('id', $request->input('product_category_edit_id'))->get()->first();

                    if ($productCategory != null) {
                        if ($request->get('translation_lng') && strlen($request->get('translation_lng'))) {
                            $lng = strtolower($request->input('translation_lng'));
                            $translation = Translation::where([
                                ['lang', '=', $lng],
                                ['type', '=', 'product-category'],
                                ['entry_id', '=', $productCategory->id],
                            ])->get()->first();

                            if ($translation == null) {
                                Translation::create([
                                    'lang' => $lng,
                                    'entry_id' => $productCategory->id,
                                    'value' => $request->input('product_category_edit_name') ?? '',
                                    'type' => 'product-category',
                                ]);
                            } else {
                                $translation->update([
                                    'value' => $request->input('product_category_edit_name') ?? '',
                                ]);
                            }

                            return redirect()->route('lang-edit-product-category', [$lng, $productCategory->id])->with([
                                'successMessage' => __('backend/main.changes_successfully'),
                            ]);
                        }

                        $validator = Validator::make($request->all(), [
                            'product_category_edit_name' => 'required|max:255',
                            'product_category_edit_slug' => 'required|unique:products_categories,slug, '.$productCategory->id.'|max:255',
                            'product_category_edit_keywords' => 'max:500',
                            'product_category_edit_meta_tags_desc' => 'max:500',
                        ]);

                        if (! $validator->fails()) {
                            $name = $request->input('product_category_edit_name');
                            $slug = $request->input('product_category_edit_slug');
                            $keywords = $request->input('product_category_edit_keywords') ?? '';
                            $metaTagsDesc = $request->input('product_category_edit_meta_tags_desc') ?? '';

                            $productCategory->update([
                                'name' => $name,
                                'slug' => $slug,
                                'keywords' => $keywords,
                                'meta_tags_desc' => $metaTagsDesc,
                            ]);

                            return redirect()->route('backend-management-product-category-edit', $productCategory->id)->with([
                                'successMessage' => __('backend/main.changes_successfully'),
                            ]);
                        }

                        $request->flash();

                        return redirect()->route('backend-management-product-category-edit', $productCategory->id)->withErrors($validator)->withInput();
                    }
                }
            }

            return redirect()->route('backend-management-products-categories');
        }

        public function showProductCategoryEditPageLang($lang, $id)
        {
            if (! in_array(strtolower($lang), \App\Models\Setting::getAvailableLocales())) {
                return redirect()->route('backend-management-products-categories');
            }

            return $this->showProductCategoryEditPage($id, $lang);
        }

        public function showProductCategoryEditPage($id, $lang = null)
        {
            $productCategory = ProductCategory::where('id', $id)->get()->first();

            if ($productCategory == null) {
                return redirect()->route('backend-management-products-categories');
            }

            return view('backend.management.products.categories.edit', [
                'productCategory' => $productCategory,
                'lang' => $lang,
                'managementPage' => true,
            ]);
        }

        public function addProductCategoryForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                $validator = Validator::make($request->all(), [
                    'product_category_add_name' => 'required|max:255',
                    'product_category_add_slug' => 'required|unique:products_categories,slug|max:255',
                    'product_category_add_keywords' => 'max:500',
                    'product_category_add_meta_tags_desc' => 'max:500',
                ]);

                if (! $validator->fails()) {
                    $name = $request->input('product_category_add_name');
                    $slug = $request->input('product_category_add_slug');
                    $keywords = $request->input('product_category_add_keywords') ?? '';
                    $metaTagsDesc = $request->input('product_category_add_meta_tags_desc') ?? '';

                    ProductCategory::create([
                        'name' => $name,
                        'slug' => $slug,
                        'keywords' => $keywords,
                        'meta_tags_desc' => $metaTagsDesc,
                    ]);

                    return redirect()->route('backend-management-product-category-add')->with([
                        'successMessage' => __('backend/main.added_successfully'),
                    ]);
                }

                $request->flash();

                return redirect()->route('backend-management-product-category-add')->withErrors($validator)->withInput();
            }

            return redirect()->route('backend-management-product-category-add');
        }

        public function showProductCategoryAddPage(Request $request)
        {
            return view('backend.management.products.categories.add', [
                'managementPage' => true,
            ]);
        }

        public function showProductsCategoriesPage(Request $request, $pageNumber = 0)
        {
            $productsCategories = ProductCategory::orderByDesc('created_at')->paginate(10, ['*'], 'page', $pageNumber);

            if ($pageNumber > $productsCategories->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-management-products-categories-with-pageNumber', 1);
            }

            return view('backend.management.products.categories.list', [
                'productsCategories' => $productsCategories,
                'managementPage' => true,
            ]);
        }
    }

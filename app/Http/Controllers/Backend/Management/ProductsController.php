<?php

namespace App\Http\Controllers\Backend\Management;

    use App\Http\Controllers\Controller;
    use App\Models\Product;
    use App\Models\ProductBonus;
    use App\Models\ProductItem;
    use App\Models\Setting;
    use App\Models\Translation;
    use App\Rules\RuleProductCategoryExists;
    use Illuminate\Http\Request;
    use Illuminate\Pagination\Paginator;
    use Validator;

    class ProductsController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:manage_products');
        }

        public function deleteProduct($id)
        {
            Product::where('id', $id)->delete();
            ProductItem::where('product_id', $id)->delete();

            return redirect()->route('backend-management-products');
        }

        public function deleteBonus($id, $bid)
        {
            $bonus = ProductBonus::where('id', $bid)->get()->first();
            if ($bonus != null) {
                $bonus->delete();
            }

            return redirect()->route('backend-management-product-bonus', $id);
        }

        public function showProductBonusPage(Request $request, $id)
        {
            if ($request->getMethod() == 'POST') {
                $ok = false;

                if ($request->get('settings_bonus_amount_new') && $request->get('settings_bonus_percent_new')) {
                    $Namount = $request->input('settings_bonus_amount_new');
                    $Npercent = $request->input('settings_bonus_percent_new');

                    if (strlen($Namount) && strlen($Npercent)) {
                        ProductBonus::create([
                            'min_amount' => $Namount,
                            'product_id' => $id,
                            'percent' => $Npercent,
                        ]);

                        $ok = true;
                    }
                }

                if ($request->get('settings_bonus_ids')) {
                    $ids = explode(',', $request->input('settings_bonus_ids'));

                    foreach ($ids as $idx) {
                        if ($request->get('settings_bonus_amount_'.$idx) && $request->get('settings_bonus_percent_'.$idx)) {
                            $amount = $request->input('settings_bonus_amount_'.$idx);
                            $percent = $request->input('settings_bonus_percent_'.$idx);

                            $bonus = ProductBonus::where('id', $idx)->get()->first();
                            if ($bonus != null) {
                                $bonus->update([
                                    'min_amount' => $amount,
                                    'percent' => $percent,
                                ]);
                            }

                            $ok = true;
                        }
                    }
                }

                if ($ok) {
                    return redirect()->route('backend-management-product-bonus', $id)->with([
                        'successMessage' => __('backend/main.changes_successfully'),
                    ]);
                }
            }

            $bbs = ProductBonus::where('product_id', $id)->orderByDesc('min_amount')->get();

            $ids = [];
            foreach ($bbs as $b) {
                $ids[] = $b->id;
            }

            return view('backend.management.products.bonus', [
                'bbs' => $bbs,
                'pID' => $id,
                'Ids' => implode(',', $ids),
            ]);
        }

        public function deleteProductItem($id)
        {
            $productItem = ProductItem::where('id', $id)->get()->first();

            if ($productItem != null) {
                $product = Product::where('id', $productItem->product_id)->get()->first();

                $productItem->delete();

                if ($product != null) {
                    return redirect()->route('backend-management-product-database', $product->id);
                }
            }

            return redirect()->route('backend-management-products');
        }

        public function editProductItem(Request $request, $id)
        {
            $productItem = ProductItem::where('id', $id)->get()->first();

            if ($productItem == null) {
                return redirect()->route('backend-management-products');
            }

            if ($request->getMethod() == 'POST') {
                $productItem = ProductItem::where('id', $id)->get()->first();

                if ($productItem != null) {
                    $validator = Validator::make($request->all(), [
                            'productitem_content' => 'required|max:50000',
                        ]);

                    if (! $validator->fails()) {
                        $content = $request->input('productitem_content');

                        $productItem->update([
                                'content' => encrypt($content),
                            ]);

                        return redirect()->route('backend-management-product-database-edit', $id)->with([
                                'successMessage' => 'Änderungen erfolgreich vorgenommen.',
                            ]);
                    }

                    $request->flash();

                    return redirect()->route('backend-management-product-database-edit', $id)->withErrors($validator)->withInput();
                }
            }

            $product = Product::where('id', $productItem->product_id)->get()->first();

            return view('backend.management.products.database_edit', [
                'productItem' => $productItem,
                'product' => $product,
                'managementPage' => true,
            ]);
        }

        public function showProductDatabasePageSearch(Request $request, $id, $pageNumber = 0)
        {
            @session_start();

            $search = null;
            if (isset($_SESSION['search-input']) && strlen($_SESSION['search-input']) > 0) {
                $search = $_SESSION['search-input'];
            }

            $regex = false;
            if (isset($_SESSION['search-regex']) && $_SESSION['search-regex'] == true) {
                $regex = true;
            }

            if ($request->getMethod() == 'POST') {
                if ($request->get('search_input')) {
                    $search = $request->get('search_input');
                    $_SESSION['search-input'] = $search;
                }

                if ($request->get('search_regex')) {
                    $search = $request->get('search_regex');
                    $_SESSION['search-regex'] = 1;
                } else {
                    $_SESSION['search-regex'] = 0;
                }
            }

            $databaseItems = ProductItem::where('product_id', $id)->orderByDesc('created_at')->count();

            /*
            if($search != null) {
                $search = addslashes($search);

                if($regex) {
                    $database = \DB::table('products_items')
                    ->where('product_id', $id)
                    ->whereRaw("content REGEXP '{$search}'")
                    ->orderByDesc('created_at')
                    ->paginate(10, ['*'], 'page', $pageNumber);
                } else {
                    $database = \DB::table('products_items')
                    ->where('product_id', $id)
                    ->where('content', 'LIKE', '%' . $search . '%')
                    ->orderByDesc('created_at')
                    ->paginate(10, ['*'], 'page', $pageNumber);
                }
            }

            $database = ProductItem::where('product_id', $id)->orderByDesc('created_at')->paginate(1, ['*'], 'page', $pageNumber);
            */
            $db = ProductItem::where('product_id', $id)->orderByDesc('created_at')->get();

            $databaseIds = [];
            foreach ($db as $dbItem) {
                if ($regex) {
                    $content = strlen($dbItem->content) > 0 ? decrypt($dbItem->content) : '';

                    if (preg_match("/$search/", $content)) {
                        $databaseIds[] = $dbItem->id;
                    }
                } else {
                    $content = strlen($dbItem->content) > 0 ? decrypt($dbItem->content) : '';

                    if (stripos($content, $search) !== false) {
                        $databaseIds[] = $dbItem->id;
                    }
                }
            }

            $database = \DB::table('products_items')->whereIn('id', $databaseIds)->paginate(10, ['*'], 'page', $pageNumber);

            $databaseItemsSearch = count($database);
            $databaseItems = ProductItem::where('product_id', $id)->count();

            if ($pageNumber > $database->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-management-product-database-search-with-pageNumber', [$id, 1]);
            }

            $product = Product::where('id', $id)->get()->first();

            if ($product == null || $product->isUnlimited()) {
                return redirect()->route('backend-management-products');
            }

            return view('backend.management.products.database', [
                'product' => $product,
                'search' => htmlspecialchars($search),
                'database' => $database,
                'databaseItemsSearch' => $databaseItemsSearch,
                'databaseItems' => $databaseItems,
                'regex' => $regex,
                'managementPage' => true,
            ]);
        }

        public function showProductDatabasePage($id, $pageNumber = 0)
        {
            $database = ProductItem::where('product_id', $id)->orderByDesc('created_at')->paginate(10, ['*'], 'page', $pageNumber);

            $databaseItems = ProductItem::where('product_id', $id)->count();

            if ($pageNumber > $database->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-management-product-database-with-pageNumber', [$id, 1]);
            }

            $product = Product::where('id', $id)->get()->first();

            if ($product == null || $product->isUnlimited()) {
                return redirect()->route('backend-management-products');
            }

            return view('backend.management.products.database', [
                'product' => $product,
                'database' => $database,
                'databaseItems' => $databaseItems,
                'managementPage' => true,
            ]);
        }

        public function databaseImportTXT(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                if ($request->get('product_id')) {
                    $product = Product::where('id', $request->input('product_id'))->get()->first();

                    if ($product != null && ! $product->isUnlimited() && ! $product->asWeight()) {
                        $validator = Validator::make($request->all(), [
                            'import_txt_input' => 'required|max:1000000',
                            'product_import_txt_option' => 'required|IN:seperator,linebyline',
                        ]);

                        if (! $validator->fails()) {
                            $input = $request->input('import_txt_input');
                            $type = $request->input('product_import_txt_option');

                            $count = 0;

                            $seperator = "\n";
                            if ($type == 'seperator') {
                                if (! $request->get('product_import_txt_seperator_input')) {
                                    $validator->getMessageBag()->add('product_import_txt_seperator_input', __('backend/management.products.database.import.txt.seperator_required'));

                                    $request->flash();

                                    return redirect()->route('backend-management-product-database', $product->id)->withErrors($validator)->withInput();
                                }

                                $seperator = $request->input('product_import_txt_seperator_input');

                                Setting::set('import.custom.delimiter', $seperator);
                            }

                            $items = explode($seperator, trim($input));
                            $items = array_filter($items, 'trim');

                            foreach ($items as $line) {
                                if (strlen($line) <= 0) {
                                    continue;
                                }

                                if (ProductItem::create([
                                    'product_id' => $product->id,
                                    'content' => encrypt($line),
                                ])) {
                                    $count++;
                                }
                            }

                            return redirect()->route('backend-management-product-database', $product->id)->with([
                                'successMessage' => __('backend/management.products.database.import.successfully', [
                                    'count' => $count,
                                ]),
                            ]);
                        }

                        $request->flash();

                        return redirect()->route('backend-management-product-database', $product->id)->withErrors($validator)->withInput();
                    }
                }
            }

            return redirect()->route('backend-management-products');
        }

        public function databaseImportONE(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                if ($request->get('product_id')) {
                    $product = Product::where('id', $request->input('product_id'))->get()->first();

                    if ($product != null && ! $product->isUnlimited()) {
                        $validator = Validator::make($request->all(), [
                            'import_one_content' => 'required|max:1000',
                        ]);

                        if (! $validator->fails()) {
                            $content = $request->input('import_one_content');

                            ProductItem::create([
                                'product_id' => $product->id,
                                'content' => encrypt($content),
                            ]);

                            return redirect()->route('backend-management-product-database', $product->id)->with([
                                'successMessage' => __('backend/management.products.database.import.one_successfully'),
                            ]);
                        }

                        $request->flash();

                        return redirect()->route('backend-management-product-database', $product->id)->withErrors($validator)->withInput();
                    }
                }
            }

            return redirect()->route('backend-management-products');
        }

        public function editProductForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                if ($request->get('product_edit_id')) {
                    $product = Product::where('id', $request->input('product_edit_id'))->get()->first();

                    if ($product != null) {
                        if ($request->get('translation_lng') && strlen($request->get('translation_lng'))) {
                            $lng = strtolower($request->input('translation_lng'));
                            foreach (['name', 'description', 'short_description'] as $keyword) {
                                $translation = Translation::where([
                                    ['lang', '=', $lng],
                                    ['type', '=', 'product'],
                                    ['keyword', '=', $keyword],
                                    ['entry_id', '=', $product->id],
                                ])->get()->first();

                                if ($translation == null) {
                                    Translation::create([
                                        'lang' => $lng,
                                        'entry_id' => $product->id,
                                        'keyword' => $keyword,
                                        'value' => $request->input('product_edit_'.$keyword) ?? '',
                                        'type' => 'product',
                                    ]);
                                } else {
                                    $translation->update([
                                        'value' => $request->input('product_edit_'.$keyword) ?? '',
                                    ]);
                                }
                            }

                            return redirect()->route('lang-edit-product', [$lng, $product->id])->with([
                                'successMessage' => __('backend/main.changes_successfully'),
                            ]);
                        }

                        $validator = Validator::make($request->all(), [
                            'product_edit_name' => 'required|max:255',
                            'product_edit_description' => 'required|max:50000',
                            'product_edit_category_id' => new RuleProductCategoryExists(),
                            'product_edit_short_description' => 'required|max:255',
                            'product_edit_content' => 'max:2000',
                            'product_edit_price_in_cent' => 'required|integer',
                            'product_edit_interval' => 'integer|min:1',
                            'product_edit_old_price_in_cent' => 'nullable|integer',
                            'product_edit_stock_management'=> 'required|in:normal,weight,unlimited',
                        ]);

                        if (! $validator->fails()) {
                            $name = $request->input('product_edit_name');
                            $description = $request->input('product_edit_description');
                            $short_description = $request->input('product_edit_short_description');
                            $content = $request->get('product_edit_content') ? $request->input('product_edit_content') : '';
                            $price_in_cent = $request->input('product_edit_price_in_cent');
                            $old_price_in_cent = $request->input('product_edit_old_price_in_cent') ?? 0;
                            $interval = $request->input('product_edit_interval') ?? 1;
                            $category_id = $request->input('product_edit_category_id');
                            $product_edit_stock_management = $request->input('product_edit_stock_management');

                            $as_weight = 0;
                            $weight_available = 0;
                            $stock_management = 1;
                            $weightchar = '';

                            if ($product_edit_stock_management == 'unlimited') {
                                $stock_management = 0;
                            } elseif ($product_edit_stock_management == 'weight') {
                                $stock_management = 0;
                                $as_weight = 1;

                                if ($request->get('product_edit_weight')) {
                                    $weight_available = intval($request->get('product_edit_weight'));
                                }

                                if ($request->get('product_edit_weightchar')) {
                                    $weightchar = $request->get('product_edit_weightchar');
                                } else {
                                    $weightchar = 'g';
                                }
                            }

                            $drop_needed = 0;
                            if ($request->get('product_edit_drop_needed')) {
                                $drop_needed = 1;
                            }

                            $product->update([
                                'name' => $name,
                                'description' => encrypt($description),
                                'short_description' => encrypt($short_description),
                                'price_in_cent' => $price_in_cent,
                                'old_price_in_cent' => $old_price_in_cent,
                                'drop_needed' => $drop_needed,
                                'category_id' => $category_id,
                                'stock_management' => $stock_management,
                                'as_weight' => $as_weight,
                                'weight_available' => $weight_available,
                                'weight_char' => $weightchar,
                                'interval' => $interval,
                                'content' => encrypt($content),
                            ]);

                            return redirect()->route('backend-management-product-edit', $product->id)->with([
                                'successMessage' => __('backend/main.changes_successfully'),
                            ]);
                        }

                        $request->flash();

                        return redirect()->route('backend-management-product-edit', $product->id)->withErrors($validator)->withInput();
                    }
                }
            }

            return redirect()->route('backend-management-products');
        }

        public function showProductEditPageLang(Request $request, $lang, $id)
        {
            if (! in_array(strtolower($lang), \App\Models\Setting::getAvailableLocales())) {
                return redirect()->route('backend-management-products');
            }

            return $this->showProductEditPage($request, $id, $lang);
        }

        public function showProductEditPage(Request $request, $id, $lang = null)
        {
            $product = Product::where('id', $id)->get()->first();

            if ($product == null) {
                return redirect()->route('backend-management-products');
            }

            return view('backend.management.products.edit', [
                'product' => $product,
                'lang' => $lang,
                'managementPage' => true,
            ]);
        }

        public function addProductForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                $validator = Validator::make($request->all(), [
                    'product_add_name' => 'required|max:255',
                    'product_add_description' => 'required|max:50000',
                    'product_add_category_id' => new RuleProductCategoryExists(),
                    'product_add_short_description' => 'required|max:255',
                    'product_add_content' => 'max:2000',
                    'product_add_interval' => 'integer|min:1',
                    'product_add_price_in_cent' => 'required|integer',
                    'product_add_old_price_in_cent' => 'nullable|integer',
                    'product_add_stock_management'=> 'required|in:normal,weight,unlimited',
                ]);

                if (! $validator->fails()) {
                    $name = $request->input('product_add_name');
                    $description = $request->input('product_add_description');
                    $short_description = $request->input('product_add_short_description');
                    $content = $request->get('product_add_content') ? $request->input('product_add_content') : '';
                    $price_in_cent = $request->input('product_add_price_in_cent');
                    $old_price_in_cent = $request->input('product_add_old_price_in_cent') ?? 0;
                    $interval = $request->input('product_add_interval') ?? 1;
                    $category_id = $request->input('product_add_category_id');
                    $product_add_stock_management = $request->input('product_add_stock_management');

                    $as_weight = 0;
                    $weight_available = 0;
                    $stock_management = 1;
                    $weightchar = '';

                    if ($product_add_stock_management == 'unlimited') {
                        $stock_management = 0;
                    } elseif ($product_add_stock_management == 'weight') {
                        $stock_management = 0;
                        $as_weight = 1;

                        if ($request->get('product_add_weight')) {
                            $weight_available = intval($request->get('product_add_weight'));
                        }

                        if ($request->get('product_add_weightchar')) {
                            $weightchar = $request->get('product_add_weightchar');
                        } else {
                            $weightchar = 'g';
                        }
                    }

                    $drop_needed = 0;
                    if ($request->get('product_add_drop_needed')) {
                        $drop_needed = 1;
                    }

                    Product::create([
                        'name' => $name,
                        'description' => encrypt($description),
                        'short_description' => encrypt($short_description),
                        'price_in_cent' => $price_in_cent,
                        'old_price_in_cent' => $old_price_in_cent,
                        'category_id' => $category_id,
                        'drop_needed' => $drop_needed,
                        'stock_management' => $stock_management,
                        'interval' => $interval,
                        'as_weight' => $as_weight,
                        'weight_available' => $weight_available,
                        'weight_char' => $weightchar,
                        'content' => encrypt($content),
                        'sells' => 0,
                    ]);

                    return redirect()->route('backend-management-product-add')->with([
                        'successMessage' => __('backend/main.added_successfully'),
                    ]);
                }

                $request->flash();

                return redirect()->route('backend-management-product-add')->withErrors($validator)->withInput();
            }

            return redirect()->route('backend-management-product-add');
        }

        public function showProductAddPage(Request $request)
        {
            return view('backend.management.products.add', [
                'managementPage' => true,
            ]);
        }

        public function showProductsPage(Request $request, $pageNumber = 0)
        {
            $products = Product::orderByDesc('created_at')->paginate(10, ['*'], 'page', $pageNumber);

            if ($pageNumber > $products->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-management-products-with-pageNumber', 1);
            }

            return view('backend.management.products.list', [
                'products' => $products,
                'managementPage' => true,
            ]);
        }
    }

<?php

namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use App\Models\Article;
    use App\Models\Product;
    use App\Models\ProductCategory;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class SitemapController extends Controller
    {
        public function __construct()
        {
        }

        public function products()
        {
            $products = Product::orderByDesc('id')->get();

            return response()->view('sitemap.products', [
                'products' => $products,
            ])->header('Content-Type', 'text/xml');
        }

        public function categories()
        {
            $categories = ProductCategory::orderByDesc('id')->get();

            return response()->view('sitemap.categories', [
                'categories' => $categories,
            ])->header('Content-Type', 'text/xml');
        }

        public function news()
        {
            $news = Article::orderByDesc('id')->get();

            return response()->view('sitemap.news', [
                'news' => $news,
            ])->header('Content-Type', 'text/xml');
        }

        public function main()
        {
            $products = Product::orderByDesc('updated_at')->first();
            $categories = ProductCategory::orderByDesc('updated_at')->first();

            $urls = [
                route('index'),
                route('shop'),
                route('faq'),
            ];

            return response()->view('sitemap.main', [
                'products' => $products,
                'categories' => $categories,
                'urls' => $urls,
            ])->header('Content-Type', 'text/xml');
        }
    }

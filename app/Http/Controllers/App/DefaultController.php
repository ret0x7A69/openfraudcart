<?php

namespace App\Http\Controllers\App;

    use App\Http\Controllers\Controller;
    use App\Models\Article;
    use App\Models\Setting;
    use Illuminate\Http\Request;
    use Mail;

    class DefaultController extends Controller
    {
        public function __construct()
        {
            if (Setting::get('app.access_only_for_users', false)) {
                $this->middleware('auth');
            }
        }

        public function showArticle($id)
        {
            $article = Article::where('id', $id)->get()->first();

            if ($article == null) {
                return redirect()->route('index');
            }

            return view('frontend.article', [
                'article' => $article,
                'metaTITLE' => $article->title,
                'metaDESC' => strip_tags(substr(strlen($article->body) ? decrypt($article->body) : '', 0, 65)),
            ]);
        }

        public function showIndex($pageNumber = 0)
        {
            $articles = Article::orderByDesc('updated_at')->paginate(10, ['*'], 'page', $pageNumber);

            if ($pageNumber > $articles->lastPage() || $pageNumber <= 0) {
                return redirect()->route('index-with-pageNumber', 1);
            }

            return view('frontend.index', [
                'articles' => $articles,
            ]);
        }
    }

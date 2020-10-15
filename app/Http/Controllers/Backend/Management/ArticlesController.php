<?php

namespace App\Http\Controllers\Backend\Management;

    use App\Http\Controllers\Controller;
    use App\Models\Article;
    use App\Models\Translation;
    use Auth;
    use Illuminate\Http\Request;
    use Validator;

    class ArticlesController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:manage_articles');
        }

        public function deleteArticle($id)
        {
            Article::where('id', $id)->delete();

            return redirect()->route('backend-management-articles');
        }

        public function editArticleForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                if ($request->get('article_edit_id')) {
                    $article = Article::where('id', $request->input('article_edit_id'))->get()->first();

                    if ($article != null) {
                        if ($request->get('translation_lng') && strlen($request->get('translation_lng'))) {
                            $lng = strtolower($request->input('translation_lng'));
                            foreach (['title', 'content'] as $keyword) {
                                $translation = Translation::where([
                                    ['lang', '=', $lng],
                                    ['type', '=', 'article'],
                                    ['keyword', '=', $keyword],
                                    ['entry_id', '=', $article->id],
                                ])->get()->first();

                                if ($translation == null) {
                                    Translation::create([
                                        'lang' => $lng,
                                        'entry_id' => $article->id,
                                        'keyword' => $keyword,
                                        'value' => $request->input('article_edit_'.$keyword) ?? '',
                                        'type' => 'article',
                                    ]);
                                } else {
                                    $translation->update([
                                        'value' => $request->input('article_edit_'.$keyword) ?? '',
                                    ]);
                                }
                            }

                            return redirect()->route('lang-edit-article', [$lng, $article->id])->with([
                                'successMessage' => __('backend/main.changes_successfully'),
                            ]);
                        }

                        $validator = Validator::make($request->all(), [
                            'article_edit_title' => 'required|max:255',
                            'article_edit_content' => 'required|max:5000',
                        ]);

                        if (! $validator->fails()) {
                            $title = $request->input('article_edit_title');
                            $content = $request->input('article_edit_content');

                            $userId = 0;

                            if (! $request->get('article_edit_anonym')) {
                                $userId = Auth::user()->id;
                            }

                            $article->update([
                                'title' => $title,
                                'body' => encrypt($content),
                                'user_id' => $userId,
                            ]);

                            return redirect()->route('backend-management-article-edit', $article->id)->with([
                                'successMessage' => __('backend/main.changes_successfully'),
                            ]);
                        }

                        $request->flash();

                        return redirect()->route('backend-management-article-edit', $article->id)->withErrors($validator)->withInput();
                    }
                }
            }

            return redirect()->route('backend-management-articles');
        }

        public function showArticleEditPageLang($lang, $id)
        {
            if (! in_array(strtolower($lang), \App\Models\Setting::getAvailableLocales())) {
                return redirect()->route('backend-management-articles');
            }

            return $this->showArticleEditPage($id, $lang);
        }

        public function showArticleEditPage($id, $lang = null)
        {
            $article = Article::where('id', $id)->get()->first();

            if ($article == null) {
                return redirect()->route('backend-management-articles');
            }

            return view('backend.management.articles.edit', [
                'article' => $article,
                'lang' => $lang,
                'managementPage' => true,
            ]);
        }

        public function addArticleForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                $validator = Validator::make($request->all(), [
                    'article_add_title' => 'required|max:255',
                    'article_add_content' => 'required|max:5000',
                ]);

                if (! $validator->fails()) {
                    $title = $request->input('article_add_title');
                    $content = $request->input('article_add_content');

                    $userId = 0;

                    if (! $request->get('article_add_anonym')) {
                        $userId = Auth::user()->id;
                    }

                    Article::create([
                        'user_id' => $userId,
                        'body' => encrypt($content),
                        'title' => $title,
                    ]);

                    return redirect()->route('backend-management-article-add')->with([
                        'successMessage' => __('backend/main.added_successfully'),
                    ]);
                }

                $request->flash();

                return redirect()->route('backend-management-article-add')->withErrors($validator)->withInput();
            }

            return redirect()->route('backend-management-article-add');
        }

        public function showArticleAddPage(Request $request)
        {
            return view('backend.management.articles.add', [
                'managementPage' => true,
            ]);
        }

        public function showArticlesPage(Request $request, $pageNumber = 0)
        {
            $articles = Article::orderByDesc('created_at')->paginate(10, ['*'], 'page', $pageNumber);

            if ($pageNumber > $articles->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-management-articles-with-pageNumber', 1);
            }

            return view('backend.management.articles.list', [
                'articles' => $articles,
                'managementPage' => true,
            ]);
        }
    }

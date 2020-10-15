@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title">{{ __('frontend/main.home') }}</h3>
        </div>
        
        @if(count($articles))
            <div class="col-md-12">
                <div id="newsAccordion" class="accordion-with-icon">
                    @foreach($articles as $article)
                    <div class="card mb-15" id="newsHeading-{{ $loop->iteration }}">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class=" btn-link btn-block text-left text-decoration-none btn-faq" data-toggle="collapse" data-target="#newsCollapse-{{ $loop->iteration }}" aria-expanded="@if($loop->iteration == 1) true @else false @endif" aria-controls="newsCollapse-{{ $loop->iteration }}">
                                    {{ \App\Classes\LangHelper::translate(app()->getLocale(), 'article', 'title', 'title', $article) }}
                                </button>
                            </h5>
                        </div>

                        <div id="newsCollapse-{{ $loop->iteration }}" class="collapse @if($loop->iteration == 1) show @endif" aria-labelledby="newsHeading-{{ $loop->iteration }}" data-parent="#newsAccordion">
                            <div class="card-body">
                            {!! \App\Classes\LangHelper::translate(app()->getLocale(), 'article', 'content', 'body', $article, true) !!}
                            </div>
                        </div>

                        @if(strlen($article->created_at) > 0)
                        <div class="card-footer">
                            @if(App\Models\User::find($article->user_id) != null)
                                <span class="small-text">
                                    <ion-icon name="time"></ion-icon>

                                    {{ __('frontend/main.written_by', [
                                        'name' => App\Models\User::find($article->user_id)->username,
                                        'date' => $article->created_at->format('d.m.Y'),
                                        'time' => $article->created_at->format('H:i')
                                    ]) }}
                                </span>
                            @else
                            <span class="small-text">
                                <ion-icon name="time"></ion-icon>
                                
                                {{ __('frontend/main.written_info', [
                                    'date' => $article->created_at->format('d.m.Y'),
                                    'time' => $article->created_at->format('H:i')
                                ]) }}
                            </span>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="col-md-12">
                <div class="alert alert-warning">
                    {{ __('frontend/main.no_articles_exists') }}
                </div>
            </div>        
        @endif
    </div>

    @if(count($articles))
    <div class="row justify-content-center">
        <div class="col-md-12">
            {!! preg_replace('/' . $articles->currentPage() . '\?page=/', '', $articles->links()) !!}
        </div>
    </div>
    @endif
</div>
@endsection

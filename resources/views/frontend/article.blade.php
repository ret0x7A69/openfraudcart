@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="page-title">{{ $article->title }}</h3>
        </div>
        
            <div class="col-md-12">
                <div id="newsAccordion" class="accordion-with-icon">
                    <div class="card mb-15" id="newsHeading-{{ $article->id }}">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class=" btn-link btn-block text-left text-decoration-none btn-faq" data-toggle="collapse" data-target="#newsCollapse-{{ $article->id }}" aria-expanded="true" aria-controls="newsCollapse-{{ $article->id }}">
                                    {{ \App\Classes\LangHelper::translate(app()->getLocale(), 'article', 'title', 'body', $article) }}
                                </button>
                            </h5>
                        </div>

                        <div id="newsCollapse-{{ $article->id }}" class="collapse show" aria-labelledby="newsHeading-{{ $article->id }}" data-parent="#newsAccordion">
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
                </div>
            </div>
    </div>
</div>
@endsection

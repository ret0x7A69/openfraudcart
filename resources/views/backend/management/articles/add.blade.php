@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.articles.add.title') }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/management.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-management-articles') }}" class="k-content__head-breadcrumb-link">{{ __('backend/management.articles.title') }}</a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
										<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">{{ __('backend/management.articles.add.title') }}</h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="{{ route('backend-management-article-add-form') }}">
													@csrf
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="article_add_title">{{ __('backend/management.articles.article_title') }}</label>
																<input type="text" class="form-control @if($errors->has('article_add_title')) is-invalid @endif" id="article_add_title" name="article_add_title" placeholder="{{ __('backend/management.articles.article_title') }}" value="{{ old('article_add_title') }}" />

																@if($errors->has('article_add_title'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('article_add_title') }}</strong>
																	</span>
																@endif
															</div>
															
															<div class="form-group">
																<label for="article_add_content">{{ __('backend/management.articles.content') }}</label>
																<textarea class="text-editor form-control @if($errors->has('article_add_content')) is-invalid @endif" id="article_add_content" name="article_add_content" placeholder="{{ __('backend/management.articles.content') }}">{{ old('article_add_content') }}</textarea>

																@if($errors->has('article_add_content'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('article_add_content') }}</strong>
																	</span>
																@endif
															</div>
															
															<div style="margin-bottom: 5px;">
																<b>{{ __('backend/management.articles.add.options') }}</b>
															</div>
															
															<div class="form-group">
																<label class="k-checkbox k-checkbox--all k-checkbox--solid">
																	<input type="checkbox" name="article_add_anonym" />
																	<span></span>
																	{{ __('backend/management.articles.add.anonym') }}
																</label>
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger">{{ __('backend/management.articles.add.submit_button') }}</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
@endsection

@section('page_scripts')
<script type="text/javascript">
	$(function() {
		$('textarea.text-editor').froalaEditor({
			toolbarSticky: false,
			language: 'de',
      		theme: 'gray',
			toolbarButtons: ['undo', 'redo' , '|', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'align', '|', 'fontFamily', 'fontSize', 'color', '|', 'emoticons', '|', 'insertLink', 'insertImage', '|', 'outdent', 'indent', 'clearFormatting', 'insertTable', 'html']
		});
  	});
</script>
@endsection
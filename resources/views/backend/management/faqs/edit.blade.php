@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.faqs.edit.title') }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/management.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-management-faqs') }}" class="k-content__head-breadcrumb-link">{{ __('backend/management.faqs.title') }}</a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
										
											{{ App\Classes\LangHelper::getLangSelector('lang-edit-faq', $faq->id, $lang ?? null) }}
											
											
											<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">{{ __('backend/management.faqs.edit.title') }}</h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="{{ route('backend-management-faq-edit-form') }}">
													@csrf

@if($lang != null)
<input type="hidden" name="translation_lng" value="{{ strtolower($lang) }}" />
@endif
													
													<input type="hidden" value="{{ $faq->id }}" name="faq_edit_id" />

													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="faq_edit_question">{{ __('backend/management.faqs.question') }}</label>
																<input type="text" class="form-control @if($errors->has('faq_edit_question')) is-invalid @endif" id="faq_edit_question" name="faq_edit_question" placeholder="{{ __('backend/management.faqs.question') }}" value="{{ \App\Classes\LangHelper::getValue($lang, 'faq', 'question', $faq->id) ?? $faq->question }}" />

																@if($errors->has('faq_edit_question'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('faq_edit_question') }}</strong>
																	</span>
																@endif
															</div>
															
															@if($lang == null)
															<div class="form-group">
																<label for="faq_edit_category">{{ __('backend/management.faqs.category') }}</label>
																<select name="faq_edit_category" id="faq_edit_category" class="form-control @if($errors->has('faq_edit_category')) is-invalid @endif">
																	<option value="0">{{ __('backend/main.please_choose') }}</option>
																	@foreach(App\Models\FAQCategory::all() as $faqCategory)
																	<option value="{{ $faqCategory->id }}" @if($faq->getCategory()->id == $faqCategory->id) selected @endif>{{ $faqCategory->name }}</option>	
																	@endforeach
																</select>

																@if($errors->has('faq_edit_category'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('faq_edit_category') }}</strong>
																	</span>
																@endif
															</div>
															@endif

															<div class="form-group">
																<label for="faq_edit_answer">{{ __('backend/management.faqs.answer') }}</label>
																<textarea class="text-editor form-control @if($errors->has('faq_edit_answer')) is-invalid @endif" id="faq_edit_answer" name="faq_edit_answer" placeholder="{{ __('backend/management.faqs.answer') }}">{{ \App\Classes\LangHelper::getValue($lang, 'faq', 'answer', $faq->id) ?? (strlen($faq->answer) > 0 ? decrypt($faq->answer) : '') }}</textarea>

																@if($errors->has('faq_edit_answer'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('faq_edit_answer') }}</strong>
																	</span>
																@endif
															</div>

															@if($lang == null)
															<div class="form-group">
																<label for="faq_edit_ordering">Reihenfolge</label>
																<input type="number" class="form-control @if($errors->has('faq_edit_ordering')) is-invalid @endif" id="faq_edit_ordering" name="faq_edit_ordering" placeholder="" value="{{ $faq->ordering }}" />

																@if($errors->has('faq_edit_ordering'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('faq_edit_ordering') }}</strong>
																	</span>
																@endif
															</div>
															@endif
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger">{{ __('backend/management.faqs.edit.submit_button') }}</button>
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
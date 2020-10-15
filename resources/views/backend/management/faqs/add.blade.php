@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.faqs.add.title') }}</h3>
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
										<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">{{ __('backend/management.faqs.add.title') }}</h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="{{ route('backend-management-faq-add-form') }}">
													@csrf
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="faq_add_question">{{ __('backend/management.faqs.question') }}</label>
																<input type="text" class="form-control @if($errors->has('faq_add_question')) is-invalid @endif" id="faq_add_question" name="faq_add_question" placeholder="{{ __('backend/management.faqs.question') }}" value="{{ old('faq_add_question') }}" />

																@if($errors->has('faq_add_question'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('faq_add_question') }}</strong>
																	</span>
																@endif
															</div>
															
															<div class="form-group">
																<label for="faq_add_category">{{ __('backend/management.faqs.category') }}</label>
																<select name="faq_add_category" id="faq_add_category" class="form-control @if($errors->has('faq_add_category')) is-invalid @endif">
																	<option value="0">{{ __('backend/main.please_choose') }}</option>
																	@foreach(App\Models\FAQCategory::all() as $faqCategory)
																	<option value="{{ $faqCategory->id }}" @if(old('faq_add_category') == $faqCategory->id) selected @endif>{{ $faqCategory->name }}</option>	
																	@endforeach
																</select>

																@if($errors->has('faq_add_category'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('faq_add_category') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="faq_add_answer">{{ __('backend/management.faqs.answer') }}</label>
																<textarea class="text-editor form-control @if($errors->has('faq_add_answer')) is-invalid @endif" id="faq_add_answer" name="faq_add_answer" placeholder="{{ __('backend/management.faqs.answer') }}">{{ old('faq_add_answer') }}</textarea>

																@if($errors->has('faq_add_answer'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('faq_add_answer') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="faq_add_ordering">Reihenfolge</label>
																<input type="number" class="form-control @if($errors->has('faq_add_ordering')) is-invalid @endif" id="faq_add_ordering" name="faq_add_ordering" placeholder="">{{ old('faq_add_ordering') }}</textarea>

																@if($errors->has('faq_add_ordering'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('faq_add_ordering') }}</strong>
																	</span>
																@endif
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger">{{ __('backend/management.faqs.add.submit_button') }}</button>
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
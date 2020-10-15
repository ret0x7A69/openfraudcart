@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.delivery_methods.edit.title') }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/management.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-management-delivery-methods') }}" class="k-content__head-breadcrumb-link">{{ __('backend/management.delivery_methods.title') }}</a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
										<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">{{ __('backend/management.delivery_methods.edit.title') }}</h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="{{ route('backend-management-delivery-method-edit-form') }}">
													@csrf

													<input type="hidden" value="{{ $deliveryMethod->id }}" name="delivery_method_edit_id" />
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="delivery_method_edit_name">{{ __('backend/management.delivery_methods.name') }}</label>
																<input type="text" class="form-control @if($errors->has('delivery_method_edit_name')) is-invalid @endif" id="delivery_method_edit_name" name="delivery_method_edit_name" placeholder="{{ __('backend/management.delivery_methods.name') }}" value="{{ $deliveryMethod->name }}" />

																@if($errors->has('delivery_method_edit_name'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('delivery_method_edit_name') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="delivery_method_edit_price">{{ __('backend/management.delivery_methods.price') }}</label>
																<input type="number" class="form-control @if($errors->has('delivery_method_edit_price')) is-invalid @endif" id="delivery_method_edit_price" name="delivery_method_edit_price" placeholder="{{ __('backend/management.delivery_methods.price') }}" value="{{ $deliveryMethod->price }}" />

																@if($errors->has('delivery_method_edit_price'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('delivery_method_edit_price') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="delivery_method_edit_min_amount">{{ __('backend/management.delivery_methods.min_amount') }}</label>
																<input type="number" class="form-control @if($errors->has('delivery_method_edit_min_amount')) is-invalid @endif" id="delivery_method_edit_min_amount" name="delivery_method_edit_min_amount" placeholder="{{ __('backend/management.delivery_methods.min_amount') }}" value="{{ $deliveryMethod->min_amount }}" />

																@if($errors->has('delivery_method_edit_min_amount'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('delivery_method_edit_min_amount') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="delivery_method_edit_max_amount">{{ __('backend/management.delivery_methods.max_amount') }}</label>
																<input type="number" class="form-control @if($errors->has('delivery_method_edit_max_amount')) is-invalid @endif" id="delivery_method_edit_max_amount" name="delivery_method_edit_max_amount" placeholder="{{ __('backend/management.delivery_methods.max_amount') }}" value="{{ $deliveryMethod->max_amount }}" />

																@if($errors->has('delivery_method_edit_max_amount'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('delivery_method_edit_max_amount') }}</strong>
																	</span>
																@endif
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger">{{ __('backend/management.delivery_methods.edit.submit_button') }}</button>
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
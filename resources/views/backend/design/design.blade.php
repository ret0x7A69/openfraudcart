@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/design.title') }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">{{ __('backend/design.title') }}</h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="{{ route('backend-design-form') }}">
													@csrf
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="logo">{{ __('backend/design.logo') }}</label>
																<br />
																<input id="logo" name="logo" class="form-control" value="{{ App\Models\Setting::get('theme.logo') }}" />
																@if($errors->has('logo'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('logo') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="favicon">{{ __('backend/design.favicon') }}</label>
																<br />
																<input id="favicon" name="favicon" class="form-control" value="{{ App\Models\Setting::get('theme.favicon') }}" />
																@if($errors->has('favicon'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('favicon') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="background">{{ __('backend/design.background') }}</label>
																<br />
																<input id="background" name="background" class="form-control" value="{{ App\Models\Setting::get('theme.background') }}" />
																@if($errors->has('background'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('background') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="pattern">{{ __('backend/design.pattern') }}</label>
																<br />
																<input id="pattern" name="pattern" class="form-control" value="{{ App\Models\Setting::get('theme.color1') }}" />
																@if($errors->has('pattern'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('pattern') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="custom_css">{{ __('backend/design.custom_css') }}</label>
																<br />
																<textarea id="custom_css" name="custom_css">{{ App\Models\Setting::get('theme.custom.css') }}</textarea>
																@if($errors->has('custom_css'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('custom_css') }}</strong>
																	</span>
																@endif
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger">{{ __('backend/design.submit_button') }}</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
@endsection

@section('page_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/addon/hint/show-hint.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/addon/hint/css-hint.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/mode/css/css.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/mode/htmlmixed/htmlmixed.min.js"></script>
<script src=""></script>
<script>
   	CodeMirror.fromTextArea(document.getElementById('custom_css'), {
    	lineNumbers: true,
    	mode: 'css',
  	});
</script>
@endsection
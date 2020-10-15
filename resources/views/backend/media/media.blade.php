@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/media.title') }}</h3>
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
														<h3 class="kt-portlet__head-title">{{ __('backend/media.title') }}</h3>
													</div>
												</div>
												
												<div class="kt-portlet__body">
													@if(count($errors) > 0)
														<div class="alert alert-danger fade show" role="alert">
															<div class="alert-text">
																@foreach ($errors->all() as $error)
																<li>{{ $error }}</li>
																@endforeach
															</div>
															<div class="alert-close">
																<button type="button" class="close" data-dismiss="alert" aria-label="{{ __('frontend/main.close') }}">
																	<span aria-hidden="true"><i class="la la-close"></i></span>
																</button>
															</div>
														</div>
													@endif

													<form action="{{ route('backend-media-upload') }}" class="kt-form" method="POST" enctype="multipart/form-data">
														@csrf

														<input type="file" name="media_file" /><br /><br />
														<button type="submit" class="btn btn-success">{{ __('backend/media.upload') }}</button>
													</form>

													<hr />

													@if(count($medias))
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th>{{ __('backend/media.preview') }}</th>
																	<th>{{ __('backend/media.filename') }}</th>
																	<th>{{ __('backend/media.date') }}</th>
																	<th>{{ __('backend/media.actions') }}</th>
																</tr>
															</thead>
															<tbody>
																@foreach($medias as $media)
																<tr>
																	<th scope="row">
																		<img src="{{ media($media->filename) }}" style="max-width: 40px;border:2px solid #ccc;border-radius:2px;padding:3px;" />
																	</th>
																	<td>{{ $media->filename }}</td>
																	<td>
																		{{ $media->created_at->format('d.m.Y H:i') }}
																	</td>
																	<td style="font-size: 20px;">
																		<a href="{{ media($media->filename) }}" target="_media"><i style="font-size: 18px;" class="fas fa-external-link-alt"></i></a>
																		<a href="{{ route('backend-media-delete', $media->id) }}"><i class="la la-trash"></i></a>
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>

														{!! preg_replace('/' . $medias->currentPage() . '\?page=/', '', $medias->links()) !!}
														@else
														<i>{{ __('backend/main.no_entries') }}</i>
														@endif
												</div>
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

<script>
   	CodeMirror.fromTextArea(document.getElementById('custom_css'), {
    	lineNumbers: true,
    	mode: 'css',
  	});
</script>
@endsection
@extends('backend.layouts.default')

@section('content')
								<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/orders.show.title', ['id' => $order->id]) }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-orders') }}" class="k-content__head-breadcrumb-link">{{ __('backend/orders.title') }}</a>
										</div>
									</div>
								</div>

								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">{{ __('backend/orders.notes') }}</h3>
													</div>
												</div>
												<div class="k-portlet__body">
													@foreach($notes as $note)

													<div class="user-order-note">
														{{ strlen($note->note) > 0 ? decrypt($note->note) : '' }}
														<span>{{ $note->getDateTime() }}</span>
													</div>
													
													@endforeach

													<hr />
													
													<form method="POST" action="{{ route('backend-orders-add-note-form', ['id' => $order->id]) }}" style="width: 100%;">
														@csrf
														
														<div class="form-group" style="width: 100%;">
															<label for="order_note">{{ __('backend/orders.note_input') }}</label>
															<textarea style="width: 100%;" class="form-control @if($errors->has('order_note')) is-invalid @endif" name="order_note" id="order_note" placeholder="">{{ old('order_note') }}</textarea>

															@if($errors->has('order_note'))
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong>{{ $errors->first('order_note') }}</strong>
																</span>
															@endif
														</div>
														
														<div class="form-group">
															<input type="submit" class="btn btn-wide btn-bold btn-danger" value="{{ __('backend/orders.add_note') }}" />
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
@endsection

@section('page_scripts')

@endsection
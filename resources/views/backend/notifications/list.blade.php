@extends('backend.layouts.default')

@section('content')
                            	<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/main.notifications.title') }}</h3>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<a href="{{ route('backend-notifications-clear') }}" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px">{{ __('backend/main.clear') }}</a>
											
											<div class="kt-portlet">
												<div class="kt-portlet__body">
													<div class="kt-section kt-section--first">
														@if(count($notifications))
															<div class="k-notification">
																@foreach($notifications as $notification)
																<div class="k-notification__item k-notification__item_no_icon">
																	<div class="k-notification__item-icon">
																		<i class="{{ $notification->getIcon() }}"></i>
																	</div>
																	<div class="k-notification__item-details">
																		<div class="k-notification__item-title">
																			{{ $notification->getMessage() }}
																		</div>
																		<div class="k-notification__item-time">
																			{{ $notification->created_at->format('d.m.Y H:i') }}
																		</div>
																		<div class="k-notification__item-time">
																		 	<a href="{{ route('backend-notification-delete', $notification->id) }}">
																			 	<i class="la la-trash"></i> {{ __('backend/main.notifications.delete') }}
																			</a>
																		</div>
																	</div>
																</div>
																@endforeach
															</div>
														@else
														<i>{{ __('backend/main.no_entries') }}</i>
														@endif

														<div style="margin-top: 15px;">
															{!! preg_replace('/' . $notifications->currentPage() . '\?page=/', '', $notifications->links()) !!}
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
@endsection

@section('page_scripts')

@endsection
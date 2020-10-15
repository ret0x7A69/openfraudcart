@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">Bestellungen von {{ htmlspecialchars($user->username) }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/management.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-management-users') }}" class="k-content__head-breadcrumb-link">{{ __('backend/management.users.title') }}</a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="kt-portlet">
												<div class="kt-portlet__body">
													<div class="kt-section kt-section--first">
														@if(count($orders))
														<table class="table">
															<thead class="">
																<tr>
																	<th>{{ __('backend/orders.table.id') }}</th>
																	<th>{{ __('backend/orders.table.product') }}</th>
																	<th>{{ __('backend/orders.table.date') }}</th>
																	<th>{{ __('backend/orders.table.delivery_method') }}</th>
																	<th>{{ __('backend/orders.table.notes') }}</th>
																	<th>{{ __('backend/orders.table.status') }}</th>
																	<th>{{ __('backend/orders.table.amount') }}</th>
																	<th>{{ __('backend/orders.table.actions') }}</th>
																</tr>
															</thead>
															<tbody>
																@foreach($orders as $order)
																<tr>
																	<th scope="row">{{ $order->id }}</th>
																	<td>{{ $order->name }}</td>
																	<td>
																		{{ $order->created_at->format('d.m.Y H:i') }}
																	</td>
																	<td>
																		@if($order->delivery_method)
																			{{ $order->delivery_method }}
																		@endif
																	</td>
																	<td>
																		@if(strlen($order->drop_info) > 0)
																			{!! nl2br(e(decrypt($order->drop_info))) !!}
																		@endif
																	</td>
																	<td>
																		@if($order->getStatus() == 'cancelled')
																			{{ __('backend/orders.status.cancelled') }}
																		@elseif($order->getStatus() == 'completed')
																			{{ __('backend/orders.status.completed') }}
																		@elseif($order->getStatus() == 'pending')
																		{{ __('backend/orders.status.pending') }}
																		@endif
																	</td>
																	<td>
																		@if($order->weight > 0)
																		{{ $order->weight }}{{ $order->weight_char }}
																		@else
																		{{ $order->getAmount() }}
																		@endif
																	</td>
																	<td style="font-size: 20px;">
																		<a href="{{ route('backend-order-id', $order->id) }}" data-toggle="tooltip" data-original-title="{{ __('backend/orders.view') }}"><i class="la la-eye"></i></a>
																		
																		@if($order->getStatus() != 'completed' && $order->getStatus() != 'cancelled')
																		<a href="{{ route('backend-user-order-complete', [$user->id, $order->id]) }}" data-toggle="tooltip" data-original-title="{{ __('backend/orders.complete') }}"><i class="la la-check"></i></a>
																		@endif

																		@if($order->getStatus() != 'cancelled')
																		<a href="{{ route('backend-user-order-cancel', [$user->id, $order->id]) }}" data-toggle="tooltip" data-original-title="{{ __('backend/orders.cancel') }}"><i class="la la-close"></i></a>
																		@endif

																		<a href="{{ route('backend-user-order-delete', [$user->id, $order->id]) }}" data-toggle="tooltip" data-original-title="{{ __('backend/orders.delete') }}"><i class="la la-trash"></i></a>
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>

														{!! preg_replace('/' . $orders->currentPage() . '\?page=/', '', $orders->links()) !!}
														@else
														<i>{{ __('backend/main.no_entries') }}</i>
														@endif
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
@endsection

@section('page_scripts')

@endsection
@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">Tickets von {{ htmlspecialchars($user->username) }}</h3>
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
														@if(count($tickets))
														<table class="table">
															<thead class="">
																<tr>
																	<th>
																		<span>#</span>
																	</th>
																	<th>
																		<span>Betreff</span>
																	</th>
																	<th>
																		<span>Status</span>
																	</th>
																	<th>
																		<span>Datum</span>
																	</th>
																	<th style="text-align:right;">
																		<span>Aktionen</span>
																	</th>
																</tr>
															</thead>
															<tbody>
																@foreach($tickets as $ticket)
																<tr>
																	<td>
																		{{ $ticket->id }}
																	</td>
																	<td>
																		{{ htmlspecialchars($ticket->subject) }}
																	</td>
																	<td>
																		@if($ticket->isClosed())
																		<span class="kt-badge kt-badge--danger kt-badge--dot kt-badge--md"></span>
																		<span class="kt-label-font-color-2 kt-font-bold">{{ __('backend/dashboard.recent_tickets.status_data.closed') }}</span>
																		@elseif($ticket->isReplied())
																		<span class="kt-badge kt-badge--brand kt-badge--dot kt-badge--md"></span>
																		<span class="kt-label-font-color-2 kt-font-bold">{{ __('backend/dashboard.recent_tickets.status_data.replied') }}</span>
																		@else
																		<span class="kt-badge kt-badge--success kt-badge--dot kt-badge--md"></span>
																		<span class="kt-label-font-color-2 kt-font-bold">{{ __('backend/dashboard.recent_tickets.status_data.open') }}</span>
																		@endif
																	</td>	
																	<td>
																		{{ $ticket->created_at->format('d.m.Y H:i') }}
																	</td>
																	<td style="text-align:right;">
																		<a href="{{ route('backend-management-ticket-edit', $ticket->id) }}" class="btn btn-clean  btn-sm btn-icon-md">
																			<i class="la la-edit"></i> {{ __('backend/dashboard.recent_tickets.edit') }}
																		</a>
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>

														{!! preg_replace('/' . $tickets->currentPage() . '\?page=/', '', $tickets->links()) !!}
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
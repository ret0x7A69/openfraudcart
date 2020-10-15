@extends('backend.layouts.default')

@section('content')
                            	<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.tickets.categories.title') }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/management.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-management-tickets') }}" class="k-content__head-breadcrumb-link">{{ __('backend/management.tickets.title') }}</a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<a href="{{ route('backend-management-ticket-category-add') }}" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px">{{ __('backend/main.add') }}</a>

											<div class="kt-portlet">
												<div class="kt-portlet__body">
													<div class="kt-section kt-section--first">
														@if(count($ticketsCategories))
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th>{{ __('backend/management.tickets.categories.id') }}</th>
																	<th>{{ __('backend/management.tickets.categories.name') }}</th>
																	<th>{{ __('backend/management.tickets.categories.actions') }}</th>
																</tr>
															</thead>
															<tbody>
																@foreach($ticketsCategories as $ticketCategory)
																<tr>
																	<th scope="row">{{ $ticketCategory->id }}</th>
																	<td>{{ $ticketCategory->name }}</td>
																	<td style="font-size: 20px;">
																		<a href="{{ route('backend-management-ticket-category-edit', $ticketCategory->id) }}"><i class="la la-edit"></i></a>
																		<a href="{{ route('backend-management-ticket-category-delete', $ticketCategory->id) }}"><i class="la la-trash"></i></a>
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>
														@else
														<i>{{ __('backend/main.no_entries') }}</i>
														@endif

														{!! preg_replace('/' . $ticketsCategories->currentPage() . '\?page=/', '', $ticketsCategories->links()) !!}
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
@endsection

@section('page_scripts')

@endsection
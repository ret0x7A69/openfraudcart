@extends('backend.layouts.default')

@section('content')
                            	<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">Mehrfach Bestellungen</h3>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
										<a href="{{ route('backend-orders') }}" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px">Einzelne Bestellungen</a>
										<div class="kt-portlet">
												<div class="kt-portlet__body">
													<div class="kt-section kt-section--first">
														@if(count($shoppings))

														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th>ID</th>
																	<th>Benutzer</th>
																	<th>Bestellungen</th>
																	<th>Abgearbeitet</th>
																	<th>Aktionen</th>
																</tr>
															</thead>
															<tbody>
														@foreach($shoppings as $shopping)
														<tr>
															<th scope="row">{{ $shopping->id }}</th>
															<td>{{ $shopping->getUser()->name }}</td>
															<td>{{ count($shopping->getOrders()) }}</td>
															<td>{{ $shopping->isDone() ? 'Ja' : 'Nein' }}</td>
															<td>
															@if(!$shopping->isDone()) 
															<a href="{{ route('backend-shopping-done', $shopping->id) }}" data-toggle="tooltip" data-original-title="Als abgearbeitet markieren">Als abgearbeitet markieren</a>
															| @endif
															<a href="{{ route('backend-shopping-id', $shopping->id) }}" data-toggle="tooltip" data-original-title="Ansehen">Ansehen</a>
															</td>
														</tr>
														@endforeach
															</tbody>
														</table>

														{!! preg_replace('/' . $shoppings->currentPage() . '\?page=/', '', $shoppings->links()) !!}
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
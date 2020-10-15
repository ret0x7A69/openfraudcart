@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.users.title') }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/management.title') }}</a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="kt-portlet">
												<div class="kt-portlet__body">
													<div class="kt-section kt-section--first">
														@if(count($users))
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th>{{ __('backend/management.users.id') }}</th>
																	<!--
																	<th>{{ __('backend/management.users.name') }}</th>
																	-->	
																	<th>{{ __('backend/management.users.username') }}</th>
																	<th>{{ __('backend/management.users.jabber') }}</th>
																	<th>{{ __('backend/management.users.newsletter_enabled') }}</th>
																	<th>{{ __('backend/management.users.balance') }}</th>
																	<th>{{ __('backend/management.users.date') }}</th>
																	<th>{{ __('backend/management.users.actions') }}</th>
																</tr>
															</thead>
															<tbody>
																@foreach($users as $user)
																<tr>
																	<th scope="row">{{ $user->id }}</th>
																	<!--
																	<td>{{ $user->name }}</td>
																	-->
																	<td>{{ $user->username }}</td>
																	<td>{{ $user->jabber_id }}</td>
																	<td>{{ $user->newsletter_enabled == 1 ? __('backend/management.users.enabled') : __('backend/management.users.disabled') }}</td>
																	<td>{{ $user->getFormattedBalance() }}</td>
																	<td>
																		{{ $user->created_at->format('d.m.Y H:i') }}
																	</td>
																	<td style="font-size: 20px;">
																		<a href="{{ route('backend-management-user-edit', $user->id) }}"><i class="la la-edit"></i></a>
																		<a href="{{ route('backend-management-user-delete', $user->id) }}"><i class="la la-trash"></i></a>
																		<a href="{{ route('backend-management-user-login', $user->id) }}"><i class="la la-sign-in"></i></a>
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>

														{!! preg_replace('/' . $users->currentPage() . '\?page=/', '', $users->links()) !!}
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
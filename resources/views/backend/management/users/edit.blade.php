@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.users.edit.title') }}</h3>
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
										<div class="col-lg-12">
											<a href="{{ route('backend-management-user-tickets', $user->id) }}" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px">Alle Tickets</a>
											<a href="{{ route('backend-management-user-orders', $user->id) }}" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px">Alle Bestellungen</a>
											
											
										</div>
										<div class="col-lg-12 col-xl-3 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head  k-portlet__head--noborder">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">{{ __('backend/management.users.widget1.title') }}</h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<div class="k-widget-20">
														<div class="k-widget-20__title">
															<div class="k-widget-20__label">{{ App\Models\UserTransaction::where('user_id', $user->id)->count() }}</div>
															<img class="k-widget-20__bg" src="{{ asset_dir('admin/assets/media/misc/iconbox_bg.png') }}" alt="bg" />
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-12 col-xl-3 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head  k-portlet__head--noborder">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">{{ __('backend/management.users.widget2.title') }}</h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<div class="k-widget-20">
														<div class="k-widget-20__title">
															<div class="k-widget-20__label">{{ App\Models\UserTicket::where('user_id', $user->id)->count() }}</div>
															<img class="k-widget-20__bg" src="{{ asset_dir('admin/assets/media/misc/iconbox_bg.png') }}" alt="bg" />
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="col-lg-12 col-xl-3 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head  k-portlet__head--noborder">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">{{ __('backend/management.users.widget3.title') }}</h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<div class="k-widget-20">
														<div class="k-widget-20__title">
															<div class="k-widget-20__label">{{ App\Models\UserOrder::where('user_id', $user->id)->count() }}</div>
															<img class="k-widget-20__bg" src="{{ asset_dir('admin/assets/media/misc/iconbox_bg.png') }}" alt="bg" />
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="col-lg-12 col-xl-3 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head  k-portlet__head--noborder">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">{{ __('backend/management.users.widget4.title') }}</h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<div class="k-widget-20">
														<div class="k-widget-20__title">
															<div class="k-widget-20__label">{{ App\Models\UserPermission::where('user_id', $user->id)->count() }}</div>
															<img class="k-widget-20__bg" src="{{ asset_dir('admin/assets/media/misc/iconbox_bg.png') }}" alt="bg" />
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="k-portlet">
												<div class="k-portlet__head k-portlet__head--lg k-portlet__head--noborder k-portlet__head--break-sm">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">
															Offene Tickets von {{ htmlspecialchars($user->username) }}
															<small>Insgesamt {{ count($tickets) }} offene Tickets</small>
														</h3>
													</div>
												</div>
												<div class="k-portlet__body">
													<div class="k-datatable k-datatable--default k-datatable--brand k-datatable--error k-datatable--loaded k-datatable--scroll" id="k_recent_tickets">
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
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">{{ __('backend/management.users.edit.title') }}</h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="{{ route('backend-management-user-edit-form') }}">
													@csrf

													<input type="hidden" value="{{ $user->id }}" name="user_edit_id" />
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="user_edit_name">{{ __('backend/management.users.name') }}</label>
																<input type="text" class="form-control @if($errors->has('user_edit_name')) is-invalid @endif" id="user_edit_name" name="user_edit_name" placeholder="{{ __('backend/management.users.name') }}" value="{{ $user->name }}" />

																@if($errors->has('user_edit_name'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('user_edit_name') }}</strong>
																	</span>
																@endif
															</div>
															
															<div class="form-group">
																<label for="user_edit_username">{{ __('backend/management.users.username') }}</label>
																<input type="text" class="form-control @if($errors->has('user_edit_username')) is-invalid @endif" id="user_edit_username" placeholder="{{ __('backend/management.users.username') }}" value="{{ $user->username }}" disabled="true" />
															</div>

															<div class="form-group">
																<label for="user_edit_jabber">{{ __('backend/management.users.jabber') }}</label>
																<input type="text" class="form-control @if($errors->has('user_edit_jabber')) is-invalid @endif" id="user_edit_jabber" name="user_edit_jabber" placeholder="{{ __('backend/management.users.jabber') }}" value="{{ $user->jabber_id }}" />

																@if($errors->has('user_edit_jabber'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('user_edit_jabber') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="user_edit_balance">{{ __('backend/management.users.balance_in_cent') }}</label>
																<input type="number" class="form-control @if($errors->has('user_edit_balance')) is-invalid @endif" id="user_edit_balance" name="user_edit_balance" placeholder="{{ __('backend/management.users.balance') }}" value="{{ $user->balance_in_cent }}" />

																@if($errors->has('user_edit_balance'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('user_edit_balance') }}</strong>
																	</span>
																@endif
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger">{{ __('backend/management.users.edit.submit_button') }}</button>
														</div>
													</div>
												</form>
											</div>
										</div>

										@if(Auth::user()->hasPermission('manage_users_permissions'))
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">{{ __('backend/management.users.edit.permissions.title') }}</h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="{{ route('backend-management-user-update-permissions-form') }}">
													@csrf

													<input type="hidden" value="{{ $user->id }}" name="user_edit_id" />
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															@foreach(App\Models\Permission::all() as $permission)
															<div class="form-group">
																<label class="k-checkbox k-checkbox--all k-checkbox--solid">
																	<input type="checkbox" name="user_edit_permissions[]" value="{{ $permission->id }}" @if($user->hasPermission($permission->permission)) checked @endif />
																	<span></span>
																	@if(\Lang::has('backend/permissions.' . $permission->permission))
																	{{ __('backend/permissions.' . $permission->permission) }}
																	@else
																	{{ $permission->permission }}
																	@endif
																</label>
															</div>
															@endforeach
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger">{{ __('backend/management.users.edit.save_button') }}</button>
														</div>
													</div>
												</form>
											</div>
										</div>
										@endif
									</div>
								</div>
@endsection

@section('page_scripts')

@endsection
@extends('backend.layouts.default')

@section('content')
                            	<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.products.database.title') }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/management.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-management-products') }}" class="k-content__head-breadcrumb-link">{{ __('backend/management.products.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-management-product-edit', $product->id) }}" class="k-content__head-breadcrumb-link">{{ $product->name }}</a>
										</div>
									</div>
								</div>

								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-4 order-lg-1 order-xl-1">
											<div class="k-portlet">
												<div class="k-portlet__head  k-portlet__head--noborder">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">{{ __('backend/management.products.database.widget1.title') }}</h3>
													</div>
												</div>
												<div class="k-portlet__body">
													<div class="k-widget-20">
														<div class="k-widget-20__title">
															<div class="k-widget-20__label">{{ count(App\Models\ProductItem::where('product_id', $product->id)->get()) }}</div>
															<img class="k-widget-20__bg" src="{{ asset_dir('admin/assets/media/misc/iconbox_bg.png') }}" alt="bg" />
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="col-lg-12 col-xl-8 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">
														@if(isset($databaseItemsSearch))
														{{ __('backend/management.products.database.title2', ['count' => 'Suchtreffer: ' . $databaseItemsSearch]) }}
														@else
														{{ __('backend/management.products.database.title2', ['count' => $databaseItems]) }}
														@endif
														</h3>
													</div>
												</div>
												<div class="k-portlet__body">
													<form method="POST" action="{{ route('backend-management-product-database-search', $product->id) }}">
														@csrf
														<div class="">
														<div class="">
															<div class="col-md-6" style="padding:0;margin:0;">
														<input type="text" class="form-control" name="search_input" value="{{ $search ?? '' }}" placeholder="Suchbegriff eingeben..." />
														<br />
														<label>
															<input type="checkbox" class="checkbox" name="search_regex" @if(isset($regex) && $regex) checked @endif/> Regex?
														</label>
														<br />
														<input type="submit" class="btn btn-primary btn-inlineblock" value="Suchen" />
														<hr/>
														</div>
														</div>
														</div>
													</form>

													{!! preg_replace('/' . $database->currentPage() . '\?page=/', '', $database->links()) !!}
												
													<table class="table">
														<thead>
															<tr>
																<th>
																	Inhalt
																</th>
																<th style="text-align:right;">
																	Datum
																</th>
																<th style="text-align:right;">
																	Aktionen
																</th>
															</tr>
														</thead>
														<tbody>
															@foreach($database as $databaseItem)
															<tr>
																<td>
																	@if(strlen($databaseItem->content) > 0)
																	{{ decrypt($databaseItem->content) }}
																	@endif
																</td>
																<td style="text-align:right;">
																	{{ $databaseItem->created_at }}
																</td>
																<td style="text-align:right;">
																	<a style="font-size:16px;" href="{{ route('backend-management-product-database-edit', $databaseItem->id) }}" data-toggle="tooltip" data-original-title="{{ __('backend/main.tooltips.edit') }}"><i class="la la-edit"></i></a>
																	<a style="font-size:16px;" href="{{ route('backend-management-product-database-delete', $databaseItem->id) }}" data-toggle="tooltip" data-original-title="{{ __('backend/main.tooltips.delete') }}"><i class="la la-trash"></i></a>
																</td>
															</tr>
															@endforeach
														</tbody>
													</table>

													{!! preg_replace('/' . $database->currentPage() . '\?page=/', '', $database->links()) !!}
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">{{ __('backend/management.products.database.import.txt.title') }}</h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<form method="POST" action="{{ route('backend-management-product-database-import-txt') }}" style="width: 100%;">
														@csrf
														
														<input type="hidden" name="product_id" value="{{ $product->id }}" />

														<div class="form-group" style="width: 100%;">
															<label for="import_txt_input">{{ __('backend/management.products.database.import.txt.input') }}</label>
															<textarea style="width: 100%;" class="form-control @if($errors->has('import_txt_input')) is-invalid @endif" name="import_txt_input" id="import_txt_input" placeholder="{{ __('backend/management.products.database.import.txt.input') }}">{{ old('import_txt_input') }}</textarea>

															@if($errors->has('import_txt_input'))
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong>{{ $errors->first('import_txt_input') }}</strong>
																</span>
															@endif
														</div>

														<div style="margin-bottom: 5px;">
															<b>{{ __('backend/management.products.database.import.options') }}</b>
														</div>
															
														<div class="form-group">
															<label class="k-radio k-radio--all k-radio--solid">
																<input type="radio" name="product_import_txt_option" value="linebyline" checked />
																<span></span>
																{{ __('backend/management.products.database.import.line_by_line') }}
															</label>
														</div>
															
														<div class="form-group">
															<label class="k-radio k-radio--all k-radio--solid">
																<input type="radio" name="product_import_txt_option" value="seperator" />
																<span></span>
																{{ __('backend/management.products.database.import.with_seperator') }}
															</label>
															
															<input type="text" class="form-control" value="@if(strlen(App\Models\Setting::get('import.custom.delimiter')) > 0){{ App\Models\Setting::get('import.custom.delimiter') }}@endif" name="product_import_txt_seperator_input" />
															@if($errors->has('product_import_txt_seperator_input'))
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong>{{ $errors->first('product_import_txt_seperator_input') }}</strong>
																</span>
															@endif
														</div>

														
														<div class="form-group">
															<input type="submit" class="btn btn-wide btn-bold btn-danger" value="{{ __('backend/management.products.database.import.submit_button') }}" />
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">{{ __('backend/management.products.database.import.one.title') }}</h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<form method="POST" action="{{ route('backend-management-product-database-import-one') }}" style="width: 100%;">
														@csrf
														
														<input type="hidden" name="product_id" value="{{ $product->id }}" />

														<div class="form-group" style="width: 100%;">
															<label for="import_one_content">{{ __('backend/management.products.database.import.one.content') }}</label>
															<textarea style="width: 100%;" class="form-control @if($errors->has('import_one_content')) is-invalid @endif" name="import_one_content" id="import_one_content" placeholder="{{ __('backend/management.products.database.import.one.content') }}">{{ old('import_one_content') }}</textarea>

															@if($errors->has('import_one_content'))
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong>{{ $errors->first('import_one_content') }}</strong>
																</span>
															@endif
														</div>

														<div class="form-group">
															<input type="submit" class="btn btn-wide btn-bold btn-danger" value="{{ __('backend/management.products.database.import.submit_button') }}" />
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
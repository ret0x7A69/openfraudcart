@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.articles.title') }}</h3>
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
											<a href="{{ route('backend-management-article-add') }}" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px">{{ __('backend/main.add') }}</a>

											<div class="kt-portlet">
												<div class="kt-portlet__body">
													<div class="kt-section kt-section--first">
														@if(count($articles))
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th>{{ __('backend/management.articles.id') }}</th>
																	<th>{{ __('backend/management.articles.article_title') }}</th>
																	<th>{{ __('backend/management.articles.author') }}</th>
																	<th>{{ __('backend/management.articles.date') }}</th>
																	<th>{{ __('backend/management.articles.actions') }}</th>
																</tr>
															</thead>
															<tbody>
																@foreach($articles as $article)
																<tr>
																	<th scope="row">{{ $article->id }}</th>
																	<td>{{ $article->title }}</td>
																	<td>
																		{{ $article->getUser()->username }}
																	</td>
																	<td>
																		{{ $article->created_at->format('d.m.Y H:i') }}
																	</td>
																	<td style="font-size: 20px;">
																		<a href="{{ route('backend-management-article-edit', $article->id) }}"><i class="la la-edit"></i></a>
																		<a href="{{ route('backend-management-article-delete', $article->id) }}"><i class="la la-trash"></i></a>
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>

														{!! preg_replace('/' . $articles->currentPage() . '\?page=/', '', $articles->links()) !!}
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
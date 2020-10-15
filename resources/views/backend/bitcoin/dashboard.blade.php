@extends('backend.layouts.default')

@section('content')
                            	<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/bitcoin.title') }}</h3>
									</div>
								</div>

								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									@if($isConnected)
									<div class="row">
										<div class="col-lg-6 col-xl-4 order-lg-2 order-xl-1">
											<div class="k-portlet k-widget-12">
												<div class="k-portlet__body">
													<div class="k-widget-12__body">
														<div class="k-widget-12__head">
															<div class="k-widget-12__date k-widget-12__date--warning">
																<i class="fab fa-bitcoin" style="font-size: 24px;"></i>
															</div>
															<div class="k-widget-12__label">
																<h3 class="k-widget-12__title">{{ __('backend/bitcoin.balance') }}</h3>
																<span class="k-widget-12__desc">
																	{{ App\Classes\BitcoinAPI::getFormattedServerBalance() }}
																	{{ App\Classes\BitcoinAPI::getFormattedServerBalanceCurrency(App\Models\Setting::getShopCurrency()) }}
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="k-portlet">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">{{ __('backend/bitcoin.primarywallet.title') }}</h3>
													</div>
												</div>
												<div class="k-portlet__body">
													<p>
														{!! __('backend/bitcoin.primarywallet.info') !!}
													</p>

													<form method="POST" action="{{ route('backend-bitcoin-primarywallet-form') }}">
														@csrf
														
														<div class="form-group" style="width: 100%;">
															<label for="bitcoin_primarywallet_address">{{ __('backend/bitcoin.primarywallet.walletaddress') }}</label>
															<input type="text" class="form-control @if($errors->has('bitcoin_primarywallet_address')) is-invalid @endif" name="bitcoin_primarywallet_address" id="bitcoin_primarywallet_address" placeholder="{{ __('backend/bitcoin.primarywallet.walletaddress') }}" value="{{ strlen(App\Models\Setting::get('bitcoin.primarywallet')) > 0 ? decrypt(App\Models\Setting::get('bitcoin.primarywallet')) : '' }}" />

															@if($errors->has('bitcoin_primarywallet_address'))
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong>{{ $errors->first('bitcoin_primarywallet_address') }}</strong>
																</span>
															@endif
														</div>
														
														<div class="form-group">
															<input type="submit" class="btn btn-wide btn-bold btn-danger" value="{{ __('backend/bitcoin.primarywallet.submit_button') }}" />
														</div>
													</form>
												</div>
											</div>

											<div class="k-portlet">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">{{ __('backend/bitcoin.generateaddress.title') }}</h3>
													</div>
												</div>
												<div class="k-portlet__body">
													<div class="form-group" style="width: 100%;">
														<input type="text" onClick="$(this).select()" class="form-control text-center" value="{{ App\Classes\BitcoinAPI::getBitcoinClient()->getnewaddress(Auth::user()->username, 'p2sh-segwit') }}" readonly />
													</div>

													<div class="form-group">
														<a href="{{ route('backend-bitcoin-dashboard') }}" class="btn btn-wide btn-bold btn-danger">{{ __('backend/bitcoin.generateaddress.regenerate') }}</a>
													</div>
												</div>
											</div>

											<div class="k-portlet">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">{{ __('backend/bitcoin.sendbtc.title') }}</h3>
													</div>
												</div>
												<div class="k-portlet__body">
													<form method="POST" action="{{ route('backend-bitcoin-sendbtc-form') }}">
														@csrf
														
														<div class="form-group" style="width: 100%;">
															<label for="bitcoin_sendbtc_address">{{ __('backend/bitcoin.sendbtc.walletaddress') }}</label>
															<input type="text" class="form-control @if($errors->has('bitcoin_sendbtc_address')) is-invalid @endif" name="bitcoin_sendbtc_address" id="bitcoin_sendbtc_address" placeholder="{{ __('backend/bitcoin.sendbtc.walletaddress') }}" value="{{ old('bitcoin_sendbtc_address') }}" />

															@if($errors->has('bitcoin_sendbtc_address'))
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong>{{ $errors->first('bitcoin_sendbtc_address') }}</strong>
																</span>
															@endif
														</div>
														
														<div class="form-group" style="width: 100%;">
															<label for="bitcoin_sendbtc_amount">{{ __('backend/bitcoin.sendbtc.amount') }}</label>
															<input type="text" class="form-control @if($errors->has('bitcoin_sendbtc_amount')) is-invalid @endif" name="bitcoin_sendbtc_amount" id="bitcoin_sendbtc_amount" placeholder="{{ __('backend/bitcoin.sendbtc.amount') }}" value="{{ old('bitcoin_sendbtc_amount') }}" />

															@if($errors->has('bitcoin_sendbtc_amount'))
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong>{{ $errors->first('bitcoin_sendbtc_amount') }}</strong>
																</span>
															@endif
														</div>
														
														<div class="form-group" style="width: 100%;">
															<label for="bitcoin_sendbtc_fee">{{ __('backend/bitcoin.sendbtc.fee') }}</label>
															<input type="text" class="form-control @if($errors->has('bitcoin_sendbtc_fee')) is-invalid @endif" name="bitcoin_sendbtc_fee" id="bitcoin_sendbtc_fee" placeholder="{{ __('backend/bitcoin.sendbtc.fee') }}" value="{{ App\Classes\BitcoinAPI::getRecommendedFee()['btc'] }}" />
															<small>
																{!! __('backend/bitcoin.sendbtc.fee_info', [
																	'btc' => App\Classes\BitcoinAPI::getRecommendedFee()['btc'],
																	'satoshi' => App\Classes\BitcoinAPI::getRecommendedFee()['satoshi']
																]) !!}
															</small>
															
															@if($errors->has('bitcoin_sendbtc_fee'))
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong>{{ $errors->first('bitcoin_sendbtc_fee') }}</strong>
																</span>
															@endif
														</div>
														
														<div class="form-group">
															<input type="submit" class="btn btn-wide btn-bold btn-danger" value="{{ __('backend/bitcoin.sendbtc.submit_button') }}" />
														</div>
													</form>
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-xl-8 order-lg-1 order-xl-1">
											<div class="k-portlet">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">{{ __('backend/bitcoin.transactions.title') }}</h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													@if(count($transactions))
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th scope="col">{{ __('backend/bitcoin.transactions.wallet') }}</th>
																	<th scope="col">{{ __('backend/bitcoin.transactions.txid') }}</th>
																	<th scope="col">{{ __('backend/bitcoin.transactions.amount') }}</th>
																	<th scope="col">{{ __('backend/bitcoin.transactions.status') }}</th>
																	<th scope="col">{{ __('backend/bitcoin.transactions.date') }}</th>
																</tr>
															</thead>
															<tbody>
																@foreach($transactions as $transaction)
																<tr>
																	<td>{{ $transaction['address'] }}</td>
																	<td style="max-width:200px;word-break:break-all;">
																		@if(strlen($transaction['txid']) > 0)
																			<div>
																				<a href="https://blockchain.info/tx/{{ $transaction['txid'] }}" target="_blockchain_{{ $loop->iteration }}">
																					{{ $transaction['txid'] }}
																					<ion-icon name="open"></ion-icon>
																				</a>
																			</div>
																		@endif
																	</td>
																	<td class="@if($transaction['category'] == 'receive') text-success @else text-danger @endif">
																		{{ $transaction['amount'] }} BTC
																	</td>
																	<td class="">
																		@if($transaction['confirmations'] > 0)
																			{{ __('backend/bitcoin.transactions.confirmed') }}
																		@else
																			{{ __('backend/bitcoin.transactions.confirmations', [
																				'confirms' => $transaction['confirmations'],
																				'confirms_needed' => App\Models\Setting::get('shop.btc_confirms_needed')
																			]) }}
																		@endif
																	</td>
																	<td>
																		{{ date('d.m.Y H:i', $transaction['time']) }}
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>
													@else
														<i>{{ __('backend/bitcoin.transactions.no_entries') }}</i>
													@endif

													{!! preg_replace('/' . $transactions->currentPage() . '\?page=/', '', $transactions->links()) !!}
												</div>
											</div>
										</div>
									</div>
									@else
										<div class="alert alert-danger">
											<div class="alert-text">
												{!! __('backend/bitcoin.connection_error', [
													'url' => route('backend-system-payments')
												]) !!}
											</div>
										</div>

									@endif
								</div>
@endsection

@section('page_scripts')

@endsection
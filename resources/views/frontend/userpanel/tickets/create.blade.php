@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">{{ __('frontend/user.tickets.ticket_create') }}</h3>

            <div class="card">
                <div class="card-header">{{ __('frontend/user.tickets.ticket_create') }}</div>
                <div class="card-body">
					
						@if (\Session::has('errorMessageTicketForm'))
							<div class="container">
								<div class="row justify-content-center">
									<div class="col-md-12">
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="{{ __('frontend/main.close') }}">
												<span aria-hidden="true">×</span>
											</button>

											{!! \Session::get('errorMessageTicketForm') !!}
										</div>
									</div>
								</div>
							</div>
						@endif

						@if (\Session::has('successMessageTicketForm'))
							<div class="container">
								<div class="row justify-content-center">
									<div class="col-md-12">
										<div class="alert alert-success alert-dismissible fade show" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="{{ __('frontend/main.close') }}">
												<span aria-hidden="true">×</span>
											</button>

											{!! \Session::get('successMessageTicketForm') !!}
										</div>
									</div>
								</div>
							</div>
						@endif
						
						<form method="POST" action="{{ route('ticket-create') }}">
							@csrf

							<div class="form-group">
								<label for="subject">{{ __('frontend/user.tickets.subject') }}</label>
								<input class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" value="{{ old('subject') }}" name="subject" id="subject" required autofocus />

								@if ($errors->has('subject'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('subject') }}</strong>
									</span>
								@endif
							</div>

							<div class="form-group">
								<label for="ticket_category">{{ __('frontend/user.tickets.category') }}</label>
								<select class="form-control{{ $errors->has('ticket_category') ? ' is-invalid' : '' }}" name="ticket_category" id="ticket_category">
									<option value="0">{{ __('frontend/main.please_choose') }}</option>
									@foreach(\App\Models\UserTicketCategory::orderBy('name')->get() as $userTicketCategory)
									<option value="{{ $userTicketCategory->id }}" @if(old('ticket_category') == $userTicketCategory->id) selected @endif>{{ \App\Classes\LangHelper::getValue(app()->getLocale(), 'ticket-category', null, $userTicketCategory->id) ?? $userTicketCategory->name }}</option>
									@endforeach
								</select>

								@if ($errors->has('ticket_category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ticket_category') }}</strong>
                                    </span>
                                @endif
							</div>

							<div class="form-group">
								<label for="message">{{ __('frontend/user.tickets.message') }}</label>
								<textarea class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" id="message" rows="3" required>{{ old('message') }}</textarea>

								@if ($errors->has('message'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
							</div>

							<div class="form-group">
								<label for="captcha">{{ __('frontend/main.captcha') }}</label>
								<div class="captcha-img">
									{!! captcha_img('math') !!}
								</div>
								<input type="text" class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}" name="captcha" id="captcha" required />

								@if ($errors->has('captcha'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
							</div>

							<div class="text-left">
								<input type="submit" value="{{ __('frontend/user.tickets.create_button') }}" class="btn btn-primary" />
							</div>
						</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

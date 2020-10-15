@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">{{ __('frontend/user.tickets.ticket_details') }}</h3>

            <div class="card">
                <div class="card-header">{{ $ticket->subject }}</div>
                <div class="card-body">
					<div class="ticket-reply ">
						{!! nl2br(strlen($ticket->content) > 0 ? e(decrypt($ticket->content)) : '') !!}

						<span class="ticket-reply-span">{{ $ticket->getDateTime() }}</span>
					</div>

					@if(count($ticketReplies) > 0)
					<hr />
					@endif

					@foreach($ticketReplies as $ticketReply)
					<div class="ticket-reply @if($ticketReply->user_id == Auth::user()->id)  @else ticket-reply-answer @endif">
						{!! nl2br(strlen($ticketReply->content) > 0 ? e(decrypt($ticketReply->content)) : '') !!}

						<span class="ticket-reply-span">{{ $ticketReply->getDateTime() }}</span>
					</div>
					@endforeach

					@if(!$ticket->isClosed())
						<hr />

						<h5>{{ __('frontend/user.tickets.reply_title') }}</h5>

						<form method="POST" action="{{ route('ticket-reply', $ticket->id) }}">
							@csrf

							<div class="form-group">
								<label for="message">{{ __('frontend/user.tickets.message') }}</label>
								<textarea class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" id="message" rows="3" required autofocus>{{ old('message') }}</textarea>
								
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
								<input type="submit" value="{{ __('frontend/user.tickets.reply_button') }}" class="btn btn-primary" />
							</div>
						</form>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

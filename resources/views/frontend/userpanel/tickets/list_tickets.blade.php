@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">{{ __('frontend/user.tickets.list_tickets') }}</h3>

            @if(count($user_tickets))
            <div class="card">
                <div class="card-header">{{ __('frontend/user.tickets.list_tickets') }}</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-tickets table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('frontend/user.tickets.id') }}</th>
                                    <th scope="col">{{ __('frontend/user.tickets.subject') }}</th>
                                    <th scope="col">{{ __('frontend/user.tickets.category') }}</th>
                                    <th scope="col">{{ __('frontend/user.tickets.status') }}</th>
                                    <th scope="col">{{ __('frontend/user.tickets.date') }}</th>
                                    <th scope="col">{{ __('frontend/user.tickets.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user_tickets as $ticket)
                                <tr class="@if($ticket->isClosed()) bg-light @elseif($ticket->isReplied()) bg-light-2 @endif">
                                    <th scope="row">#{{ $ticket->id }}</th>
									
                                    <td>
										<a href="{{ route('ticket-id', $ticket->id) }}">{{ substr($ticket->subject, 0, 255) }}</a>
									</td>
									
                                    <td>{{ $ticket->getCategory()->name }}</td>
                                    
                                    <td>
                                        @if($ticket->isClosed())
										    {{ __('frontend/user.tickets.status_data.closed') }}
										@else
											@if(!$ticket->isReplied())
                                                {{ __('frontend/user.tickets.status_data.open') }}
											@else
                                                {{ __('frontend/user.tickets.status_data.replied') }}
											@endif
										@endif
                                    </td>
                                    <td>
                                        {{ $ticket->getDate() }}
                                    </td>
                                    <td>
										<a href="{{ route('ticket-id', $ticket->id) }}">{{ __('frontend/user.tickets.view') }}</a>
										<span class="span-divider">|</span>
										<a href="{{ route('ticket-delete', $ticket->id) }}">{{ __('frontend/user.tickets.delete') }}</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! preg_replace('/' . $user_tickets->currentPage() . '\?page=/', '', $user_tickets->links()) !!}
                </div>
            </div>
            @else
                <div class="alert alert-warning">
                    {{ __('frontend/user.tickets.no_tickets_exists') }}
                </div>  
            @endif
        </div>
    </div>
</div>
@endsection

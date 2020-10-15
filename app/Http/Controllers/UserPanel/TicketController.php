<?php

namespace App\Http\Controllers\UserPanel;

    use App\Http\Controllers\Controller;
    use App\Models\UserTicket;
    use App\Models\UserTicketReply;
    use App\Rules\RuleUserTicketCategoryExists;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Validator;

    class TicketController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
        }

        public function deleteTicket($id)
        {
            UserTicket::where('user_id', Auth::user()->id)->where('id', $id)->delete();

            return redirect()->route('tickets');
        }

        public function showTicketCreatePage(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                $maxOpenTicketCountPerUser = 3;

                if (Auth::user()->getOpenTicketsCount() >= $maxOpenTicketCountPerUser) {
                    return redirect()->route('ticket-create')->with([
                        'errorMessage' => __('frontend/user.to_much_tickets_error', [
                            'amount' => $maxOpenTicketCountPerUser,
                        ]),
                    ]);
                } elseif (! Auth::user()->hasOrders() && ! Auth::user()->hasTransactions()) {
                    return redirect()->route('ticket-create')->with([
                        'errorMessage' => __('frontend/user.not_allowed_to_open_ticket'),
                    ]);
                }

                $validator = Validator::make($request->all(), [
                    'message' => 'required|max:1000',
                    'subject' => 'required|max:255',
                    'ticket_category' => new RuleUserTicketCategoryExists(),
                    'captcha' => 'required|captcha',
                ]);

                if (! $validator->fails()) {
                    $subject = $request->input('subject');
                    $message = $request->input('message');
                    $ticket_category = $request->input('ticket_category');

                    $userTicket = UserTicket::create([
                        'user_id' => Auth::user()->id,
                        'content' => encrypt($message),
                        'subject' => $subject,
                        'category_id' => $ticket_category,
                        'status' => 'open',
                    ]);

                    return redirect()->route('ticket-id', $userTicket->id);
                }

                $request->flash();

                return redirect()->route('ticket-create')->withErrors($validator)->withInput();
            }

            return view('frontend/userpanel.tickets.create');
        }

        public function replyTicket(Request $request, $id)
        {
            $ticket = UserTicket::where('user_id', Auth::user()->id)->where('id', $id)->get()->first();

            if ($ticket != null && ! $ticket->isClosed()) {
                if ($request->getMethod() == 'POST') {
                    $validator = Validator::make($request->all(), [
                        'message' => 'required|max:1000',
                        'captcha' => 'required|captcha',
                    ]);

                    if (! $validator->fails()) {
                        $message = $request->input('message');

                        UserTicketReply::create([
                            'user_id' => Auth::user()->id,
                            'ticket_id' => $ticket->id,
                            'content' => encrypt($message),
                        ]);

                        $ticket->touch();
                    } else {
                        $request->flash();

                        return redirect()->route('ticket-id', $id)->withErrors($validator)->withInput();
                    }
                }

                return redirect()->route('ticket-id', $id);
            }

            return redirect()->route('tickets');
        }

        public function showTicketPage($id)
        {
            $ticket = UserTicket::where('user_id', Auth::user()->id)->where('id', $id)->get()->first();
            $ticketReplies = UserTicketReply::where('ticket_id', $id)->get()->all();

            if ($ticket != null) {
                return view('frontend/userpanel.tickets.ticket', [
                    'ticket' => $ticket,
                    'ticketReplies' => $ticketReplies,
                ]);
            }

            return redirect()->route('tickets');
        }

        public function showTicketsPage($pageNumber = 0)
        {
            $user_tickets = UserTicket::where('user_id', Auth::user()->id)->orderByDesc('updated_at')->paginate(10, ['*'], 'page', $pageNumber);

            if ($pageNumber > $user_tickets->lastPage() || $pageNumber <= 0) {
                return redirect()->route('tickets-with-pageNumber', 1);
            }

            return view('frontend/userpanel.tickets.list_tickets', [
                'user_tickets' => $user_tickets,
            ]);
        }
    }

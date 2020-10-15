<?php

namespace App\Http\Controllers\Backend\Management;

    use App\Http\Controllers\Controller;
    use App\Models\UserTicket;
    use App\Models\UserTicketReply;
    use App\Rules\RuleUserTicketCategoryExists;
    use Auth;
    use Illuminate\Http\Request;
    use Validator;

    class TicketsController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:manage_tickets');
        }

        public function deleteTicket($id)
        {
            UserTicket::where('id', $id)->delete();

            return redirect()->route('backend-management-tickets');
        }

        public function closeTicket($id)
        {
            $ticket = UserTicket::where('id', $id)->get()->first();

            if ($ticket != null) {
                $ticket->update([
                    'status' => 'closed',
                ]);

                return redirect()->route('backend-management-ticket-edit', $ticket->id);
            }

            return redirect()->route('backend-management-tickets');
        }

        public function openTicket($id)
        {
            $ticket = UserTicket::where('id', $id)->get()->first();

            if ($ticket != null) {
                $ticket->update([
                    'status' => 'open',
                ]);

                return redirect()->route('backend-management-ticket-edit', $ticket->id);
            }

            return redirect()->route('backend-management-tickets');
        }

        public function moveTicketForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                if ($request->get('ticket_id')) {
                    $ticket = UserTicket::where('id', $request->input('ticket_id'))->get()->first();

                    if ($ticket != null) {
                        $validator = Validator::make($request->all(), [
                            'ticket_move_category' => new RuleUserTicketCategoryExists(),
                        ]);

                        if (! $validator->fails()) {
                            $category = $request->input('ticket_move_category') ?? 0;

                            $ticket->update([
                                'category_id' => $category,
                            ]);

                            return redirect()->route('backend-management-ticket-edit', $ticket->id);
                        }

                        $request->flash();

                        return redirect()->route('backend-management-ticket-edit', $ticket->id)->withErrors($validator)->withInput();
                    }
                }
            }

            return redirect()->route('backend-management-tickets');
        }

        public function replyTicketForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                if ($request->get('ticket_reply_id')) {
                    $ticket = UserTicket::where('id', $request->input('ticket_reply_id'))->get()->first();

                    if ($ticket != null) {
                        $validator = Validator::make($request->all(), [
                            'ticket_reply_msg' => 'required|max:5000',
                        ]);

                        if (! $validator->fails()) {
                            $message = $request->input('ticket_reply_msg');

                            UserTicketReply::create([
                                'ticket_id' => $ticket->id,
                                'user_id' => Auth::user()->id,
                                'content' => encrypt($message),
                            ]);

                            return redirect()->route('backend-management-ticket-edit', $ticket->id);
                        }

                        $request->flash();

                        return redirect()->route('backend-management-ticket-edit', $ticket->id)->withErrors($validator)->withInput();
                    }
                }
            }

            return redirect()->route('backend-management-tickets');
        }

        public function showTicketEditPage($id)
        {
            $ticket = UserTicket::where('id', $id)->get()->first();

            if ($ticket == null) {
                return redirect()->route('backend-management-tickets');
            }

            $ticketReplies = UserTicketReply::where('ticket_id', $ticket->id)->get()->all();

            return view('backend.management.tickets.edit', [
                'ticket' => $ticket,
                'ticketReplies' => $ticketReplies,
                'managementPage' => true,
            ]);
        }

        public function showTicketsPage(Request $request, $pageNumber = 0)
        {
            $tickets = UserTicket::orderByDesc('created_at')->paginate(10, ['*'], 'page', $pageNumber);

            if ($pageNumber > $tickets->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-management-tickets-with-pageNumber', 1);
            }

            return view('backend.management.tickets.list', [
                'tickets' => $tickets,
                'managementPage' => true,
            ]);
        }
    }

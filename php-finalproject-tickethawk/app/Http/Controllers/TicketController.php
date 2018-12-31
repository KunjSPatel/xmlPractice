<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Auth;

class TicketController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('employee')) {
            $tickets = \App\Ticket::where('user_id', Auth::user()->id)->orderBy('status', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $tickets = \App\Ticket::orderBy('status', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        }
        return view('tickets')->withTickets($tickets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $issues = \App\Issue::all();
        return view('tickets.create')->withIssues($issues);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'categories' => 'required',
            'description' => 'required',
            'urgency' => 'required',
            'department' => 'required',
        ]);

        $ticket = new \App\Ticket;
        $ticket->user_id = Auth::user()->id;
        $ticket->status = 'Open';
        $ticket->description = $request->get('description');
        $ticket->urgency = $request->get('urgency');
        $ticket->department = $request->get('department');
        $ticket->save();

        $ticket->issues()->attach(explode(',', implode(',', $request->get('categories'))));

        $controller = new NotificationController;
        $controller->sendEmail($ticket);
        if(env('TWILIO') != 'disabled') {
            $controller->sendTextMessage($ticket);
        }

        return redirect('/tickets/' . $request->get('ticket_id') . '#comments')->withMessage('Ticket created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $comments = \App\Comment::where('ticket_id', $ticket->id)->orderBy('created_at')->paginate(5);
        return view('tickets.show')->withTicket($ticket)->withComments($comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $issues = \App\Issue::all();
        return view('tickets.edit')->withTicket($ticket)->withIssues($issues);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        if($ticket->status == "Open") {
            $request->validate([
                'categories' => 'required',
                'description' => 'required',
                'urgency' => 'required|in:Low,Medium,High',
                'department' => 'required',
            ]);

            $ticket->user_id = Auth::user()->id;
            $ticket->status = $request->get('status');
            $ticket->description = $request->get('description');
            $ticket->urgency = $request->get('urgency');
            $ticket->department = $request->get('department');
            $ticket->save();

            $ticket->issues()->sync(explode(',', implode(',', $request->get('categories'))));

            return redirect('/tickets/' . $request->get('ticket_id') . '#comments')->withMessage('Ticket created successfully!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function close(Request $request, Ticket $ticket)
    {
        if($ticket->status == "Open") {
            $ticket->status = "Closed";
            $ticket->save();

            return redirect('/tickets/' . $request->get('ticket_id'))->withMessage('Ticket closed successfully!');
        }

        return redirect('/tickets/' . $request->get('ticket_id'))->withMessage('Ticket not closed successfully.');
    }

}

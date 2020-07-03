<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketFormRequest;
use App\Ticket;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tickets = Ticket::all();
        
        return view('tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $this->authorize('manage', $ticket);
        //abort_if(! currentUser()->can('manage', $ticket), 403);
        
        return view('tickets.edit', ['ticket' => $ticket]);
    }

    public function update(Ticket $ticket, TicketFormRequest $request)
    {

        if ($request->get('status') != null){
            $status = 1;
        } else {
            $status = 0;
        }

        $attributes = [
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'status' => $status
        ];
        
        $ticket->update($attributes);

        return redirect($ticket->path().'/edit')->with('status', 'Successfuly updated ticket !');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }


    public function store(TicketFormRequest $request)
    {
        
        $attributes = $request->validated();
        
        $slug = uniqid();

        $attributes['slug'] = $slug;

        $ticket = currentUser()->tickets()->create($attributes);

        // $data = [
        //     'ticket' => $slug
        // ];

        // Mail::send('emails.ticket', $data, function ($message)
        // {
        //     $message->from('wpanta85@gmail.com', 'Test');

        //     $message->to('vladapantic@hotmail.com')->subject('Mail subject');
        // });

        return redirect('/tickets')->with('status', 'You created tisket successfuly ! Ticket ID is - '. $slug);
    }

    public function destroy(Ticket $ticket)
    {
        $this->authorize('manage', $ticket);
        
        $ticket->delete();

        return redirect('/tickets')->with('status', 'Successfuly deleted ticket.');
    }

  
}

<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\CommentFormRequest;

class CommentsController extends Controller
{
    public function store(Ticket $ticket, CommentFormRequest $request)
    {

    	$attributes = $request->validated();

    	$attributes['user_id'] = currentUser()->id;

    	$ticket->addComment($attributes);

    	return redirect()->back()->with('status', 'Comment successfuly posted !');
    }
}

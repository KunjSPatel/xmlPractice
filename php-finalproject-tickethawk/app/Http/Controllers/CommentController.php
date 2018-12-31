<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\App\Ticket::find($request->get('ticket_id'))->status == 'Open') {
            $request->validate([
                'ticket_id' => 'required',
                'comment' => 'required',
            ]);

            $comment = new \App\Comment;
            $comment->ticket_id = $request->get('ticket_id');
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->get('comment');
            $comment->save();

            return redirect('/tickets/' . $request->get('ticket_id') . '#comments')->withMessage('Comment posted successfully!');
        } else {
            return back();
        }
    }

}

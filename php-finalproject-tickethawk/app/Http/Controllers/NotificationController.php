<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio;

class NotificationController extends Controller
{
    public function sendEmail(\App\Ticket $ticket) {
        // TODO: make email notifications functional - requires API
        // $obj = new \stdClass();
        // $obj->ticket = $ticket;
        // $obj->sender = "noreply@demo.tickethawk.site";
        //
        // $users = \App\User::all();
        // foreach($users as $user) {
        //     // Checking if user is admin and has opted in for email notifications.
        //     if($user->roles->first()->name == "admin" and $user->email_notifications == 1) {
        //         Mail::to($user->email)->send(new \App\Mail\NewTicketEmail($obj));
        //     }
        // }
    }

    public function sendTextMessage(\App\Ticket $ticket) {
        $users = \App\User::all();
        foreach($users as $user) {
            // Checking if user is admin and has opted in for text notifications.
            if(($user->hasRole('admin') || $user->hasRole('manager')) && $user->text_notifications == 1 && $user->phone != "") {
                Twilio::message($user->phone, "TicketHawk: A new ticket has been created with ID #" . $ticket->id);
            }
        }
    }
}

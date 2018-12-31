<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use Log;

class ExportController extends Controller
{
    public function exportTickets() {
        Log::info("tickets exported");
        return Excel::download(new \App\Ticket, 'tickets-' . \Carbon\Carbon::now() . '.xlsx');
    }

    public function exportUsers() {
        return Excel::download(new \App\User, 'users-' . \Carbon\Carbon::now() . '.xlsx');
    }

    public function exportCategories() {
        return Excel::download(new \App\Issue, 'issue_categories-' . \Carbon\Carbon::now() . '.xlsx');
    }
}

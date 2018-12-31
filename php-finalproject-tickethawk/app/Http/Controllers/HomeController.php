<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Ticket;
use App\User;
use App\Charts\TicketChart;
use \Carbon\Carbon;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')) {
            // 6 Month User Registration Chart
            $data = collect([]);
            for($months_backwards = 5; $months_backwards >= 0; $months_backwards--) {
                $data->push(User::whereBetween('created_at', [today()->subMonths($months_backwards)->startOfMonth(), today()->subMonths($months_backwards)->endOfMonth()])->count());
            }

            // Creating history chart
            $userChart = new TicketChart;
            $userChart->title('User Registrations (last 6 months)');
            $userChart->labels([
                Carbon::now()->subMonths(5)->format('F'),
                Carbon::now()->subMonths(4)->format('F'),
                Carbon::now()->subMonths(3)->format('F'),
                Carbon::now()->subMonths(2)->format('F'),
                Carbon::now()->subMonths(1)->format('F'),
                Carbon::now()->format('F')
            ]);
            $userChart->dataset('Number of Registered Users', 'line', $data)->color('blue');

            // 6 Month Submission History Chart
            // Getting last 6 months of submissions
            $data = collect([]);
            for($months_backwards = 5; $months_backwards >= 0; $months_backwards--) {
                $data->push(Ticket::whereBetween('created_at', [today()->subMonths($months_backwards)->startOfMonth(), today()->subMonths($months_backwards)->endOfMonth()])->count());
            }

            // Creating history chart
            $submissionChart = new TicketChart;
            $submissionChart->title('Ticket Submissions (last 6 months)');
            $submissionChart->labels([
                Carbon::now()->subMonths(5)->format('F'),
                Carbon::now()->subMonths(4)->format('F'),
                Carbon::now()->subMonths(3)->format('F'),
                Carbon::now()->subMonths(2)->format('F'),
                Carbon::now()->subMonths(1)->format('F'),
                Carbon::now()->format('F')
            ]);
            $submissionChart->dataset('Number of Submitted Tickets', 'line', $data)->color('green');

            // Returning view
            return view('dashboard')->withSubmissionChart($submissionChart)
                ->withUserChart($userChart);
        }
        return redirect('/tickets');
    }
}

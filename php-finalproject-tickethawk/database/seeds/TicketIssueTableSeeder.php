<?php

use Illuminate\Database\Seeder;

class TicketIssueTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('ticket_issue')->delete();

        \DB::table('ticket_issue')->insert(array (
            0 =>
            array (
                'ticket_id' => 1,
                'issue_id' => 1,
            ),
            1 =>
            array (
                'ticket_id' => 2,
                'issue_id' => 2,
            ),
            2 =>
            array (
                'ticket_id' => 3,
                'issue_id' => 1,
            ),
            3 =>
            array (
                'ticket_id' => 3,
                'issue_id' => 2,
            ),
        ));


    }
}

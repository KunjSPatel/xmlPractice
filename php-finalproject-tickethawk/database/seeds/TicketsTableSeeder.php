<?php

use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tickets')->delete();
        
        \DB::table('tickets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'status' => 'Open',
                'description' => 'The printer on the main floor is not working.',
                'urgency' => 'Low',
                'department' => 'Billing, Mississauga',
                'created_at' => '2018-11-10 00:00:00',
                'updated_at' => '2018-11-11 00:00:00',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'status' => 'Closed',
                'description' => 'Monitor stopped working randomly, I can\'t find a cause for the problem.',
                'urgency' => 'High',
                'department' => 'Development, Toronto',
                'created_at' => '2018-11-01 00:00:00',
                'updated_at' => '2018-11-04 00:00:00',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'status' => 'Open',
                'description' => 'Nothing is working at all.',
                'urgency' => 'Medium',
                'department' => 'All Departments',
                'created_at' => '2018-10-25 00:00:00',
                'updated_at' => '2018-11-09 00:00:00',
            ),
        ));
        
        
    }
}
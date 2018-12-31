<?php

use Illuminate\Database\Seeder;

class IssuesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('issues')->delete();
        
        \DB::table('issues')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Printer not working',
                'created_at' => '2018-11-10 00:00:00',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Monitor not working',
                'created_at' => '2018-11-10 00:00:00',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
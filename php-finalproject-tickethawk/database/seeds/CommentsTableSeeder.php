<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comments')->delete();
        
        \DB::table('comments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'ticket_id' => 1,
                'user_id' => 1,
                'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus nibh vitae tincidunt blandit. Curabitur dapibus non turpis non elementum. Donec finibus quam vel suscipit euismod nullam.',
                'created_at' => '2018-11-10 00:00:00',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'ticket_id' => 2,
                'user_id' => 1,
                'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus nibh vitae tincidunt blandit. Curabitur dapibus non turpis non elementum. Donec finibus quam vel suscipit euismod nullam.',
                'created_at' => '2018-11-10 00:00:00',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'ticket_id' => 3,
                'user_id' => 1,
                'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus nibh vitae tincidunt blandit. Curabitur dapibus non turpis non elementum. Donec finibus quam vel suscipit euismod nullam.',
                'created_at' => '2018-11-10 00:00:00',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}
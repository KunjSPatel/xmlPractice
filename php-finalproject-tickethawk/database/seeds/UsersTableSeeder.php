<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'David Grzyb',
                'email' => 'grzybdavid@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$vOoHx5P1QOz5CYDDao/82.A0qHsPRpHRPqNQgvdc6SXOQjCUoQx8.',
                'remember_token' => NULL,
                'created_at' => '2018-11-10 22:07:45',
                'updated_at' => '2018-11-10 22:07:45',
            ),
        ));
        
        
    }
}
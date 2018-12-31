<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'employee',
                'display_name' => 'Employee',
                'description' => NULL,
                'created_at' => '2018-11-11 09:00:00',
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'technician',
                'display_name' => 'Technician',
                'description' => NULL,
                'created_at' => '2018-11-11 09:00:00',
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'manager',
                'display_name' => 'Manager',
                'description' => NULL,
                'created_at' => '2018-11-11 09:00:00',
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => NULL,
                'created_at' => '2018-11-11 09:00:00',
                'updated_at' => NULL,
            ),
        ));


    }
}

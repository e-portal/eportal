<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                ['email' => 'oshaman78@gmail.com', 'password' => bcrypt('111222'), 'verified' => 1, 'email_token' => 'qwe'],
            ]
        );
    }
}

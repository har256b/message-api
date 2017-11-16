<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
    	User::insert([
            ['name' => 'oberlo', 'email' => 'oberlo', 'password' => bcrypt('oberlo')],
            ['name' => 'harehman', 'email' => 'harehman', 'password' => bcrypt('harehman')],
    	]);
    }
}

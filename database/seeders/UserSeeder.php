<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        User::create([
//            'first_name' => 'super',
//            'last_name' => 'admin',
//            'email' => 'superAdmin@admin.com',
//            'password' => bcrypt('12345'),
//        ]);

       $users = User::factory(3)->create();  // create users

       foreach ($users as $user){
           $user->attachRole('super_admin');
       } // add to user role super admin

    }
}

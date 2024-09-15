<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $userList = [
            [
                'username' => 'tester',
                'password' => Hash::make('PASSWORD'),
                'is_active' => true,
                'role' => 'manager',
                
            ]
            ,[
                'username' => 'tester2',
                'is_active' => true,
                'role' => 'agent',
                
            ]
        ];

        foreach($userList as $user) {

            \App\Models\User::factory()
                        ->create($user);
        }
        
    }
}

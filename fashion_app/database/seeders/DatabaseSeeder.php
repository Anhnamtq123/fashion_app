<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $User = new User;
        $User->name = "Admin";
        $User->password = Hash::make('password123');
        $User->is_admin = true;
        $User->save();
        $User = new User;
        $User->name = "user1";
        $User->password = Hash::make('password123');
        $User->is_admin = false;
        $User->save();
    }
}

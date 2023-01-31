<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
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
        $user = new User();
        $user->setName('Joselu');
        $user->setEmail('joseluischezcarrasco@gmail.com');
        $user->email_verified_at = now();
        $user->setPassword('1234');
        $user->setImage('joselu.png');
        $user->setPreferredPosition('MC');
        $user->setRememberToken(Str::random(10));
        $user->save();
    }
}

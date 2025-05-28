<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(random_int(10,20))->create();

        $user = User::find(1);
        $user->name = 'ljw';
        $user->email = 'ljw@gmail.com';
        $user->avatar = config('app.url') . '/uploads/images/default-avatar/400.jpg';
        $user->save();
    }
}

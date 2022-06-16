<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
/* Spatie */
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Adrián Suárez',
            'email' => 'easuarez@vizcarra.com',
            'username' => 'easuarez',
            'password' => bcrypt('V1zc4rr4+'),
            'remember_token' => Str::random(10),
        ]);
    }
}

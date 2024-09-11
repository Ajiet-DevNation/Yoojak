<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'usn' => '4JK21CS001',
            'phone' => '9019003490',
            'address' => 'Bangalore',
            'is_admin' => true,
            'branch' => 'CSE',
            'batch' => '2021',
            'cgpa' => 8.0,
            'current_sem' => '7',
            'twelthPercentage' => 80.0,
            'tenthPercentage' => 90.0,
            'backlogs' => 0,
            'dob' => '2003-06-23',
            'gender' => 'male',
            'resume' => 'https://example.com/resume.pdf',
            'twelthCertificate' => 'https://example.com/twelth.pdf',
            'tenthCertificate' => 'https://example.com/tenth.pdf',
            'linkedin' => 'https://linkedin.com/in/test',
            'github' => 'https://github.com/darshan45672',
            'x' => 'https://x.com/darshan45672',
            'facebook' => 'https://facebook.com/darshan45672',
        ]);
    }
}

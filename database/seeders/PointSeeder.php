<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\point;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class PointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Ambil semua pengguna dari tabel users
        $users = User::all();

        // Loop melalui setiap user dan buat entri point untuk masing-masing user
        foreach ($users as $user) {
            Point::create([
                'user_id' => $user->id,  // Mengisi kolom user_id dengan ID user
                'point' => rand(10, 100), // Nilai poin acak antara 10 dan 100
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

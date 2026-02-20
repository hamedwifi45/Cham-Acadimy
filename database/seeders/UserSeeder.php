<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminExists = User::where('email', 'Chamadmin@Cham.com')->exists();

        if (! $adminExists) {
            User::create([
                'name' => 'شام',
                'email' => 'Chamadmin@Cham.com',
                'email_verified_at' => now(),
                'password' => Hash::make('Cham123!@#'),
                'admin_level' => 2,
                'profile_photo_path' => 'Tests/profile-photos/admin.jpg',
                'remember_token' => Str::random(10),
            ]);
        }

        $users = [
            [
                'name' => 'أحمد محمد',
                'email' => 'ahmed@example.com',
                'password' => Hash::make('password'),
                'admin_level' => 0,
                'profile_photo_path' => 'Tests/profile-photos/user1.jpg',
            ],
            [
                'name' => 'سارة علي',
                'email' => 'sara@example.com',
                'password' => Hash::make('password'),
                'admin_level' => 0,
                'profile_photo_path' => 'Tests/profile-photos/user2.jpg',
            ],
            [
                'name' => 'محمد خالد',
                'email' => 'mohammed@example.com',
                'password' => Hash::make('password'),
                'admin_level' => 0,
                'profile_photo_path' => 'Tests/profile-photos/user3.jpg',
            ],
            [
                'name' => 'فاطمة الزهراء',
                'email' => 'fatima@example.com',
                'password' => Hash::make('password'),
                'admin_level' => 0,
                'profile_photo_path' => 'Tests/profile-photos/user4.jpg',
            ],
        ];

        foreach ($users as $userData) {
            if (! User::where('email', $userData['email'])->exists()) {
                User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'email_verified_at' => now(),
                    'password' => $userData['password'],
                    'admin_level' => $userData['admin_level'],
                    'profile_photo_path' => $userData['profile_photo_path'],
                    'remember_token' => Str::random(10),
                ]);
            }
        }

        User::factory()->count(10)->create();
    }
}

<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@engineerstechbd.com'],
            ['name' => 'Admin', 'password' => bcrypt('Admin@123')]
        );
        UserRole::firstOrCreate(['user_id' => $user->id, 'role' => 'admin']);
    }
}

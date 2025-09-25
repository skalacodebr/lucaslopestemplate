<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
<<<<<<< Updated upstream
<<<<<<< Updated upstream
            ProfessionalSeeder::class,
=======
=======
>>>>>>> Stashed changes
        ]);

        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.test',
            'password' => Hash::make('admin'),
>>>>>>> Stashed changes
        ]);

        $user = User::firstOrCreate(
            ['email' => 'admin@admin.test'],
            [
                'name' => 'admin',
                'email' => 'admin@admin.test',
                'password' => Hash::make('admin'),
            ]
        );

        // Assign admin role
        if (!$user->hasRole('admin')) {
            $user->assignRole('admin');
        }

        Post::factory()
            ->count(25)
            ->create();

        Notification::make()
            ->title('Welcome to Filament')
            ->body('You are ready to start building your application.')
            ->success()
            ->sendToDatabase($user);
    }
}

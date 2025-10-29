<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';
    protected $description = 'Create admin user';

    public function handle()
    {
        $email = 'admin@mail.ru';
        $password = 'password';

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update([
                'password' => Hash::make($password),
            ]);
            $this->info('Admin user updated!');
        } else {
            User::create([
                'name' => 'Admin',
                'email' => $email,
                'password' => Hash::make($password),
            ]);
            $this->info('Admin user created!');
        }

        $this->info('Email: ' . $email);
        $this->info('Password: ' . $password);

        return Command::SUCCESS;
    }
}

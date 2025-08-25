<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetTestUserPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reset-password {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Redefine a senha de um usuário';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("Usuário com email '{$email}' não encontrado!");
            return 1;
        }

        $user->password = Hash::make($password);
        $user->save();

        $this->info("Senha do usuário '{$user->name}' redefinida com sucesso!");
        $this->info("Email: {$email}");
        $this->info("Nova senha: {$password}");

        return 0;
    }
}

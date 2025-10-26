<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class CheckUserPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check-permissions {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check user permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        if (!$email) {
            $this->info("Available users:");
            User::all(['name', 'email'])->each(function($user) {
                $this->line("- {$user->name} ({$user->email})");
            });
            return;
        }
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email {$email} not found.");
            return;
        }
        
        $this->info("User: {$user->name} ({$user->email})");
        $this->info("Roles: " . $user->roles->pluck('name')->join(', '));
        
        $contactFormPermissions = $user->getAllPermissions()->filter(function($permission) {
            return str_starts_with($permission->name, 'contact_forms_');
        });
        
        $this->info("Contact Form Permissions:");
        foreach ($contactFormPermissions as $permission) {
            $this->line("- {$permission->name}");
        }
        
        if ($contactFormPermissions->isEmpty()) {
            $this->warn("No contact form permissions found!");
        }
    }
}

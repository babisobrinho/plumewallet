<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetUserOnboarding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'onboarding:reset {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset onboarding status for a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        if (!$email) {
            $email = $this->ask('Enter user email');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return 1;
        }

        $user->update(['onboarding_completed' => false]);
        
        // Delete onboarding responses
        $user->onboardingResponses()->delete();
        
        // Delete user's categories and accounts for clean slate
        $user->categories()->delete();
        $user->accounts()->delete();

        $this->info("Onboarding reset for user: {$user->name} ({$user->email})");
        $this->info("User can now go through onboarding again.");

        return 0;
    }
}

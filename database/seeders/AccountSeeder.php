<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Enums\AccountType;
use App\Models\Account;
use App\Models\Team;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get client teams (teams owned by users with client roles)
        $clientTeams = Team::whereHas('owner', function ($query) {
            $query->whereHas('roles', function ($roleQuery) {
                $roleQuery->where('type', RoleType::CLIENT->value);
            });
        })->get();

        if ($clientTeams->isEmpty()) {
            $this->command->warn('No client teams found. Please run UserSeeder first to create client users with personal teams.');
            return;
        }

        $accountTemplates = [
            AccountType::CHECKING->value => [
                'Main Checking',
                'Business Checking',
                'Joint Checking',
            ],
            AccountType::SAVINGS->value => [
                'Emergency Fund',
                'Vacation Savings',
                'Long-term Savings',
            ],
            AccountType::CASH->value => [
                'Cash Wallet',
                'Petty Cash',
            ],
            AccountType::CREDIT_CARD->value => [
                'Visa Credit Card',
                'MasterCard',
                'Store Credit Card',
            ],
            AccountType::LINE_OF_CREDIT->value => [
                'Home Equity Line',
                'Personal Line of Credit',
            ],
        ];

        foreach ($clientTeams as $team) {
            $this->command->info("Creating accounts for team: {$team->name}");

            $accountsCount = 0;

            foreach ($accountTemplates as $accountType => $names) {
                foreach ($names as $name) {
                    // Randomly decide if account should be closed (10% chance)
                    $isClosed = rand(1, 10) === 1;

                    // Create account
                    Account::factory()->create([
                        'team_id' => $team->id,
                        'type' => $accountType,
                        'name' => $name,
                        'balance' => $this->getInitialBalance($accountType),
                        'is_closed' => $isClosed,
                        'reconciled_at' => $isClosed ? null : (rand(0, 1) ? now()->subDays(rand(1, 30)) : null),
                    ]);

                    $accountsCount++;
                }
            }

            $this->command->info("  - Created {$accountsCount} accounts");
        }

        $this->command->info('Accounts created successfully.');
    }

    /**
     * Get realistic initial balance based on account type
     */
    private function getInitialBalance(string $accountType): float
    {
        return match ($accountType) {
            AccountType::CHECKING->value => rand(1000, 15000) + (rand(0, 99) / 100),
            AccountType::SAVINGS->value => rand(5000, 50000) + (rand(0, 99) / 100),
            AccountType::CASH->value => rand(50, 500) + (rand(0, 99) / 100),
            AccountType::CREDIT_CARD->value => -1 * (rand(500, 10000) + (rand(0, 99) / 100)),
            AccountType::LINE_OF_CREDIT->value => -1 * (rand(10000, 100000) + (rand(0, 99) / 100)),
            default => 0.0,
        };
    }
}

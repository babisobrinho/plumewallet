<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\Payee;
use App\Models\Team;
use App\Models\TransactionCategory;
use Illuminate\Database\Seeder;

class PayeeSeeder extends Seeder
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

        $commonPayees = [
            // Essential Expenses
            'Electric Company' => 'Utilities',
            'Water Department' => 'Utilities',
            'Gas Company' => 'Utilities',
            'Internet Provider' => 'Utilities',
            'Mobile Carrier' => 'Utilities',
            'Supermarket Chain' => 'Food & Groceries',
            'Local Grocery' => 'Food & Groceries',
            'Gas Station' => 'Transportation',
            'Auto Repair Shop' => 'Transportation',
            'Insurance Company' => 'Insurance',
            'Medical Center' => 'Healthcare',
            'Pharmacy' => 'Healthcare',

            // Non-Essential Expenses
            'Coffee Shop' => 'Dining Out',
            'Restaurant Chain' => 'Dining Out',
            'Local Restaurant' => 'Dining Out',
            'Movie Theater' => 'Entertainment',
            'Streaming Service' => 'Subscriptions',
            'Gym' => 'Subscriptions',
            'Department Store' => 'Shopping',
            'Online Retailer' => 'Shopping',
            'Travel Agency' => 'Travel',

            // Income
            'Employer Inc' => 'Salary',
            'Freelance Client' => 'Freelance',
            'Investment Firm' => 'Investment',
            'Bank Interest' => 'Investment',
        ];

        foreach ($clientTeams as $team) {
            $this->command->info("Creating payees for team: {$team->name}");

            $payeesCount = 0;
            $categories = TransactionCategory::whereHas('group', function ($query) use ($team) {
                $query->where('team_id', $team->id);
            })->get();

            if ($categories->isEmpty()) {
                $this->command->warn("No categories found for team {$team->name}. Please run CategoryGroupSeeder first.");
                continue;
            }

            foreach ($commonPayees as $payeeName => $categoryName) {
                // Find matching category for this team
                $category = $categories->firstWhere('name', $categoryName);

                if (!$category) {
                    $category = $categories->random();
                }

                Payee::factory()->create([
                    'team_id' => $team->id,
                    'name' => $payeeName,
                    'is_listed' => rand(1, 20) !== 1, // 95% listed, 5% unlisted
                    'category_id' => $category->id,
                ]);

                $payeesCount++;
            }

            $this->command->info("  - Created {$payeesCount} payees");
        }

        $this->command->info('Payees created successfully.');
    }
}

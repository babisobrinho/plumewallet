<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\CategoryGroup;
use App\Models\TransactionCategory;
use Illuminate\Database\Seeder;

class TransactionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get category groups from client teams only
        $categoryGroups = CategoryGroup::whereHas('team', function ($query) {
            $query->whereHas('owner', function ($ownerQuery) {
                $ownerQuery->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('type', RoleType::CLIENT->value);
                });
            });
        })->get();

        if ($categoryGroups->isEmpty()) {
            $this->command->warn('No category groups found for client teams. Please run CategoryGroupSeeder first.');
            return;
        }

        $defaultCategories = [
            'Credit Card Payments' => [
                ['name' => 'american express', 'assigned_amount' => 0.00],
                ['name' => 'Visa Credit Card', 'assigned_amount' => 0.00],
                ['name' => 'MasterCard', 'assigned_amount' => 0.00],
            ],
            'Essential Expenses' => [
                ['name' => 'Housing', 'assigned_amount' => 1500.00],
                ['name' => 'Transportation', 'assigned_amount' => 400.00],
                ['name' => 'Food & Groceries', 'assigned_amount' => 600.00],
                ['name' => 'Utilities', 'assigned_amount' => 300.00],
                ['name' => 'Insurance', 'assigned_amount' => 200.00],
                ['name' => 'Healthcare', 'assigned_amount' => 150.00],
            ],
            'Non-Essential Expenses' => [
                ['name' => 'Entertainment', 'assigned_amount' => 100.00],
                ['name' => 'Dining Out', 'assigned_amount' => 200.00],
                ['name' => 'Shopping', 'assigned_amount' => 150.00],
                ['name' => 'Travel', 'assigned_amount' => 100.00],
                ['name' => 'Hobbies', 'assigned_amount' => 75.00],
                ['name' => 'Subscriptions', 'assigned_amount' => 50.00],
            ],
            'Income' => [
                ['name' => 'Salary', 'assigned_amount' => 0],
                ['name' => 'Freelance', 'assigned_amount' => 0],
                ['name' => 'Investment', 'assigned_amount' => 0],
                ['name' => 'Bonus', 'assigned_amount' => 0],
                ['name' => 'Gifts', 'assigned_amount' => 0],
                ['name' => 'Refunds', 'assigned_amount' => 0],
            ],
            'Savings & Investments' => [
                ['name' => 'Emergency Fund', 'assigned_amount' => 500.00],
                ['name' => 'Retirement', 'assigned_amount' => 1000.00],
                ['name' => 'Stocks', 'assigned_amount' => 300.00],
                ['name' => 'Bonds', 'assigned_amount' => 200.00],
                ['name' => 'Real Estate', 'assigned_amount' => 0],
                ['name' => 'Education Fund', 'assigned_amount' => 250.00],
            ],
            'Debt Payments' => [
                ['name' => 'Credit Card', 'assigned_amount' => 300.00],
                ['name' => 'Student Loan', 'assigned_amount' => 400.00],
                ['name' => 'Mortgage', 'assigned_amount' => 1200.00],
                ['name' => 'Car Loan', 'assigned_amount' => 350.00],
                ['name' => 'Personal Loan', 'assigned_amount' => 200.00],
            ],
        ];

        $categoriesCreated = 0;

        foreach ($categoryGroups as $group) {
            $groupCategories = $defaultCategories[$group->name] ?? [];

            if (empty($groupCategories)) {
                $this->command->warn("No default categories defined for group: {$group->name}");
                continue;
            }

            foreach ($groupCategories as $categoryData) {
                // Check if category already exists for this group
                $existingCategory = TransactionCategory::where('group_id', $group->id)
                    ->where('name', $categoryData['name'])
                    ->first();

                if (!$existingCategory) {
                    TransactionCategory::create([
                        'group_id' => $group->id,
                        'name' => $categoryData['name'],
                        'assigned_amount' => $categoryData['assigned_amount'],
                    ]);

                    $categoriesCreated++;
                }
            }

            $this->command->info("Created/verified categories for group: {$group->name}");
        }

        $this->command->info("Transaction categories seeded successfully. Created/verified {$categoriesCreated} categories.");
    }

    /**
     * Seed categories for a specific team
     */
    public function runForTeam($teamId): void
    {
        $categoryGroups = CategoryGroup::where('team_id', $teamId)->get();

        if ($categoryGroups->isEmpty()) {
            $this->command->warn("No category groups found for team ID: {$teamId}");
            return;
        }

        $this->command->info("Seeding categories for team ID: {$teamId}");

        $defaultCategories = [
            'Essential Expenses' => ['Housing', 'Transportation', 'Food & Groceries', 'Utilities', 'Insurance', 'Healthcare'],
            'Non-Essential Expenses' => ['Entertainment', 'Dining Out', 'Shopping', 'Travel', 'Hobbies', 'Subscriptions'],
            'Income' => ['Salary', 'Freelance', 'Investment', 'Bonus', 'Gifts', 'Refunds'],
            'Savings & Investments' => ['Emergency Fund', 'Retirement', 'Stocks', 'Bonds', 'Real Estate', 'Education Fund'],
            'Debt Payments' => ['Credit Card', 'Student Loan', 'Mortgage', 'Car Loan', 'Personal Loan'],
        ];

        $categoriesCreated = 0;

        foreach ($categoryGroups as $group) {
            $categories = $defaultCategories[$group->name] ?? [];

            foreach ($categories as $categoryName) {
                // Check if category already exists for this group
                $existingCategory = TransactionCategory::where('group_id', $group->id)
                    ->where('name', $categoryName)
                    ->first();

                if (!$existingCategory) {
                    TransactionCategory::create([
                        'group_id' => $group->id,
                        'name' => $categoryName,
                        'assigned_amount' => $this->generateAssignedAmount($group->name, $categoryName),
                    ]);

                    $categoriesCreated++;
                }
            }
        }

        $this->command->info("Created {$categoriesCreated} categories for team ID: {$teamId}");
    }

    /**
     * Generate realistic assigned amounts based on category group and name
     */
    private function generateAssignedAmount(string $groupName, string $categoryName): ?float
    {
        // Income categories typically don't have assigned amounts
        if ($groupName === 'Income') {
            return null;
        }

        return match ($categoryName) {
            'Housing' => rand(80000, 200000) / 100, // $800 - $2,000
            'Transportation' => rand(20000, 60000) / 100, // $200 - $600
            'Food & Groceries' => rand(30000, 80000) / 100, // $300 - $800
            'Utilities' => rand(15000, 40000) / 100, // $150 - $400
            'Insurance' => rand(10000, 30000) / 100, // $100 - $300
            'Healthcare' => rand(5000, 20000) / 100, // $50 - $200
            'Entertainment' => rand(5000, 15000) / 100, // $50 - $150
            'Dining Out' => rand(10000, 30000) / 100, // $100 - $300
            'Shopping' => rand(10000, 25000) / 100, // $100 - $250
            'Travel' => rand(5000, 20000) / 100, // $50 - $200
            'Hobbies' => rand(3000, 10000) / 100, // $30 - $100
            'Subscriptions' => rand(2000, 8000) / 100, // $20 - $80
            'Emergency Fund' => rand(20000, 50000) / 100, // $200 - $500
            'Retirement' => rand(50000, 150000) / 100, // $500 - $1,500
            'Stocks' => rand(10000, 50000) / 100, // $100 - $500
            'Bonds' => rand(5000, 30000) / 100, // $50 - $300
            'Education Fund' => rand(10000, 40000) / 100, // $100 - $400
            'Credit Card' => rand(15000, 50000) / 100, // $150 - $500
            'Student Loan' => rand(20000, 60000) / 100, // $200 - $600
            'Mortgage' => rand(80000, 200000) / 100, // $800 - $2,000
            'Car Loan' => rand(20000, 60000) / 100, // $200 - $600
            'Personal Loan' => rand(10000, 30000) / 100, // $100 - $300
            default => rand(5000, 20000) / 100, // $50 - $200 as default
        };
    }
}

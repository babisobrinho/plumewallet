<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\Account;
use App\Models\Payee;
use App\Models\Team;
use App\Models\Transaction;
use App\Models\TransactionCategory;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
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

        // Define transaction count ranges based on account type and activity level
        $transactionRanges = [
            'high_activity' => ['min' => 80, 'max' => 150],  // Checking, Credit Cards
            'medium_activity' => ['min' => 30, 'max' => 80], // Savings, Money Market
            'low_activity' => ['min' => 5, 'max' => 30],     // Investments, Loans
        ];

        // Map account types to activity levels
        $accountActivityLevels = [
            'checking' => 'high_activity',
            'savings' => 'medium_activity',
            'credit_card' => 'high_activity',
            'money_market' => 'medium_activity',
            'investment' => 'low_activity',
            'loan' => 'low_activity',
            'mortgage' => 'low_activity',
            'line_of_credit' => 'medium_activity',
        ];

        foreach ($clientTeams as $team) {
            $this->command->info("Creating transactions for client team: {$team->name} (Owner: {$team->owner->name})");

            $accounts = Account::where('team_id', $team->id)->open()->get();
            $categories = TransactionCategory::whereHas('group', function ($query) use ($team) {
                $query->where('team_id', $team->id);
            })->get();
            $payees = Payee::where('team_id', $team->id)->listed()->get();

            if ($accounts->isEmpty()) {
                $this->command->warn("No accounts found for team {$team->name}. Please run AccountSeeder first.");
                continue;
            }

            if ($categories->isEmpty()) {
                $this->command->warn("No categories found for team {$team->name}. Please run CategoryGroupSeeder first.");
                continue;
            }

            if ($payees->isEmpty()) {
                $this->command->warn("No payees found for team {$team->name}. Please run PayeeSeeder first.");
                continue;
            }

            $totalTransactions = 0;

            foreach ($accounts as $account) {
                // Determine activity level based on account type
                $accountType = strtolower($account->type->value);
                $activityLevel = $accountActivityLevels[$accountType] ?? 'medium_activity';
                
                // Get transaction count range
                $range = $transactionRanges[$activityLevel];
                $transactionsCount = rand($range['min'], $range['max']);

                $this->command->info("  - Creating {$transactionsCount} transactions for {$account->type->value} account: {$account->name}");

                // Track balance for realistic transaction sequencing
                $currentBalance = $account->current_balance ?? 0;
                $transactions = [];

                // Create recurring transaction patterns (10% of transactions)
                $recurringCount = (int)($transactionsCount * 0.1);
                $recurringTransactions = $this->generateRecurringTransactions($account, $categories, $payees, $recurringCount);
                $transactions = array_merge($transactions, $recurringTransactions);

                // Create seasonal transactions (5% of transactions)
                $seasonalCount = (int)($transactionsCount * 0.05);
                $seasonalTransactions = $this->generateSeasonalTransactions($account, $categories, $payees, $seasonalCount);
                $transactions = array_merge($transactions, $seasonalTransactions);

                // Create regular transactions for the remainder
                $regularCount = $transactionsCount - $recurringCount - $seasonalCount;

                for ($i = 0; $i < $regularCount; $i++) {
                    $category = $categories->random();
                    $payee = $payees->random();

                    // Determine if this should be income or expense based on category group
                    $isIncome = in_array($category->group->name, ['Income', 'Savings & Investments']);
                    $isExpense = in_array($category->group->name, ['Essential Expenses', 'Non-Essential Expenses', 'Debt Payments']);

                    // Adjust transfer probability based on account type
                    $transferProbability = match($accountType) {
                        'checking', 'savings' => 8, // 8% chance for liquid accounts
                        'credit_card' => 2, // 2% chance for credit cards
                        default => 5, // 5% chance for others
                    };

                    $isTransfer = rand(1, 100) <= $transferProbability;

                    if ($isTransfer) {
                        // For transfers, use another account as transactionable
                        $otherAccounts = $accounts->where('id', '!=', $account->id);
                        if ($otherAccounts->isNotEmpty()) {
                            $transferAccount = $otherAccounts->random();
                            $transactionableId = $transferAccount->id;
                            $transactionableType = Account::class;
                            $description = $this->generateTransferDescription($account->name, $transferAccount->name);
                            $amount = $this->generateTransferAmount($accountType);
                        } else {
                            // Fallback to payee if no other accounts
                            $transactionableId = $payee->id;
                            $transactionableType = Payee::class;
                            $description = $this->generateDescription($payee->name, $category->name);
                            $amount = $this->generateAmount($isIncome, $isExpense, $category->group->name, $accountType);
                        }
                    } else {
                        // Regular transaction with payee
                        $transactionableId = $payee->id;
                        $transactionableType = Payee::class;
                        $description = $this->generateDescription($payee->name, $category->name);
                        $amount = $this->generateAmount($isIncome, $isExpense, $category->group->name, $accountType);
                    }

                    // Create transaction with realistic date sequencing
                    $transactionDate = $this->generateTransactionDate($i, $regularCount);

                    $transaction = [
                        'account_id' => $account->id,
                        'transactionable_id' => $transactionableId,
                        'transactionable_type' => $transactionableType,
                        'category_id' => $category->id,
                        'date' => $transactionDate,
                        'description' => $description,
                        'amount' => $amount,
                        'is_cleared' => $this->shouldBeCleared($transactionDate),
                        'is_reconciled' => $this->shouldBeReconciled($transactionDate),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $transactions[] = $transaction;
                    $totalTransactions++;

                    // Update balance for next transaction (for logical sequencing)
                    $currentBalance += $amount;
                }

                // Insert transactions in batches for better performance
                $chunks = array_chunk($transactions, 100);
                foreach ($chunks as $chunk) {
                    Transaction::insert($chunk);
                }
            }

            $this->command->info("  - Created {$totalTransactions} total transactions for client team {$team->name}");
        }

        $this->command->info('Transactions created successfully for all client teams.');
    }

    /**
     * Generate a random transaction date within the last year with realistic distribution
     */
    private function generateTransactionDate(int $currentIndex, int $totalTransactions): \DateTime
    {
        $startDate = now()->subYear();
        $endDate = now();

        // Create more recent transactions (last 3 months) have higher density
        $recentThreshold = $totalTransactions * 0.6; // 60% of transactions in last 3 months
        
        if ($currentIndex < $recentThreshold) {
            // Recent transactions (last 3 months)
            $recentStart = now()->subMonths(3);
            $daysDiff = $endDate->diffInDays($recentStart);
            $randomDays = rand(0, $daysDiff);
            return $recentStart->addDays($randomDays);
        } else {
            // Older transactions (3-12 months ago)
            $olderEnd = now()->subMonths(3);
            $daysDiff = $olderEnd->diffInDays($startDate);
            $randomDays = rand(0, $daysDiff);
            return $startDate->addDays($randomDays);
        }
    }

    /**
     * Generate a realistic transaction description
     */
    private function generateDescription(string $payeeName, string $categoryName): string
    {
        $descriptions = [
            "Payment to {$payeeName}",
            "Purchase at {$payeeName}",
            "{$payeeName} transaction",
            "Monthly payment - {$payeeName}",
            "Online payment - {$payeeName}",
            "Auto-debit for {$categoryName}",
            "Transfer from {$payeeName}",
            "Refund from {$payeeName}",
            "Deposit from {$payeeName}",
        ];

        return $descriptions[array_rand($descriptions)];
    }

    /**
     * Generate a transfer description
     */
    private function generateTransferDescription(string $fromAccount, string $toAccount): string
    {
        $descriptions = [
            "Transfer to {$toAccount}",
            "Account transfer to {$toAccount}",
            "Funds transfer to {$toAccount}",
            "Internal transfer - {$toAccount}",
            "Balance transfer from {$fromAccount} to {$toAccount}",
        ];

        return $descriptions[array_rand($descriptions)];
    }


    /**
     * Generate a realistic transaction amount based on account type and category
     */
    private function generateAmount(bool $isIncome, bool $isExpense, string $groupName, string $accountType): float
    {
        if ($isIncome) {
            $amount = match ($groupName) {
                'Salary' => rand(200000, 1000000) / 100, // $2,000 - $10,000
                'Freelance' => rand(50000, 500000) / 100, // $500 - $5,000
                'Investment' => rand(1000, 50000) / 100, // $10 - $500
                'Bonus' => rand(100000, 500000) / 100, // $1,000 - $5,000
                'Dividends' => rand(500, 10000) / 100, // $5 - $100
                'Interest' => rand(100, 5000) / 100, // $1 - $50
                default => rand(1000, 50000) / 100, // $10 - $500
            };
            return $amount;
        }

        if ($isExpense) {
            // Make expense amounts negative
            $amount = match ($groupName) {
                'Housing' => rand(50000, 300000) / 100, // $500 - $3,000
                'Transportation' => rand(2000, 10000) / 100, // $20 - $100
                'Food & Groceries' => rand(5000, 30000) / 100, // $50 - $300
                'Utilities' => rand(5000, 50000) / 100, // $50 - $500
                'Entertainment' => rand(1000, 10000) / 100, // $10 - $100
                'Dining Out' => rand(2000, 50000) / 100, // $20 - $500
                'Shopping' => rand(1000, 50000) / 100, // $10 - $500
                'Healthcare' => rand(5000, 50000) / 100, // $50 - $500
                'Insurance' => rand(10000, 50000) / 100, // $100 - $500
                'Debt Payments' => rand(10000, 200000) / 100, // $100 - $2,000
                default => rand(1000, 20000) / 100, // $10 - $200
            };

            // Adjust for account type
            if ($accountType === 'credit_card') {
                // Credit card transactions tend to be smaller, more frequent
                $amount = $amount * 0.7; // Reduce amount by 30% for credit cards
            }

            return -$amount; // Negative for expenses
        }

        // For other types (shouldn't happen with current logic)
        return rand(-50000, 50000) / 100; // -$500 to $500
    }

    /**
     * Generate a transfer amount based on account type
     */
    private function generateTransferAmount(string $accountType): float
    {
        return match($accountType) {
            'checking' => rand(5000, 50000) / 100, // $50 - $500
            'savings' => rand(10000, 100000) / 100, // $100 - $1,000
            'credit_card' => rand(10000, 50000) / 100, // $100 - $500
            'investment' => rand(50000, 200000) / 100, // $500 - $2,000
            default => rand(10000, 100000) / 100, // $100 - $1,000
        };
    }

    /**
     * Determine if transaction should be cleared based on date
     */
    private function shouldBeCleared(\DateTime $transactionDate): bool
    {
        $daysAgo = now()->diffInDays($transactionDate);
        
        // Older transactions are more likely to be cleared
        if ($daysAgo > 30) return true;
        if ($daysAgo > 7) return rand(1, 10) <= 8; // 80% chance
        return rand(1, 10) <= 3; // 30% chance for recent transactions
    }

    /**
     * Determine if transaction should be reconciled based on date
     */
    private function shouldBeReconciled(\DateTime $transactionDate): bool
    {
        $daysAgo = now()->diffInDays($transactionDate);
        
        // Only older transactions are likely to be reconciled
        if ($daysAgo > 60) return rand(1, 10) <= 8; // 80% chance
        if ($daysAgo > 30) return rand(1, 10) <= 5; // 50% chance
        return rand(1, 10) <= 1; // 10% chance for recent transactions
    }

    /**
     * Generate recurring transaction patterns
     */
    private function generateRecurringTransactions($account, $categories, $payees, int $count): array
    {
        $transactions = [];
        $recurringPayees = $payees->where('is_recurring', true)->take(3);
        
        if ($recurringPayees->isEmpty()) {
            return $transactions;
        }

        for ($i = 0; $i < $count; $i++) {
            $payee = $recurringPayees->random();
            $category = $categories->where('group.name', 'Essential Expenses')->random();
            
            // Generate same day of month for recurring transactions
            $dayOfMonth = rand(1, 28); // Avoid month-end issues
            $monthsBack = rand(1, 12);
            $transactionDate = now()->subMonths($monthsBack)->day($dayOfMonth);
            
            // Same amount for recurring transactions
            $amount = $this->generateAmount(false, true, $category->group->name, strtolower($account->type->value));
            
            $transactions[] = [
                'account_id' => $account->id,
                'transactionable_id' => $payee->id,
                'transactionable_type' => Payee::class,
                'category_id' => $category->id,
                'date' => $transactionDate,
                'description' => "Recurring payment - {$payee->name}",
                'amount' => $amount,
                'is_cleared' => $this->shouldBeCleared($transactionDate),
                'is_reconciled' => $this->shouldBeReconciled($transactionDate),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        return $transactions;
    }

    /**
     * Generate seasonal transaction patterns
     */
    private function generateSeasonalTransactions($account, $categories, $payees, int $count): array
    {
        $transactions = [];
        
        for ($i = 0; $i < $count; $i++) {
            $category = $categories->random();
            $payee = $payees->random();
            
            // Seasonal patterns
            $seasonalPatterns = [
                'holiday' => ['month' => 12, 'description' => 'Holiday shopping', 'amount_multiplier' => 1.5],
                'tax_season' => ['month' => 4, 'description' => 'Tax payment', 'amount_multiplier' => 2.0],
                'back_to_school' => ['month' => 9, 'description' => 'Back to school', 'amount_multiplier' => 1.3],
                'summer_vacation' => ['month' => 7, 'description' => 'Summer vacation', 'amount_multiplier' => 1.4],
            ];
            
            $pattern = $seasonalPatterns[array_rand($seasonalPatterns)];
            $transactionDate = now()->subMonths(rand(1, 12))->month($pattern['month'])->day(rand(1, 28));
            
            $baseAmount = $this->generateAmount(false, true, $category->group->name, strtolower($account->type->value));
            $amount = $baseAmount * $pattern['amount_multiplier'];
            
            $transactions[] = [
                'account_id' => $account->id,
                'transactionable_id' => $payee->id,
                'transactionable_type' => Payee::class,
                'category_id' => $category->id,
                'date' => $transactionDate,
                'description' => "{$pattern['description']} - {$payee->name}",
                'amount' => $amount,
                'is_cleared' => $this->shouldBeCleared($transactionDate),
                'is_reconciled' => $this->shouldBeReconciled($transactionDate),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        return $transactions;
    }
}

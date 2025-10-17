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

        $transactionsPerAccount = 50; // Number of transactions to create per account

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
                $this->command->info("  - Creating {$transactionsPerAccount} transactions for account: {$account->name}");

                for ($i = 0; $i < $transactionsPerAccount; $i++) {
                    $category = $categories->random();
                    $payee = $payees->random();

                    // Determine if this should be income or expense based on category group
                    $isIncome = in_array($category->group->name, ['Income', 'Savings & Investments']);
                    $isExpense = in_array($category->group->name, ['Essential Expenses', 'Non-Essential Expenses', 'Debt Payments']);

                    // Decide whether this transaction is related to a payee or another account (transfer)
                    $isTransfer = rand(1, 10) === 1; // 10% chance of being a transfer

                    if ($isTransfer) {
                        // For transfers, use another account as transactionable
                        $otherAccounts = $accounts->where('id', '!=', $account->id);
                        if ($otherAccounts->isNotEmpty()) {
                            $transferAccount = $otherAccounts->random();
                            $transactionableId = $transferAccount->id;
                            $transactionableType = Account::class;
                            $description = $this->generateTransferDescription($account->name, $transferAccount->name);
                            $amount = $this->generateTransferAmount();
                        } else {
                            // Fallback to payee if no other accounts
                            $transactionableId = $payee->id;
                            $transactionableType = Payee::class;
                            $description = $this->generateDescription($payee->name, $category->name);
                            $amount = $this->generateAmount($isIncome, $isExpense, $category->group->name);
                        }
                    } else {
                        // Regular transaction with payee
                        $transactionableId = $payee->id;
                        $transactionableType = Payee::class;
                        $description = $this->generateDescription($payee->name, $category->name);
                        $amount = $this->generateAmount($isIncome, $isExpense, $category->group->name);
                    }

                    Transaction::create([
                        'account_id' => $account->id,
                        'transactionable_id' => $transactionableId,
                        'transactionable_type' => $transactionableType,
                        'category_id' => $category->id,
                        'date' => $this->generateTransactionDate(),
                        'description' => $description,
                        'amount' => $amount,
                        'is_cleared' => rand(1, 5) !== 1, // 80% cleared
                        'is_reconciled' => rand(1, 3) !== 1, // 67% reconciled
                    ]);

                    $totalTransactions++;
                }
            }

            $this->command->info("  - Created {$totalTransactions} total transactions for client team {$team->name}");
        }

        $this->command->info('Transactions created successfully for all client teams.');
    }

    /**
     * Generate a random transaction date within the last year
     */
    private function generateTransactionDate(): \DateTime
    {
        $startDate = now()->subYear();
        $endDate = now();

        return $startDate->addDays(rand(0, $endDate->diffInDays($startDate)));
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
     * Generate a transfer amount (always positive for outgoing transfers)
     */
    private function generateTransferAmount(): float
    {
        return rand(10000, 100000) / 100; // $100 - $1,000 for transfers
    }

    /**
     * Generate a realistic transaction amount
     */
    private function generateAmount(bool $isIncome, bool $isExpense, string $groupName): float
    {
        if ($isIncome) {
            return match ($groupName) {
                'Salary' => rand(200000, 1000000) / 100, // $2,000 - $10,000
                'Freelance' => rand(50000, 500000) / 100, // $500 - $5,000
                'Investment' => rand(1000, 50000) / 100, // $10 - $500
                'Bonus' => rand(100000, 500000) / 100, // $1,000 - $5,000
                default => rand(1000, 50000) / 100, // $10 - $500
            };
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
                default => rand(1000, 20000) / 100, // $10 - $200
            };
            return -$amount; // Negative for expenses
        }

        // For other types (shouldn't happen with current logic)
        return rand(-50000, 50000) / 100; // -$500 to $500
    }
}

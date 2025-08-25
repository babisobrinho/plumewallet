<?php

namespace App\Providers;

use App\Models\Budget;
use App\Models\Category;
use App\Models\Transaction;
use App\Policies\BudgetPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\TransactionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
   protected $policies = [
    Category::class => CategoryPolicy::class,
    Transaction::class => TransactionPolicy::class,
    Budget::class => BudgetPolicy::class,
    ];
    public function boot()
    {
        $this->registerPolicies();
    }
}

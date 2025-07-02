<?php

namespace App\Providers;

use App\Models\Category;
use App\Policies\CategoryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
   protected $policies = [
    Category::class => CategoryPolicy::class,
    Transaction::class => TransactionPolicy::class,
    ];
    public function boot()
    {
        $this->registerPolicies();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Desabilitar verificação de chaves estrangeiras temporariamente
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call([
            // User's data
            RolePermissionSeeder::class,
            UserSeeder::class,

            // User's financial data
            CategoryGroupSeeder::class,
            TransactionCategorySeeder::class,
            AccountSeeder::class,
            PayeeSeeder::class,
            TransactionSeeder::class,

            // Blog and FAQ content
            BlogAndFaqSeeder::class,
        ]);

        // Reabilitar verificação de chaves estrangeiras
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

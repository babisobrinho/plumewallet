<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Desativa os eventos de model durante o seeding para melhor performance
        // User::unsetEventDispatcher();

        // Cria o usuário de teste
        $user = User::factory()->withPersonalTeam()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Chama os seeders na ordem correta
        $this->call([
            AccountTypesSeeder::class,
            // Outros seeders podem ser adicionados aqui
            // Exemplo: TransactionsSeeder::class,
        ]);

        // Opcional: criar contas de exemplo associadas ao usuário de teste
        // Account::factory(5)->create(['user_id' => $user->id]);

        // Para criar mais usuários de teste (descomente se necessário)
        // User::factory(10)->withPersonalTeam()->create();
    }
}

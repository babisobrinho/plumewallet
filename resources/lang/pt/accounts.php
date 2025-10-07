<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Accounts Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for account management pages
    |
    */

    'title' => 'Minhas Carteiras',
    'view_archived' => 'Ver Carteiras Desativadas',
    'new_wallet' => 'Nova Carteira',
    'create_first_wallet' => 'Criar Primeira Carteira',

    // Balance Summary
    'total_balance_effective' => 'Saldo Total (Efetivo)',
    'excludes_marking_only' => 'Exclui valores marcados como "apenas marcação"',

    // Account Status
    'marking_only' => 'Apenas marcação',
    'mark_as_effective' => 'Marcar como efetivo',
    'mark_as_not_effective' => 'Marcar como não efetivo',
    'activate' => 'Ativar',
    'deactivate' => 'Desativar',

    // Actions
    'view_details' => 'Ver Detalhes',
    'edit' => 'Editar',
    'remove' => 'Remover',
    'confirm_remove' => 'Tem certeza que deseja remover esta carteira?',

    // Empty State
    'no_wallets_found' => 'Nenhuma carteira encontrada',
    'no_wallets_description' => 'Comece criando sua primeira carteira para gerir suas finanças.',

    // Create/Edit Form
    'create_wallet' => 'Criar Carteira',
    'edit_wallet' => 'Editar Carteira',
    'wallet_name' => 'Nome da Carteira',
    'wallet_name_placeholder' => 'Digite o nome da carteira',
    'account_type' => 'Tipo de Conta',
    'select_account_type' => 'Selecione o tipo de conta',
    'initial_balance' => 'Saldo Inicial',
    'initial_balance_placeholder' => '0,00',
    'color' => 'Cor',
    'icon' => 'Ícone',
    'description' => 'Descrição',
    'description_placeholder' => 'Descrição opcional da carteira',
    'is_balance_effective' => 'Saldo Efetivo',
    'is_balance_effective_description' => 'Marque se este saldo deve ser considerado no cálculo do saldo total',
    'save' => 'Guardar',
    'cancel' => 'Cancelar',
    'create' => 'Criar',

    // Validation Messages
    'name_required' => 'O nome da carteira é obrigatório.',
    'name_max' => 'O nome da carteira não pode ter mais de :max caracteres.',
    'account_type_required' => 'O tipo de conta é obrigatório.',
    'initial_balance_numeric' => 'O saldo inicial deve ser um número válido.',
    'color_required' => 'A cor é obrigatória.',
    'icon_required' => 'O ícone é obrigatório.',

    // Success Messages
    'created_successfully' => 'Carteira criada com sucesso!',
    'updated_successfully' => 'Carteira atualizada com sucesso!',
    'deleted_successfully' => 'Carteira removida com sucesso!',
    'status_updated' => 'Estado da carteira atualizado com sucesso!',

    // Archive Page
    'archived_wallets' => 'Carteiras Desativadas',
    'no_archived_wallets' => 'Nenhuma carteira desativada encontrada.',
    'restore' => 'Restaurar',
    'permanently_delete' => 'Eliminar Permanentemente',
    'confirm_permanent_delete' => 'Tem certeza que deseja eliminar permanentemente esta carteira? Esta ação não pode ser desfeita.',

    // Show Page
    'wallet_details' => 'Detalhes da Carteira',
    'current_balance' => 'Saldo Atual',
    'account_information' => 'Informações da Conta',
    'transactions' => 'Transações',
    'recent_transactions' => 'Transações Recentes',
    'no_transactions' => 'Nenhuma transação encontrada.',
    'add_transaction' => 'Adicionar Transação',

    // Account Types
    'checking_account' => 'Conta Corrente',
    'savings_account' => 'Conta Poupança',
    'credit_card' => 'Cartão de Crédito',
    'cash' => 'Dinheiro',
    'investment' => 'Investimento',
    'other' => 'Outro',
];

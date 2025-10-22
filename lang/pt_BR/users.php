<?php

return [
    'title' => 'Gestão de Utilizadores',
    'subtitle' => 'Gerir utilizadores do sistema',
    'total_users' => 'Total: :count utilizadores',
    'new_user' => 'Novo Utilizador',
    'no_users_found' => 'Nenhum utilizador encontrado',
    
    'filters' => [
        'status' => 'Estado',
        'user_type' => 'Tipo de Utilizador',
        'all_status' => 'Todos os Estados',
        'all_types' => 'Todos os Tipos',
    ],
    
    'sort_options' => [
        'created_at' => 'Data de Registo',
        'email_verified_at' => 'Data de Verificação',
    ],
    
    'messages' => [
        'user_created' => 'Utilizador criado com sucesso.',
        'user_updated' => 'Utilizador atualizado com sucesso.',
        'user_deleted' => 'Utilizador eliminado com sucesso.',
        'cannot_delete_self' => 'Não pode eliminar a sua própria conta.',
    ],

    'form' => [
        'select_type' => 'Selecione o tipo',
        'select_role' => 'Selecione o cargo',
        'full_name' => 'Nome Completo',
        'phone_number' => 'Número de Telefone',
        'user_type' => 'Tipo de Utilizador',
        'role' => 'Cargo',
        'password' => 'Palavra-passe',
        'email_verified' => 'Email Verificado',
        'verified_on' => 'Verificado em',
        'create_description' => 'Criar uma nova conta de utilizador com as informações necessárias.',
        'edit_description' => 'Atualize as informações do utilizador abaixo.',
        'password_optional' => 'Deixe em branco para manter a palavra-passe atual',
    ],

    'metrics' => [
        'total_users' => 'Total de Utilizadores',
        'active_users' => 'Utilizadores Ativos',
        'staff_users' => 'Utilizadores Staff',
        'client_users' => 'Utilizadores Cliente',
    ],
];

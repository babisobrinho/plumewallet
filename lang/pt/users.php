<?php

return [
    'title' => 'Gestão de Utilizadores',
    'subtitle' => 'Gerir utilizadores do sistema',
    'show_title' => 'Detalhes do Utilizador',
    'show_subtitle' => 'Informações completas do utilizador',
    'edit_user' => 'Editar Utilizador',
    'edit_description' => 'Atualizar informações do utilizador',
    'total_users' => 'Total: :count utilizadores',
    'new_user' => 'Novo Utilizador',
    'no_users_found' => 'Nenhum utilizador encontrado',
    'no_role' => 'Sem Função',
    'personal_information' => 'Informações Pessoais',
    'access_permissions' => 'Acesso e Permissões',
    'change_password' => 'Alterar Palavra-passe',
    
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
        'select_user_type' => 'Selecione o tipo de utilizador',
        'full_name' => 'Nome Completo',
        'phone_number' => 'Número de Telefone',
        'user_type' => 'Tipo de Utilizador',
        'role' => 'Cargo',
        'password' => 'Palavra-passe',
        'new_password' => 'Nova Palavra-passe',
        'add_user' => 'Adicionar Utilizador',
        'create_description' => 'Criar uma nova conta de utilizador',
        'edit_description' => 'Editar informações da conta do utilizador',
        'confirm_password' => 'Confirmar Palavra-passe',
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

    'danger_zone' => [
        'title' => 'Zona de Perigo',
        'delete_description' => 'Uma vez que um utilizador é eliminado, todos os seus dados serão removidos permanentemente. Esta ação não pode ser desfeita.',
        'delete_user' => 'Eliminar Utilizador',
        'delete_warning' => 'Esta ação não pode ser desfeita.',
        'delete_confirmation' => 'Tem a certeza de que pretende eliminar :name? Esta ação não pode ser desfeita.',
        'confirm_name_placeholder' => 'Digite o nome do utilizador para confirmar',
        'name_mismatch' => 'O nome que introduziu não corresponde ao nome do utilizador.',
    ],
];

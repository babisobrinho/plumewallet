<?php

return [
    'title' => 'Gestion des utilisateurs',
    'subtitle' => 'Gérer les utilisateurs du système',
    'show_title' => 'Détails de l\'utilisateur',
    'show_subtitle' => 'Informations complètes de l\'utilisateur',
    'edit_user' => 'Modifier l\'utilisateur',
    'edit_description' => 'Mettre à jour les informations de l\'utilisateur',
    'total_users' => 'Total : :count utilisateurs',
    'new_user' => 'Nouvel utilisateur',
    'no_users_found' => 'Aucun utilisateur trouvé',
    'no_role' => 'Aucun rôle',
    'personal_information' => 'Informations personnelles',
    'access_permissions' => 'Accès et permissions',
    'change_password' => 'Changer le mot de passe',
    
    'filters' => [
        'status' => 'Statut',
        'user_type' => 'Type d\'utilisateur',
        'all_status' => 'Tous les statuts',
        'all_types' => 'Tous les types',
    ],
    
    'sort_options' => [
        'created_at' => 'Date d\'inscription',
        'email_verified_at' => 'Date de vérification',
    ],
    
    'messages' => [
        'user_created' => 'Utilisateur créé avec succès.',
        'user_updated' => 'Utilisateur mis à jour avec succès.',
        'user_deleted' => 'Utilisateur supprimé avec succès.',
        'cannot_delete_self' => 'Vous ne pouvez pas supprimer votre propre compte.',
    ],

    'form' => [
        'select_type' => 'Sélectionner le type',
        'select_role' => 'Sélectionner le rôle',
        'select_user_type' => 'Sélectionner le type d\'utilisateur',
        'full_name' => 'Nom complet',
        'phone_number' => 'Numéro de téléphone',
        'user_type' => 'Type d\'utilisateur',
        'role' => 'Rôle',
        'password' => 'Mot de passe',
        'new_password' => 'Nouveau mot de passe',
        'confirm_password' => 'Confirmer le mot de passe',
        'email_verified' => 'Email vérifié',
        'verified_on' => 'Vérifié le',
        'create_description' => 'Créer un nouveau compte utilisateur avec les informations requises.',
        'edit_description' => 'Mettez à jour les informations de l\'utilisateur ci-dessous.',
        'password_optional' => 'Laissez vide pour conserver le mot de passe actuel',
    ],

    'metrics' => [
        'total_users' => 'Nombre total d\'utilisateurs',
        'active_users' => 'Utilisateurs actifs',
        'staff_users' => 'Utilisateurs du personnel',
        'client_users' => 'Utilisateurs clients',
    ],

    'danger_zone' => [
        'title' => 'Zone dangereuse',
        'delete_description' => 'Une fois qu\'un utilisateur est supprimé, toutes ses données seront définitivement supprimées. Cette action ne peut pas être annulée.',
        'delete_user' => 'Supprimer l\'utilisateur',
        'delete_warning' => 'Cette action ne peut pas être annulée.',
        'delete_confirmation' => 'Êtes-vous sûr de vouloir supprimer :name ? Cette action ne peut pas être annulée.',
        'confirm_name_placeholder' => 'Tapez le nom de l\'utilisateur pour confirmer',
        'name_mismatch' => 'Le nom que vous avez saisi ne correspond pas au nom de l\'utilisateur.',
    ],
];


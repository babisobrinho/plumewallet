<?php

return [
    'title' => 'Gestion des utilisateurs',
    'subtitle' => 'Gérer les utilisateurs du système',
    'edit_user' => 'Modifier l\'utilisateur',
    'edit_description' => 'Mettre à jour les informations de l\'utilisateur',
    'total_users' => 'Total : :count utilisateurs',
    'new_user' => 'Nouvel utilisateur',
    'no_users_found' => 'Aucun utilisateur trouvé',
    'personal_information' => 'Informations personnelles',
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
];

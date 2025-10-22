<?php

return [
    'title' => 'Gestion des utilisateurs',
    'subtitle' => 'Gérer les utilisateurs du système',
    'total_users' => 'Total : :count utilisateurs',
    'new_user' => 'Nouvel utilisateur',
    'no_users_found' => 'Aucun utilisateur trouvé',
    
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
        'full_name' => 'Nom complet',
        'phone' => 'Téléphone',
        'user_type' => 'Type d\'utilisateur',
        'email_verified' => 'Email vérifié',
        'verified_on' => 'Vérifié le',
    ],
];

<?php

return [
    'title' => 'Nous Contacter',
    'subtitle' => 'Contactez notre équipe',
    
    'labels' => [
        'name' => 'Nom',
        'company' => 'Entreprise',
        'email' => 'Email',
        'phone' => 'Téléphone',
        'subject' => 'Sujet',
        'custom_subject' => 'Sujet Personnalisé',
        'message' => 'Message',
        'preferred_language' => 'Langue Préférée',
        'process_number' => 'Numéro de Processus',
        'status' => 'Statut',
        'observation' => 'Observation',
    ],
    
    'form' => [
        'name' => 'Nom',
        'company' => 'Entreprise',
        'email' => 'Email',
        'phone' => 'Téléphone',
        'subject' => 'Sujet',
        'custom_subject' => 'Sujet Personnalisé',
        'message' => 'Message',
        'preferred_language' => 'Langue Préférée',
    ],
    
    'placeholders' => [
        'select_subject' => 'Sélectionnez un sujet',
        'custom_subject' => 'Veuillez spécifier votre sujet',
        'message' => 'Dites-nous comment nous pouvons vous aider...',
        'observation' => 'Ajoutez votre observation...',
    ],
    
    'buttons' => [
        'submit' => 'Envoyer',
        'submitting' => 'Envoi en cours...',
        'cancel' => 'Annuler',
        'add_observation' => 'Ajouter une Observation',
        'save_observation' => 'Sauvegarder l\'Observation',
        'update_status' => 'Mettre à jour le Statut',
        'clear_filters' => 'Effacer les Filtres',
    ],
    
    'messages' => [
        'submitted' => 'Merci ! Votre message a été envoyé avec succès. Votre numéro de processus est :process_number.',
        'error' => 'Une erreur s\'est produite lors de l\'envoi de votre message. Veuillez réessayer.',
        'observation_added' => 'Observation ajoutée avec succès.',
        'status_updated' => 'Statut mis à jour avec succès.',
    ],
    
    'filters' => [
        'all_statuses' => 'Tous les Statuts',
        'all_subjects' => 'Tous les Sujets',
        'search_placeholder' => 'Rechercher par nom, email ou numéro de processus...',
    ],
    
    'table' => [
        'columns' => [
            'process_number' => 'Numéro de Processus',
            'name' => 'Nom',
            'email' => 'Email',
            'subject' => 'Sujet',
            'status' => 'Statut',
            'created_at' => 'Date de Création',
            'actions' => 'Actions',
        ],
        'actions' => [
            'view' => 'Voir',
        ],
    ],
    
    'details' => [
        'title' => 'Détails du Formulaire de Contact',
        'subtitle' => 'Voir et gérer le formulaire de contact',
        'sections' => [
            'contact_info' => 'Informations de Contact',
            'message_details' => 'Détails du Message',
            'process_info' => 'Informations du Processus',
            'observations' => 'Observations',
        ],
        'fields' => [
            'process_number' => 'Numéro de Processus',
            'name' => 'Nom',
            'company' => 'Entreprise',
            'email' => 'Email',
            'phone' => 'Téléphone',
            'subject' => 'Sujet',
            'custom_subject' => 'Sujet Personnalisé',
            'message' => 'Message',
            'preferred_language' => 'Langue Préférée',
            'status' => 'Statut',
            'created_at' => 'Date de Création',
            'updated_at' => 'Dernière Mise à Jour',
        ],
    ],
    
    'modals' => [
        'add_observation' => 'Ajouter une Observation',
    ],
    
    'confirmation' => [
        'title' => 'Soumission du Formulaire de Contact',
        'subject' => 'Merci ! Votre soumission est confirmée - :process_number',
        'intro' => 'Bonjour :name, merci de nous avoir contactés ! Nous avons bien reçu votre message et notre équipe l\'examinera sous peu.',
        'details_title' => 'Détails de Votre Message',
        'process_info' => 'Informations du Processus',
        'process_details' => 'Votre numéro de processus est :process_number. Veuillez conserver ce numéro pour vos dossiers et le référencer dans toute communication future.',
        'button' => 'Aller à PlumeWallet',
        'footer' => '© 2025 Plume Wallet. Tous droits réservés.',
    ],
    
    'notification' => [
        'title' => 'Nouvelle Soumission de Formulaire de Contact',
        'intro' => 'Un nouveau formulaire de contact a été soumis via le site web.',
        'details' => 'Détails de Contact',
        'footer' => 'Veuillez examiner et répondre à ce formulaire de contact dès que possible.',
    ],
    
    'metrics' => [
        'total_forms' => 'Total des Formulaires',
        'new_forms' => 'Nouveaux Formulaires',
        'in_progress' => 'En Cours',
        'resolved' => 'Résolus',
    ],
];

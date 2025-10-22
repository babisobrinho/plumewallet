<?php

return [
    'roles' => [
        'names' => [
            'owner' => 'Propriétaire',
            'admin' => 'Administrateur',
            'manager' => 'Gestionnaire',
            'contributor' => 'Contributeur',
            'viewer' => 'Observateur',
        ],
        'descriptions' => [
            'owner' => 'Accès administratif complet incluant la suppression d\'espace et la gestion des membres.',
            'admin' => 'Accès complet à toutes les fonctionnalités sauf la suppression d\'espace. Peut gérer les membres et toutes les données financières.',
            'manager' => 'Peut gérer toutes les données financières (comptes, catégories, bénéficiaires, transactions), mais ne peut pas gérer les membres et les paramètres d\'espace.',
            'contributor' => 'Peut voir toutes les données financières et créer/mettre à jour les bénéficiaires et transactions, mais ne peut rien supprimer ou gérer les comptes/catégories.',
            'viewer' => 'Accès en lecture seule pour voir toutes les données d\'espace sans faire de modifications.',
        ],
    ],
];
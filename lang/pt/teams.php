<?php

return [
    'personal_space' => 'Meu Espaço',
    'roles' => [
        'names' => [
            'owner' => 'Proprietário',
            'admin' => 'Administrador',
            'manager' => 'Gestor',
            'contributor' => 'Contribuidor',
            'viewer' => 'Visualizador',
        ],
        'descriptions' => [
            'owner' => 'Acesso administrativo completo incluindo eliminação de espaço e gestão de membros.',
            'admin' => 'Acesso completo a todas as funcionalidades exceto eliminação de espaço. Pode gerir membros e todos os dados financeiros.',
            'manager' => 'Pode gerir todos os dados financeiros (contas, categorias, beneficiários, transações), mas não pode gerir membros e configurações de espaço.',
            'contributor' => 'Pode ver todos os dados financeiros e criar/atualizar beneficiários e transações, mas não pode eliminar nada ou gerir contas/categorias.',
            'viewer' => 'Acesso apenas de leitura para ver todos os dados do espaço sem fazer alterações.',
        ],
    ],
];


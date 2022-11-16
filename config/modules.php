<?php

return [
    'Rebanho' => [
        'Movimentação' => [
            'icon' => '',
            'menus' => [
                [
                    'id' => 1,
                    'icon' => 'fa-table-columns',
                    'name' => 'Entrada de animais',
                    'route' => 'animals.index'
                ],
                [
                    'id' => 2,
                    'icon' => 'fa-table-columns',
                    'name' => 'Saída de animais',
                    'route' => 'animal-exit'
                ],
                [
                    'id' => 3,
                    'icon' => 'fa-table-columns',
                    'name' => 'Movimento entre instalações',
                    'route' => 'animal-change-location'
                ],
                [
                    'id' => 4,
                    'icon' => 'fa-table-columns',
                    'name' => 'Registro de desmame',
                    'route' => 'animal-weaning.index'
                ],
            ]
        ],
        'Sanidade' => [
            'icon' => '',
            'menus' => [
                [
                    'id' => 1,
                    'icon' => 'fa-table-columns',
                    'name' => 'Animal/Doença',
                    'route' => 'animal-health.index'
                ],
                [
                    'id' => 2,
                    'icon' => 'fa-table-columns',
                    'name' => 'Ocorrências',
                    'route' => 'animal-treatments.index'
                ],
            ]
        ],
        'Reprodutivo' => [
            'icon' => '',
            'menus' => [
                [
                    'id' => 1,
                    'icon' => 'fa-table-columns',
                    'name' => 'Controle de coberturas',
                    'route' => 'animal-heat.index'
                ],
                [
                    'id' => 2,
                    'icon' => 'fa-table-columns',
                    'name' => 'Diagnóstico de prenhes',
                    'route' => 'pregnancy-diagnoses.index'
                ],
                [
                    'id' => 3,
                    'icon' => 'fa-table-columns',
                    'name' => 'Controle de Partos',
                    'route' => 'parturition-entries.index'
                ]
            ]
        ],
        'Produtivo' => [
            'icon' => '',
            'menus' => [
                [
                    'id' => 1,
                    'icon' => 'fa-table-columns',
                    'name' => 'Controle ponderal',
                    'route' => 'weight-controls.index'
                ],
                [
                    'id' => 2,
                    'icon' => 'fa-table-columns',
                    'name' => 'Controle leiteiro',
                    'route' => 'dairy-controls.index'
                ]
            ]
        ]
    ]
];
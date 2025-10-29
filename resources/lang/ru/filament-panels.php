<?php

return [
    'components' => [
        'pagination' => [
            'label' => 'Навигация по страницам',
        ],
    ],
    'pages' => [
        'dashboard' => [
            'title' => 'Панель управления',
        ],
    ],
    'resources' => [
        'label' => ':label',
        'plural_label' => ':label',
        'navigation_label' => ':label',
        'breadcrumb' => ':label',
        'pages' => [
            'list' => [
                'label' => 'Список',
                'breadcrumb' => 'Список',
            ],
            'create' => [
                'label' => 'Создать',
                'breadcrumb' => 'Создать',
                'title' => 'Создать :label',
                'modal' => [
                    'heading' => 'Создать :label',
                    'actions' => [
                        'create' => [
                            'label' => 'Создать',
                        ],
                        'create_another' => [
                            'label' => 'Создать и создать ещё',
                        ],
                    ],
                ],
            ],
            'edit' => [
                'label' => 'Изменить',
                'breadcrumb' => 'Изменить',
                'title' => 'Изменить :label',
                'modal' => [
                    'heading' => 'Изменить :label',
                    'actions' => [
                        'save' => [
                            'label' => 'Сохранить',
                        ],
                    ],
                ],
            ],
            'view' => [
                'label' => 'Просмотр',
                'breadcrumb' => 'Просмотр',
                'title' => 'Просмотр :label',
            ],
        ],
    ],
    'actions' => [
        'create' => [
            'label' => 'Создать',
        ],
        'edit' => [
            'label' => 'Изменить',
        ],
        'view' => [
            'label' => 'Просмотр',
        ],
        'delete' => [
            'label' => 'Удалить',
        ],
    ],
];


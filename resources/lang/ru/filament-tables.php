<?php

return [
    'actions' => [
        'filter' => [
            'label' => 'Фильтр',
            'indicators' => [
                'where' => 'Фильтр',
            ],
        ],
        'toggle_columns' => [
            'label' => 'Колонки',
        ],
    ],
    'columns' => [
        'text' => [
            'more_list_items' => 'ещё :count',
        ],
    ],
    'empty' => [
        'heading' => 'Нет записей',
    ],
    'filters' => [
        'actions' => [
            'remove' => [
                'label' => 'Удалить фильтр',
            ],
            'remove_all' => [
                'label' => 'Очистить все',
                'tooltip' => 'Очистить все',
            ],
            'reset' => [
                'label' => 'Сбросить',
            ],
        ],
        'heading' => 'Фильтры',
        'indicator' => 'Активные фильтры',
        'multi_select' => [
            'placeholder' => 'Все',
        ],
        'select' => [
            'placeholder' => 'Все',
        ],
        'trashed' => [
            'label' => 'Удалённые записи',
            'only_trashed' => 'Только удалённые',
            'with_trashed' => 'С удалёнными',
            'without_trashed' => 'Без удалённых',
        ],
    ],
    'pagination' => [
        'label' => 'Навигация по страницам',
        'overview' => 'Показано с :first по :last из :total записей',
        'fields' => [
            'records_per_page' => [
                'label' => 'на странице',
                'options' => [
                    'all' => 'Все',
                ],
            ],
        ],
        'actions' => [
            'go_to_page' => [
                'label' => 'Перейти на страницу :page',
            ],
            'next' => [
                'label' => 'Следующая',
            ],
            'previous' => [
                'label' => 'Предыдущая',
            ],
        ],
    ],
    'reorder' => [
        'label' => 'Изменить порядок',
        'modal' => [
            'heading' => 'Изменить порядок',
            'actions' => [
                'cancel' => [
                    'label' => 'Отмена',
                ],
                'save' => [
                    'label' => 'Сохранить',
                ],
            ],
        ],
    ],
    'search' => [
        'label' => 'Поиск',
        'placeholder' => 'Поиск',
        'indicator' => 'Поиск',
    ],
    'selection' => [
        'actions' => [
            'select_all' => [
                'label' => 'Выбрать все :count',
            ],
            'deselect_all' => [
                'label' => 'Снять выделение',
            ],
        ],
        'indicator' => 'Выбрано: :count',
    ],
    'summary' => [
        'heading' => 'Итого',
        'subheadings' => [
            'all' => 'Все :label',
            'group' => ':group: :label',
            'page' => 'Эта страница',
        ],
        'summarizers' => [
            'average' => 'Среднее',
            'count' => 'Количество',
            'sum' => 'Сумма',
        ],
    ],
];

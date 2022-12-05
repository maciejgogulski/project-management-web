<?php
return [
    'attributes' => [
        'name' => 'Nazwa',
        'manager' => 'Właściciel',
        'manager_assigned' => 'Przypisano właściciela',
        'has_tasks' => 'Ma zadania'
    ],
    'actions' => [
        'create' => 'Dodaj projekt',
        'update' => 'Zaktualizuj projekt',
        'delete' => 'Usuń projekt',
        'add_user' => 'Dodaj użytkownika'
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego projektu',
        'edit_form_title' => 'Edycja projektu',
    ],
    'placeholders' => [
        'enter_name' => 'Wprowadź nazwę',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano projekt :name',
            'updated' => 'Zaktualizowano projekt :name',
            'deleted' => 'Usunięto projekt :name',
        ],
    ],
];

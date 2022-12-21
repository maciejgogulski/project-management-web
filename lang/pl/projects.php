<?php
return [
    'attributes' => [
        'name' => 'Nazwa',
        'manager' => 'Właściciel',
        'manager_assigned' => 'Przypisano właściciela',
        'manager_unassigned' => 'Nie przypisano właściciela',
        'has_tasks' => 'Ma zadania',
        'number_of_tasks' => 'Liczba zadań',
        'no_tasks' => 'Brak zadań',
    ],
    'actions' => [
        'create' => 'Dodaj projekt',
        'update' => 'Zaktualizuj projekt',
        'delete' => 'Usuń projekt',
        'add_user' => 'Dodaj użytkownika'
    ],
    'labels' => [
        'create' => 'Stwórz projekt',
        'create_form_title' => 'Tworzenie nowego projektu',
        'edit_form_title' => 'Edycja projektu',
    ],
    'placeholders' => [
        'enter_name' => 'Wprowadź nazwę',
        'choose_manager' => 'Wybierz właściciela'
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano projekt :name',
            'updated' => 'Zaktualizowano projekt :name',
            'deleted' => 'Usunięto projekt :name',
        ],
    ],
];

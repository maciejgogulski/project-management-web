<?php

return [
    'attributes' => [
        'name' => 'Nazwa',
        'deadline' => 'Termin',
        'project_assigned' => 'Przypisane do projektu',
        'project_unassigned' => 'Nie przypisano do projektu',
        'user_assigned' => 'Przypisane do użytkownika',
        'user_unassigned' => 'Nie przypisano do użytkownika',
        'completed' => 'Ukończone',
        'not_completed' => 'Nieukończone',
        'user' => 'Użytkownik',
        'project' => 'Projekt'
    ],
    'actions' => [
        'mark_as_finished' => 'Oznacz jako ukończone',
        'mark_as_unfinished' => 'Oznacz jako nieukończone'
    ],
    'messages' => [
        'successes' => [
            'updated' => 'Zaktualizowano zadanie :name',
            'stored' => 'Utworzono zadanie :name',
            'deleted' => 'Usunięto zadanie :name',
        ],
    ],
    'labels' => [
        'create' => 'Stwórz zadanie',
        'create_form_title' => 'Tworzenie nowego zadania',
        'edit_form_title' => 'Edycja nowego zadania',
    ],
    'placeholders' => [
        'enter_name' => 'Wprowadź nazwę',
        'choose_user' => 'Przypisz użytkownika',
        'choose_project' => 'Przypisz do projektu',
        'pick_deadline' => 'Wybierz termin'
    ],
];

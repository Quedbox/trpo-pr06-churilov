<?php

require_once __DIR__ . '/../src/storage.php';
require_once __DIR__ . '/../src/view.php';

$notesPath = __DIR__ . '/../data/notes.json';
$notes = loadJson($notesPath);
$title = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $value = $_POST['title'] ?? '';
    $title = is_string($value) ? trim($value) : '';

    if ($title === '') {
        $error = 'Введите название заметки.';
    } else {
        $id = 1;
        foreach ($notes as $note) {
            $id = max($id, $note['id'] + 1);
        }

        $notes[] = ['id' => $id, 'title' => $title, 'done' => false];
        saveJson($notesPath, $notes);
        header('Location: /', true, 303);
        exit;
    }
}

render('list', ['notes' => $notes, 'title' => $title, 'error' => $error]);

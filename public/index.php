<?php

require_once __DIR__ . '/../src/storage.php';
require_once __DIR__ . '/../src/view.php';

$notesPath = __DIR__ . '/../data/notes.json';
$notes = loadJson($notesPath);
render('list', ['notes' => $notes]);

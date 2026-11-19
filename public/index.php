<?php

require_once __DIR__ . '/../src/storage.php';
require_once __DIR__ . '/../src/view.php';

session_start();

if (($_GET['page'] ?? 'list') !== 'list') {
    http_response_code(404);
    render('message', ['message' => 'Страница не найдена.']);
    exit;
}

try {
    $users = loadJson(__DIR__ . '/../data/users.json');
    $userNames = array_column($users, 'name');

    $notesPath = __DIR__ . '/../data/notes.json';
    $notes = loadJson($notesPath);
    foreach ($notes as $note) {
        if (!is_int($note['id'] ?? null) || !is_string($note['title'] ?? null)
            || !is_bool($note['done'] ?? null)) {
            throw new RuntimeException('В notes.json неверный формат записи.');
        }
    }
    $title = '';
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        if ($action === 'set_name') {
            $name = $_POST['display_name'] ?? '';
            if (in_array($name, $userNames, true)) {
                $_SESSION['display_name'] = $name;
                header('Location: /', true, 303);
                exit;
            }
            $error = 'Выберите пользователя из списка.';
        } elseif ($action === 'clear_name') {
            unset($_SESSION['display_name']);
            header('Location: /', true, 303);
            exit;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'add_note') {
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
} catch (JsonException $exception) {
    http_response_code(500);
    render('message', ['message' => 'Не удалось обработать JSON. Проверьте файлы в папке data.']);
    exit;
} catch (RuntimeException $exception) {
    http_response_code(500);
    render('message', ['message' => $exception->getMessage()]);
    exit;
}

render('list', [
    'notes' => $notes,
    'title' => $title,
    'error' => $error,
    'userNames' => $userNames,
    'displayName' => $_SESSION['display_name'] ?? 'Гость',
]);

<?php

function loadJson(string $path): array
{
    if (!is_file($path) || !is_readable($path)) {
        throw new RuntimeException('Файл ' . basename($path) . ' отсутствует или недоступен.');
    }

    $text = file_get_contents($path);
    if ($text === false) {
        throw new RuntimeException('Не удалось прочитать ' . basename($path) . '.');
    }

    $data = json_decode($text, true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($data) || !array_is_list($data)) {
        throw new RuntimeException('В файле ' . basename($path) . ' ожидается список записей.');
    }

    return $data;
}

function saveJson(string $path, array $data): void
{
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    if (!is_writable($path) || file_put_contents($path, $json . PHP_EOL, LOCK_EX) === false) {
        throw new RuntimeException('Не удалось сохранить заметку в ' . basename($path) . '.');
    }
}

<?php

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function render(string $template, array $data): void
{
    require __DIR__ . '/../templates/' . $template . '.php';
}

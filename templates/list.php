<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Список заметок</title>
</head>
<body>
    <header><h1>Список заметок</h1></header>
    <main>
        <?php if ($data['notes'] === []): ?>
            <p>Заметок пока нет.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($data['notes'] as $note): ?>
                    <li>
                        <?= e($note['title']) ?> —
                        <?= $note['done'] ? 'выполнено' : 'в работе' ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>
</body>
</html>

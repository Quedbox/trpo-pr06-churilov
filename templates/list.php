<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Список заметок</title>
</head>
<body>
    <header>
        <h1>Список заметок</h1>
        <p>Пользователь: <strong><?= e($data['displayName']) ?></strong></p>
        <form method="post" action="/">
            <input type="hidden" name="action" value="set_name">
            <label for="display_name">Выбрать имя</label>
            <select id="display_name" name="display_name">
                <?php foreach ($data['userNames'] as $name): ?>
                    <option value="<?= e($name) ?>" <?= $name === $data['displayName'] ? 'selected' : '' ?>>
                        <?= e($name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Сохранить имя</button>
        </form>
        <form method="post" action="/">
            <button type="submit" name="action" value="clear_name">Сбросить имя</button>
        </form>
    </header>
    <main>
        <?php if ($data['error'] !== ''): ?>
            <p role="alert"><?= e($data['error']) ?></p>
        <?php endif; ?>
        <section>
            <h2>Новая заметка</h2>
            <form method="post" action="/">
                <input type="hidden" name="action" value="add_note">
                <label for="title">Название</label>
                <input id="title" name="title" value="<?= e($data['title']) ?>" required>
                <button type="submit">Добавить</button>
            </form>
        </section>
        <h2>Заметки</h2>
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

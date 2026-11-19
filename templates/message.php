<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Заметки — сообщение</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <main>
        <h1><?= e($data['message']) ?></h1>
        <p><a href="/">К списку заметок</a></p>
    </main>
</body>
</html>

<?php include_once __DIR__ . '/../header.php'; ?>

<h1 class = "error"><?= $error ?></h1>
<div class="instruction">
    <h3>Выполните следующие шаги:</h3>
    <ul>
        <li>Создайте баду данных</li>
        <li>Откройте файл Project\settings.php и обновите настройки подключения к базе данных</li>
        <li>Перейдите по <a href="install">ссылке</a> для создания необходимых таблиц автоматически</li>
    </ul>
</div>
<?php include_once __DIR__ . '/../footer.php'; ?>

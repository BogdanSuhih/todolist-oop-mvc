<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title><?= $title ?>
    </title>
</head>
<body>

    <header>
        <nav>
            <a href="index.php">
                Главная
            </a>
            <ul>
                <?php if (!isset($user)) : ?>
                <a href="login">
                    <li>Вход</li>
                </a>
                <a href="register">
                    <li>Регистрация</li>
                </a>
                <?php else : ?>
                    <li>Привет, <?=$user->getNickname()?></li>
                    <a href="logout">
                    <li>Выйти</li>
                </a>
                <?php endif ?>
            </ul>
        </nav>
    </header>

    <main>
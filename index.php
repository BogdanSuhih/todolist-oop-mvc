<?php
spl_autoload_register(function (string $className) {
    require_once __DIR__ . '\\' . $className . '.php';
});
require_once 'connection.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    
    <title>TODO</title>
</head>
<body>
    <div class="wrapper">
        <form action="" method="POST" autocomplete="off">
            <div>
                <input type="text" name="" id="text_input">
                <input type="submit" value="Add" class = "action_btn">
            </div>
            <input type="hidden" name="">
        </form>
    </div>
</body>
</html>

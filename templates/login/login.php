<?php include_once __DIR__ . '/../header.php'; ?>
<?php if ($error??'') :?>
    <span class="reg_error"><?= $error ?></span>
<?php endif; ?>

<div class="form_wrapper auth-form">
    <h1>Авторизация</h1>
    <hr>
    <form action="login" method="post">
        <div class="form_group">
            <label for="email" class="required">Email</label>
            <input
            type="text"
            name="email"
            id="email"
            value="<?= $_POST["email"]??"" ?>"
            
            />
        </div>
        <div class="form_group">
            <label for="password" class="required">Пароль</label>
            <input type="password" name="password" id="password"/>
        </div>
        <div class="btn">
            <input type="submit" value="Войти">
        </div>
        <?php if ($msg??'') :?>
        <span class="reg_error"><?= $msg ?></span>
        <?php endif; ?>
</form>
</div>

<?php include_once __DIR__ . '/../footer.php';

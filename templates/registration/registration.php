<?php include_once __DIR__ . '/../header.php'; ?>

<?php if ($error??'') :?>
    <span class="reg_error"><?= $error ?></span>
<?php endif; ?>

<div class="form_wrapper reg_form">
    <h1>Регистрация</h1>
    <hr>
    <form action="register" method="post" autocomplete="off">
        <div class="form_group">
            <label for="nickname" class="required">Никнейм</label>
            <input type="text" name="nickname" id="nickname"  value="<?= $_POST["nickname"]??"" ?>"/>
        </div>
        <div class="form_group">
          <label for="email" class="required" >E-mail</label>
          <input
            type="text"
            name="email"
            id="email"
            placeholder="E-mail адрес"
            value="<?= $_POST["email"]??"" ?>"
          />
        </div>
        <div class="form_group">
            <label for="password" class="required">Пароль</label>
            <input type="password" name="password" id="password"  />
        </div>
        <div class="btn">
            <input type="submit" value="Зарегистрироваться">
        </div>
        <?php if ($msg??'') :?>
        <div class="reg_error"><?= $msg ?></div>
        <?php endif; ?>
    </form>    
</div>


<?php include_once __DIR__ . '/../footer.php'; ?>

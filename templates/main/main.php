<?php require_once __DIR__ . '/../header.php'; ?>

<div class="block_main">

    <?php if (isset($user)) :?>
        <div class="add_todo">
                <form action="addtodo" method="POST" autocomplete="off">
                    <div class="add">
                        <input type="text" name="todo"  placeholder="Добавить запись">
                        <input type="hidden" name="user_id" value="<?= $user->getId() ?>">
                        <input type="submit" value="" class = "action_btn">
                    </div>
                </form>
        </div>
        <div class="block_todo">
        <?php if (isset($todos[0])) :?>
            <ol>
                <?php foreach ($todos as $todo) :?>
                   <a href="delete?id=<?=$todo->getId()?>">Del</a>
                <li>
                    <span><?=$todo->getText()?></span>
                </li>
                <?php endforeach; ?>
            </ol>
        </div>
        <?php else :?>
            <span>Добавьте задачу в список</span>
        <?php endif ;?>
    <?php else :?>
    <div class="block_welcome">
        <h2>Добро пожаловать!</h2>
        <p>Чтобы составить список дел, <a href="login">
                        войдите
                    </a> или <a href="registr">
                        зарегистрируйтесь
                    </a></p>
        
    </div>
    <?php endif ;?>

    
    
    
</div>

<?php require_once __DIR__ . '/../footer.php'; ?>

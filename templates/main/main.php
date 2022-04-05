<?php require_once __DIR__ . '/../header.php'; ?>

<div class="block_main">

    <?php if (isset($user)) :?>
        <div class="add_todo">
                <form 
                action="<?= isset($_GET['route']) && $_GET['route']=='edit'?'updatetodo':'addtodo' ?>"
                method="POST" 
                autocomplete="off">
                    <div class="block_input">
                        <input
                            value="<?= isset($_GET['route']) && $_GET['route']=='edit'?$currentTodo->getText():'' ?>"
                            type="text"
                            name="todo"
                            placeholder="Добавить запись"
                            required
                            autofocus
                        >
                        <input type="hidden" name="user_id" value="<?= $user->getId() ?>">
                        <input type="hidden" name="todo_id" value="<?= isset($currentTodo)?$currentTodo->getId():''?>">
                        <input
                            type="submit" 
                            value=""
                            title="<?=isset($currentTodo)?'Изменить':'Добавить'?>" 
                            class = "action_btn"
                        >
                    </div>
                </form>
        </div>
        <div class="block_todo">
        <?php if (isset($todos[0])) :?>
            <?php
                $num = 1;
            ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Задача</th>
                        <th>Дата</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($todos as $todo) :?>
                <tr>
                    <th class = "numb">
                        <?= $num ?>
                    </th>
                    <td class = "task">
                        <?= $todo->getText() ?>
                    </td>
                    <td class="date">
                        <?= date('d.m.y', strtotime($todo->getCreatedAt())) ?>
                    </td>
                    <td class = "actions">
                        <a href="delete?id=<?= $todo->getId() ?>" class="delete">Удалить</a>
                        <a href="edit?id=<?= $todo->getId() ?>" class="edit">Изменить</a>
                    </td>

                </tr>
                <?php $num++ ?>
            <?php endforeach; ?>
            </tbody>
            </table>
        </div>
        <?php else :?>
            <span>Добавьте задачу в список</span>
        <?php endif ;?>
    <?php else :?>
    <div class="block_welcome">
        <h2>Добро пожаловать!</h2>
        <p>Чтобы составить список дел, 
            <a href="login">войдите</a>
             или 
            <a href="register">зарегистрируйтесь</a>
        </p>
    </div>
    <?php endif ;?>

    
    
    
</div>

<?php require_once __DIR__ . '/../footer.php'; ?>

<?php
// エラー表示
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
require_once __DIR__ . '/../common/common.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ToDoアプリ_index</title>
    <style>
        /* ボタンなどはいずれbootstrapを用いたい */
        .task-box {
            border: 1px solid #999;
            padding: 10px;
            margin-bottom: 10px;
            width: 400px;
        }
        /* ボタンを右側に寄せるためのcss */
        .buttons {
            text-align: right;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>ToDo一覧</h1>
<div>
    <form method="post" action="<?php echo BASE_URL; ?>/route/todo_branch.php">
        <button type="submit" name="action" value="add">todoリストを追加</button>
    </form>
</div>

    <?php foreach ($tasks as $task) { ?>
        <div class="task-box">
            <h3><?php echo Sanitizer::sanitize($task->getTitle()); ?></h3>
            <p><?php echo Sanitizer::nl2br_sanitize($task->getContent()); ?></p>
            
            <small>
                作成日: <?php echo Sanitizer::sanitize($task->getCreatedAt()); ?> <br>
                最終更新日: <?php echo Sanitizer::sanitize($task->getUpdatedAt()); ?> <br>
                <!-- 確認用にIDを表示-実装時にはコメントアウト -->
                <!-- ID:<?php echo $task->getId(); ?>  -->
            </small>

            <div class="buttons">
                <form method="post" action="<?php echo BASE_URL; ?>/route/todo_branch.php">
                <input type="hidden" name="id" value="<?php echo Sanitizer::sanitize($task->getId()); ?>">
                <button type="submit" name="action" value="edit">編集</button>
                <button type="submit" onclick="return confirm('本当にこのToDoリストを削除してもよろしいですか？')" 
                name="action" value="delete">削除</button>
                </form>
            </div>
        </div>
    <?php } ?>

</body>
</html>

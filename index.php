<?php
// エラー表示
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'todo_class/db.php';

// TaskModekを呼び出してでデータベースに接続する
$model = new TaskModel();
// getAllでデータベースの中身を全て取り出す
$tasks = $model->getAll();
// 総件数を数える
// $totalCount = count($tasks);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ToDoアプリ_index</title>
    <style>
        /* ボタンなどはいずれbootstrapを用いたい */
        /* ボタンを右側に寄せるためのcss */
        .task-box {
            border: 1px solid #999;
            padding: 10px;
            margin-bottom: 10px;
            width: 400px;
        }
        .buttons {
            text-align: right;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>ToDo一覧</h1>
<div>
    <form method="post" action="todo_add.php">
        <button type="submit">todoリスト追加</button>
    </form>
</div>

    <?php foreach ($tasks as $task) { ?>
        <div class="task-box">
            <h3><?php echo $task->getTitle(); ?></h3>
            <p><?php echo $task->getContent(); ?></p>
            
            <small>
                作成日: <?php echo $task->getCreatedAt(); ?> <br>
                最終更新日: <?php echo $task->getUpdatedAt(); ?> <br>
                ID:<?php echo $task->getId(); ?> 
            </small>

            <div class="buttons">
                <form method="post" action="todo_branch.php">
                <input type="hidden" name="id" value="<?php echo $task->getId(); ?>">
                <input type="submit" name="edit" value="編集">
                <input type="submit" name="delete" value="削除">
                </form>
            </div>
        </div>
    <?php } ?>

</body>
</html>
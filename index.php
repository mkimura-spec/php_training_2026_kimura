<?php
// エラー表示
ini_set('display_errors', 1);
error_reporting(E_ALL);

// config/database.phpからPDOオブジェクトを呼び出す
$pdo = require_once __DIR__ . '/config/database.php';
// todo_class/db.phpを呼び出す→TaskModelを使う
require_once __DIR__ . '/todo_class/db.php';
// common/common.phpを呼び出す→XSS対策
require_once __DIR__ . '/common/common.php';

// TaskModekを呼び出してでデータベースに接続する
$model = new TaskModel($pdo);
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
    <form method="post" action="todo_branch.php">
        <button type="submit" name="action" value="add">todoリストを追加</button>
    </form>
</div>

    <?php foreach ($tasks as $task) { ?>
        <div class="task-box">
            <h3><?php echo sanitizing::sanitize($task->getTitle()); ?></h3>
            <p><?php echo sanitizing::nl2br_sanitize($task->getContent()); ?></p>
            
            <small>
                作成日: <?php echo sanitizing::sanitize($task->getCreatedAt()); ?> <br>
                最終更新日: <?php echo sanitizing::sanitize($task->getUpdatedAt()); ?> <br>
                <!-- 確認用にIDを表示-実装時にはコメントアウト -->
                <!-- ID:<?php echo $task->getId(); ?>  -->
            </small>

            <div class="buttons">
                <form method="post" action="todo_branch.php">
                <input type="hidden" name="id" value="<?php echo $task->getId(); ?>">
                <button type="submit" name="action" value="edit">編集</button>
                <button type="submit" name="action" value="delete">削除</button>
                </form>
            </div>
        </div>
    <?php } ?>

</body>
</html>
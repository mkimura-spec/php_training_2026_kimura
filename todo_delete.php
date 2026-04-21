<?php

// エラー表示
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// DB接続
try {
    $pdo = require_once __DIR__ . '/config/database.php';
} catch (PDOException $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    // エラー確認
    // echo 'エラー原因：' . $e->getMessage();
    exit;
}
require_once __DIR__ . '/models/db.php';
require_once __DIR__ . '/common/common.php';

// 1. URLからIDを受け取る（GET送信）
$id = $_GET['id'] ?? '';

if (empty($id)) {
    exit('不正なアクセスです。IDが指定されていません。');
}

// 2. モデルを準備
$model = new TaskModel($pdo);

// 3. IDに一致するタスクを1件だけ取得する
$task = $model->findById($id);

// もしタスクが見つからなかった場合のエラー処理
if (!$task) {
    exit('指定されたタスクが見つかりません。すでに削除された可能性があります。');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>削除画面</title>
    <style>
       .task-box {
            border: 1px solid #999;
            padding: 10px;
            margin-bottom: 10px;
            width: 400px;
        }
        .warning {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h3>タスクの削除確認</h3>
    <p class="warning">以下のタスクを削除しようとしています。この操作は取り消せません。</p>

    <div class="task-box">
        <h3><?php echo Sanitizer::sanitize($task->getTitle()); ?></h3>
        <p><?php echo Sanitizer::nl2br_sanitize($task->getContent()); ?></p>
        <small>
        作成日: <?php echo Sanitizer::sanitize($task->getCreatedAt()); ?> <br>
        最終更新日: <?php echo Sanitizer::sanitize($task->getUpdatedAt()); ?> <br>
        </small>
    </div>

    <form method="post" action="todo_delete_done.php">
        <input type="hidden" name="id" value="<?php echo Sanitizer::sanitize($task->getId()); ?>">
        <button type="button" onclick="history.back()">キャンセルして戻る</button>
        <button type="submit">削除する</button>
    </form>
</body>
</html>

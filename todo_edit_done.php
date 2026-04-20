<?php
// config/database.phpからPDOオブジェクトを呼び出す
// DB接続の例外処理は呼び出し側で行うように変更
try {
    $pdo = require_once __DIR__ . '/config/database.php';
} catch (PDOException $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    // エラー確認
    echo 'エラー原因：' . $e->getMessage();
    // exit;
}
require_once __DIR__ . '/models/db.php';

$model = new TaskModel($pdo);

// todo_add_check.phpからhiddenで情報を受け取る
$title = $_POST['title'];
$content = $_POST['content'];
$id = $_POST['id'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>todoリスト編集_実行</title>
    <!-- <link rel="stylesheet" href="../styles.css"> -->
     </head>
<body>
    <?php

try {
    $model->update($id, $title, $content);
    echo '指定されたtodoリストを変更しました。<br>';
} catch (Exception $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    // エラー確認
    echo 'エラー原因：' . $e->getMessage();
    exit;
}
?>

<a href="index.php">todoリスト一覧へ戻る</a>
</body>
</html>

<?php

$id = $_GET['id'];

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

if (empty($id)) {
    exit('不正なアクセスです。IDが指定されていません。');
}

// 2. モデルを準備
$model = new TaskModel($pdo);

// 3. IDに一致するタスクを1件だけ取得する（※後でTaskModelに追記します）
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
  <title>ToDo編集画面</title>
</head>
<body>
  <h1>ToDoリスト編集</h1>
  <form method="post" action="todo_edit_check.php">
    <p>タイトル：
      <br>
      <input type="text" name="title" value="<?php echo Sanitizer::sanitize($task->getTitle()); ?>"style="width:300px;">
    </p>
    <p>内容：
      <br>
      <!-- textareaの中は生の改行をそもまま認識してくれるのでnl2brは不要・textareaは改行が楽 -->
      <textarea name="content" style="width:300px; height:100px;"><?php echo Sanitizer::sanitize($task->getContent()); ?></textarea>
    </p>
    <input type="button" onclick="history.back()" value="一覧画面へ戻る">
    <input type="hidden" name="id" value="<?php echo Sanitizer::sanitize($id); ?>">
    <input type="submit" value="変更する">
  </form>
</body>

</html>

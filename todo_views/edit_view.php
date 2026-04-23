<?php

require_once __DIR__ . '/../common/common.php';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>ToDo編集画面</title>
</head>
<body>
  <h1>ToDoリスト編集</h1>

    <?php if (!empty($errors)) { ?>
        <?php foreach ($errors as $error) { ?>
            <p><?php echo Sanitizer::sanitize($error); ?></p>
        <?php } ?>
    <?php } ?>

  <form method="post" action="<?php echo BASE_URL; ?>/route/todo_branch.php">
    <p>タイトル：
      <br>
      <input type="text" name="title" value="<?php echo Sanitizer::sanitize($title); ?>" style="width:300px;">
    </p>
    <p>内容：
      <br>
      <!-- textareaの中は生の改行をそのまま認識してくれるのでnl2brは不要・textareaは改行が楽 -->
      <textarea name="content" style="width:300px; height:100px;"><?php echo Sanitizer::sanitize($content); ?></textarea>
    </p>
    <button type="button" onclick="location.href='<?php echo BASE_URL; ?>/index.php'">一覧画面へ戻る</button>
    <input type="hidden" name="action" value="edit_store">
    <input type="hidden" name="id" value="<?php echo Sanitizer::sanitize($id); ?>">
    <input type="submit" value="変更する">
  </form>
</body>

</html>

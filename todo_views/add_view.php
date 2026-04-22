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
  <title>ToDo追加画面</title>
</head>

<body>
  <h1>ToDo新規追加</h1>

  <?php if (!empty($errors)) { ?>

        <?php foreach ($errors as $error) { ?>
            <p><?php echo Sanitizer::sanitize($error); ?></p>
        <?php } ?>
    <?php } ?>

  <form method="post" action="<?php echo BASE_URL; ?>/route/todo_branch.php">
    <p>タイトル：
      <br>
      <input type="text" name="title" style="width:300px;" value="<?php echo Sanitizer::sanitize($title); ?>">
    </p>
    <p>内容：
      <br>
      <textarea name="content" style="width:300px; height:100px;"><?php echo Sanitizer::sanitize($content); ?></textarea>
    </p>
    <input type="hidden" name="action" value="add_store">
    <button type="button" onclick="location.href='<?php echo BASE_URL; ?>/index.php'">一覧画面へ戻る</button>
    <input type="submit" value="追加する">
  </form>
</body>

</html>

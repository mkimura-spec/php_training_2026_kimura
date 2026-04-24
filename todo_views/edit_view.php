<?php
require_once __DIR__ . '/../common/common.php';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>ToDo編集画面</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
          .error{
            border: 1px solid red;
            background-color: #ffffff;
            padding: 10px;
          }
          .container {
            width: 320px;
            margin: 0 auto;
          }
  </style>
</head>

<body style="background-color: #f0f8ff">
  <div class="container">
    <h1>ToDoリスト編集</h1>
    <?php if (!empty($errors)) { ?>
    <div class="error">
      <p style="color: red;">⚠ 入力内容に誤りがあります！</p>
      <?php foreach ($errors as $error) { ?>
      <p>
        <?php echo Sanitizer::sanitize($error); ?>
      </p>
      <?php } ?>
    </div>
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
      <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" onclick="location.href='<?php echo BASE_URL; ?>/index.php'">← 一覧画面へ戻る</button>
        <input type="hidden" name="action" value="edit_store">
        <input type="hidden" name="id" value="<?php echo Sanitizer::sanitize($id); ?>">
        <input type="submit" class="btn btn-primary" value="✓ 変更する">
      </div>
    </form>
  </div>
</body>

</html>

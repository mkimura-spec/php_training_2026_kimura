<?php
require_once __DIR__ . '/../common/common.php';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>ToDo追加画面</title>
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
    <h1 style="text-align: center;">ToDo新規追加</h1>
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
        <input type="text" name="title" style="width:300px;" value="<?php echo Sanitizer::sanitize($title); ?>">
      </p>
      <p>内容：
        <br>
        <textarea name="content" style="width:300px; height:100px;"><?php echo Sanitizer::sanitize($content); ?></textarea>
      </p>
      <div class="d-flex justify-content-between">
        <input type="hidden" name="action" value="add_store">
        <button type="button" class="btn btn-secondary" onclick="location.href='<?php echo BASE_URL; ?>/index.php'">← 一覧画面へ戻る</button>
        <input type="submit" class="btn btn-primary" value="+ 追加する" style="padding: 5px 15px;">
      </div>
    </form>
  </div>
</body>

</html>

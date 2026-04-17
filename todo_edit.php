<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>ToDo編集画面</title>
</head>
<?php

$id = $_GET['id'];

?>
<body>
  <h1>ToDo新規追加</h1>
  <form method="post" action="todo_edit_check.php">
    <p>タイトル：
      <br>
      <input type="text" name="title" style="width:300px;">
    </p>
    <p>内容：
      <br>
      <textarea name="content" style="width:300px; height:100px;"></textarea>
    </p>
    <input type="submit" value="追加する">
    <input type="button" onclick="history.back()" value="一覧画面へ戻る">
  </form>
</body>

</html>
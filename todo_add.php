<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>ToDo追加画面</title>
</head>

<body>
  <h1>ToDo新規追加</h1>
  <form method="post" action="todo_add_check.php">
    <p>タイトル：
      <br>
      <input type="text" name="title" style="width:300px;">
    </p>
    <p>内容：
      <br>
      <textarea name="content" style="width:300px; height:100px;"></textarea>
    </p>
    <input type="button" onclick="history.back()" value="一覧画面へ戻る">
    <input type="submit" value="追加する">
  </form>
</body>

</html>

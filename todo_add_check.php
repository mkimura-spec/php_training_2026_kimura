<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ToDo追加画面_確認</title>
</head>

<?php

// todo_add_phpから入力を受け取る
$title = $_POST['title'];
$content = $_POST['content'];

// 入力チェック
$error = [];
if ('' == $title) {
    $error[] = 'タイトルが入力されていません。';
} elseif (mb_strlen($title) > 255) {
    $error[] = 'タイトルは255文字以内で入力してください。';
}

// エラーがある場合の表示処理
if (!empty($error)) {
    foreach ($error as $err) {
        echo $err . '<br>';
    }

    echo '</div>';
    echo '<button type="button" onclick="history.back()">戻る</button>';
} else {
    ?>

<h2>入力内容の確認</h2>

        <p>以下の内容で登録します。よろしいですか？</p>

        <p>タイトル<br>
        <?php echo $title; ?></p>

        <p>内容<br>
        <?php echo $content; ?></p>

        <form action="todo_add_done.php" method="post">
            <input type="hidden" name="title" value="<?php echo $title; ?>">
            <input type="hidden" name="content" value="<?php echo $content; ?>">
            
            <button type="button" onclick="history.back()">戻る</button>
            <button type="submit">追加を実行する</button>
        </form>
<?php }?>
</body>
</html>
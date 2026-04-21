<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ToDo編集画面_確認</title>
</head>

<?php

require_once __DIR__ . '/common/common.php';
require_once __DIR__ . '/models/TaskValidator.php';

// todo_edit_phpから入力を受け取る
$title = $_POST['title'];
$content = $_POST['content'];
$id = $_POST['id'];

// 入力チェック
$error = TaskValidator::validate($title, $content);
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

        <p>以下の内容で変更します。よろしいですか？</p>

        <p>タイトル<br>
        <?php echo Sanitizer::sanitize($title); ?></p>

        <p>内容<br>
        <?php echo Sanitizer::nl2br_sanitize($content); ?></p>

        <form action="todo_edit_done.php" method="post">
            <input type="hidden" name="title" value="<?php echo Sanitizer::sanitize($title); ?>">
            <input type="hidden" name="content" value="<?php echo Sanitizer::sanitize($content); ?>">
            <input type="hidden" name="id" value="<?php echo Sanitizer::sanitize($id); ?>">
            
            <button type="button" onclick="history.back()">戻る</button>
            <button type="submit">変更を実行する</button>
        </form>
<?php }?>
</body>
</html>

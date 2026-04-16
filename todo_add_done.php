<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>todoリスト追加_実行</title>
    <!-- <link rel="stylesheet" href="../styles.css"> -->
     </head>
<body>
    <?php
    require_once './models/db.php';

    $model = new TaskModel();

    // todo_add_check.phpからhiddenで情報を受け取る
    $title = $_POST['title'];
    $content = $_POST['content'];

    try {
        $model->add($title, $content);
        echo 'todoリストを追加しました。<br>';
    } catch (Exception $e) {
        echo 'ただいま障害により大変ご迷惑をおかけしております。';
        // エラー確認
        echo 'エラー原因：' . $e->getMessage();
        exit;
    }
    ?>

<a href="index.php">戻る</a>
</body>
</html>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>todoリスト追加_実行</title>
    <!-- <link rel="stylesheet" href="../styles.css"> -->
     </head>
<body>
    <?php
    // config/database.phpからPDOオブジェクトを呼び出す
    $pdo = require_once __DIR__ . '/config/database.php';
    require_once __DIR__ . '/todo_class/db.php';

    $model = new TaskModel($pdo);

    $id = $_POST['id'];

    try {
        $model->delete($id);
        echo 'このtodoリストを削除しました。<br>';
    } catch (Exception $e) {
        echo 'ただいま障害により大変ご迷惑をおかけしております。';
        // エラー確認
        echo 'エラー原因：' . $e->getMessage();
        exit;
    }
    ?>

<a href="index.php">todoリスト一覧へ戻る</a>
</body>
</html>
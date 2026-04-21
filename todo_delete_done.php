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
    try {
        $pdo = require_once __DIR__ . '/config/database.php';
    } catch (PDOException $e) {
        // PDO例外が発生した場合
        echo 'ただいまシステム障害によりご迷惑をおかけしております。';
        // error_log($e->getMessage());
        exit;
    }
    require_once __DIR__ . '/models/db.php';

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

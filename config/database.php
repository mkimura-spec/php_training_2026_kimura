<?php

// config/database.php

$dsn = 'mysql:dbname=php_advance;host=localhost;charset=utf8';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $user, $password);
    // エラーモードを例外に設定（必須の品質要件）
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ★ポイント：作られたPDOオブジェクトを「返す」
    return $pdo;
} catch (PDOException $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    // エラー確認
    echo 'エラー原因：' . $e->getMessage();
    exit;
}

<?php

$dsn = 'mysql:dbname=php_advance;host=localhost;charset=utf8';
$user = 'root';
$password = '';

// エラーモードを例外に設定（必須の品質要件）
// エラーが出た場合エラーメッセージを配列にして格納させる
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

// ★ポイント：作られたPDOオブジェクトを「返す」
return new PDO($dsn, $user, $password, $options);

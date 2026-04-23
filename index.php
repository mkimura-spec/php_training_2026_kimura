<?php

// index.php (大元の入り口)

// エラー表示設定
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// コントローラーを読み込む
require_once __DIR__ . '/controllers/ListController.php';
require_once __DIR__ . '/models/db.php';

// DB接続 // フロントコントローラーで接続
try {
    require_once __DIR__ . '/config/database.php';
    $db = new Database();
    $pdo = $db->createPDO();
} catch (PDOException $e) {
    exit('ただいま障害により大変ご迷惑をおかけしております。');
}

// ここでmodelを生成する
$model = new TaskModel($pdo);
// コントローラーのインスタンスを作成して、一覧表示（index）を指示する
$controller = new ListController($model);
$controller->index();

$pdo = null; // DB接続を閉じる

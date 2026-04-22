<?php

// index.php (大元の入り口)

// エラー表示設定
ini_set('display_errors', 1);
error_reporting(E_ALL);

// コントローラーを読み込む
require_once __DIR__ . '/controllers/Taskcontroller.php';
require_once __DIR__ . '/models/db.php';

// 1. DB接続（※後で共通化したい） //フロントコントローラーで接続
try {
    $pdo = require __DIR__ . '/models/config/database.php';
} catch (PDOException $e) {
    exit('ただいま障害により大変ご迷惑をおかけしております。');
}

// 2. ここでmodelを生成する
$model = new TaskModel($pdo);
// 進行役を呼び出して、一覧表示（index）を指示する
$controller = new TaskController($model);
// echo 'デバッグ：index.phpは読み込まれています。';
// exit; // ここで止まるか確認
$controller->index();

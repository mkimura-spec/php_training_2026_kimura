<?php

// index.php (大元の入り口)

// エラー表示設定
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// コントローラーを読み込む
require_once __DIR__ . '/controllers/TaskController.php';
// echo 'デバッグ：index.phpは読み込まれています。';
// exit; // ここで止まるか確認

// 進行役を呼び出して、一覧表示（index）を指示する
$controller = new TaskController();

$controller->index();

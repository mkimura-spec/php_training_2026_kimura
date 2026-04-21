<?php

// エラー表示（デバッグ用）
ini_set('display_errors', 1);
error_reporting(E_ALL);

// データベース接続とコントローラーを読み込む
require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../controllers/Taskcontroller.php';

try {
    $pdo = require __DIR__ . '/../models/config/database.php';
} catch (PDOException $e) {
    exit('ただいま障害により大変ご迷惑をおかけしております。');
}

$model = new TaskModel($pdo);
$controller = new TaskController($model);

$action = $_POST['action'] ?? '';
$id = $_POST['id'] ?? '';

switch ($action) {
    case 'add':
        $controller->showAdd();
        break;

    case 'add_store':
        $controller->storeAdd();
        break;

    case 'edit':
        $controller->showEdit($id);
        break;

    case 'edit_store':
        $controller->storeEdit($id);
        break;

    case 'delete':
        $controller->delete($id);
        break;

    default:
        exit('不正なアクションです。');
}

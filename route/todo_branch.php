<?php

/**
 * ToDo操作の振り分けを行うルーティングファイル
 * POSTされたactionの値に応じて、追加・編集・削除の各コントローラーを呼び出す.
 */

// エラー表示（デバッグ用）
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// データベース接続とコントローラーを読み込む
require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../controllers/AddController.php';
require_once __DIR__ . '/../controllers/EditController.php';
require_once __DIR__ . '/../controllers/DeleteController.php';

try {
    require_once __DIR__ . '/../config/database.php';
    $db = new Database();
    $pdo = $db->createPDO();
} catch (PDOException $e) {
    exit('ただいま障害により大変ご迷惑をおかけしております。');
}

$model = new TaskModel($pdo);

$action = $_POST['action'] ?? '';

// actionの値に応じて、対応するコントローラーの処理を実行する.
$routes = [
    'add' => [AddController::class, 'showAdd'],
    'add_store' => [AddController::class, 'storeAdd'],
    'edit' => [EditController::class, 'showEdit'],
    'edit_store' => [EditController::class, 'storeEdit'],
    'delete' => [DeleteController::class, 'delete'],
];

if (!isset($routes[$action])) {
    exit('不正なアクションです。');
}

[$controllerClass,$method] = $routes[$action];

$controller = new $controllerClass($model);
$controller->$method();

$pdo = null; // DB接続を閉じる

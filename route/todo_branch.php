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
    require_once __DIR__ . '/../models/config/database.php';
    $db = new Database();
    $pdo = $db->createPDO();
} catch (PDOException $e) {
    exit('ただいま障害により大変ご迷惑をおかけしております。');
}

$model = new TaskModel($pdo);

$action = $_POST['action'] ?? '';

// actionの値に応じて、対応するコントローラーの処理を実行する.
switch ($action) {
    case 'add':
        $controller = new AddController($model);
        $controller->showAdd();
        break;

    case 'add_store':
        $controller = new AddController($model);
        $controller->storeAdd();
        break;

    case 'edit':
        $controller = new EditController($model);
        $controller->showEdit();
        break;

    case 'edit_store':
        $controller = new EditController($model);
        $controller->storeEdit();
        break;

    case 'delete':
        $controller = new DeleteController($model);
        $controller->delete();
        break;

    default:
        exit('不正なアクションです。');
}

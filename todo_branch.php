<?php

$action = $_POST['action'] ?? '';
$id = $_POST['id'] ?? '';

// ルールを配列にまとめる
$handlers = [
    'add' => 'todo_add.php',
    'edit' => 'todo_edit.php',
    'delete' => 'todo_delete.php',
];

// 実行部（ルールが増えてもここは書き換えない）
if (array_key_exists($action, $handlers)) {
    $targetFile = $handlers[$action];
    $url = $targetFile;
    if (!empty($id)) {
        $url .= '?id=' . $id;
    }
    header('Location: ' . $url);
    exit;
}
exit('不正なアクションです。');

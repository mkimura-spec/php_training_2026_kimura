<?php

$action = $_POST['action'] ?? '';
$id = $_POST['id'] ?? '';

// 追加
class AddHandler
{
    public function handle(string $id): void
    {
        // 追加にはIDが不要なので、そのままリダイレクト
        header('Location: todo_add.php');
        exit;
    }
}

// 編集
class EditHandler
{
    public function handle(string $id): void
    {
        // 編集にはIDが必要なのでURLにくっつける
        header('Location: todo_edit.php?id=' . $id);
        exit;
    }
}

// 削除
class DeleteHandler
{
    public function handle(string $id): void
    {
        header('Location: todo_delete.php?id=' . $id);
        exit;
    }
}

// ルールを配列にまとめる
$handlers = [
    'add' => new AddHandler(),
    'edit' => new EditHandler(),
    'delete' => new DeleteHandler(),
];

// 実行部（ルールが増えてもここは書き換えない）
if (array_key_exists($action, $handlers)) {
    $handle = $handlers[$action];
    $handle->handle($id);
} else {
    exit('不正なアクションです。');
}

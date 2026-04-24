<?php
require_once __DIR__ . '/../common/common.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>ToDoアプリ一覧表示</title>
    <style>
        /* ボタンなどはいずれbootstrapを用いたい */
        .task-box {
            margin:20px;
            border: 1px solid #ccc;
            width: calc(100% - 40px);
        }
        .select_sort {
            margin-left:20px;
        }
    </style>
</head>
<body style="background-color: #f0f8ff">
    <div class="d-flex justify-content-between">
    <h1 class="m-3">ToDoリスト</h1>
    <form method="post" action="<?php echo BASE_URL; ?>/route/todo_branch.php">
        <button type="submit" name="action" value="add" class="btn btn-success m-4">+ 新しいToDoを追加</button>
    </form>
    </div>
<div class="select_sort">
    <form method="get" action="<?php echo BASE_URL; ?>/index.php">
        <select name="sort" size="1">
            <option value="created_desc" <?php echo 'created_desc' === $sort ? 'selected' : ''; ?>>作成日の新しい順</option>
            <option value="created_asc" <?php echo 'created_asc' === $sort ? 'selected' : ''; ?>>作成日の古い順</option>
            <option value="updated_desc" <?php echo 'updated_desc' === $sort ? 'selected' : ''; ?>>最終更新日の新しい順</option>
            <option value="updated_asc" <?php echo 'updated_asc' === $sort ? 'selected' : ''; ?>>最終更新日の古い順</option>
        </select>
        <button type="submit" class="btn btn-primary buttons">変更</button>
    </form>
</div>
<table class="table table-striped table-bordered task-box" style="background-color: #ffffff">
    <tr>
        <th>タイトル</th>
        <th>内容</th>
        <th>作成日</th>
        <th>最終更新日</th>
        <th>編集/削除</th>
    </tr>
    <?php foreach ($tasks as $task) { ?>
    <tr>
            <td><?php echo Sanitizer::sanitize($task->getTitle()); ?></td>
            <td><?php echo Sanitizer::nl2br_sanitize($task->getContent()); ?></td>
            <td><?php echo Sanitizer::sanitize($task->getCreatedAt()); ?> <br></td>
            <td><?php echo Sanitizer::sanitize($task->getUpdatedAt()); ?> <br></td>
            <td>
            <div class="buttons">
                <form method="post" action="<?php echo BASE_URL; ?>/route/todo_branch.php">
                <input type="hidden" name="id" value="<?php echo Sanitizer::sanitize($task->getId()); ?>">
                <button type="submit" name="action" value="edit" class="btn btn-primary">編集</button>
                <button type="submit" onclick="return confirm('本当にこのToDoリストを削除してもよろしいですか？')" 
                name="action" value="delete" class="btn btn-danger">削除</button>
                </form>
            </div>
            </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>

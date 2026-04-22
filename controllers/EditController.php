<?php

require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../common/TaskValidator.php';
require_once __DIR__ . '/../common/common.php';

/**
 * ToDoの編集機能を担当するコントローラー
 * 編集画面を表示するshowEdit()、編集内容の保存を行うstoreEdit().
 */
class EditController
{
    private $model;

    public function __construct(TaskModel $model)
    {
        $this->model = $model;
    }

    public function showEdit(): void
    {
        $id = $_POST['id'] ?? '';
        if (empty($id)) {
            exit('不正なアクセスです。IDが指定されていません。');
        }
        // IDに一致するタスクを1件だけ取得する
        $task = $this->model->findById($id);
        // もしタスクが見つからなかった場合のエラー処理
        if (!$task) {
            exit('指定されたタスクが見つかりません。すでに削除された可能性があります。');
        }

        $title = $task->getTitle() ?? '';
        $content = $task->getContent() ?? '';

        require_once __DIR__ . '/../todo_views/edit_view.php';
    }

    public function storeEdit(): void
    {
        $id = $_POST['id'] ?? '';
        if (empty($id)) {
            exit('不正なアクセスです。IDが指定されていません。');
        }

        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        $errors = TaskValidator::validate($title, $content);

        if (!empty($errors)) {
            require_once __DIR__ . '/../todo_views/edit_view.php';

            return;
        }

        try {
            $this->model->update($id, $title, $content);
        } catch (Exception $e) {
            exit('ただいま障害により大変ご迷惑をおかけしております。');
        }
        header('Location: ' . BASE_URL . '/index.php');

        exit;
    }
}

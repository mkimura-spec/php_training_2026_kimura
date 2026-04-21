<?php

// controllers/Taskcontroller.php
require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../common/common.php';
require_once __DIR__ . '/../common/TaskValidator.php';
require_once __DIR__ . '/../strategies/sorts/Created_Desc.php';
require_once __DIR__ . '/../strategies/sorts/Created_Asc.php';
require_once __DIR__ . '/../strategies/sorts/Updated_Desc.php';
require_once __DIR__ . '/../strategies/sorts/Updated_Asc.php';

// 一覧画面の表示をするクラス
class TaskController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $sort = $_GET['sort'] ?? 'created_desc';

        switch ($sort) {
            case 'created_asc':
                $strategy = new Created_Asc();
                break;

            case 'updated_desc':
                $strategy = new Updated_Desc();
                break;

            case 'created_desc':
            default:
                $strategy = new Created_Desc();
                break;
        }
        // 一覧を取得する
        $tasks = $this->model->getAll($strategy);

        // View（画面）を読み込んで表示する
        // ここで読み込んだViewファイルの中では、上で定義した $tasks がそのまま使える
        require_once __DIR__ . '/../todo_views/todo_list.php';
    }

    public function showAdd()
    {
        $title = '';

        $content = '';

        $errors = [];

        require_once __DIR__ . '/../todo_views/add_view.php';
    }

    public function storeAdd()
    {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        $errors = TaskValidator::validate($title, $content);

        if (!empty($errors)) {
            // echo $errors;
            require_once __DIR__ . '/../todo_views/add_view.php';

            return;
        }

        try {
            $this->model->add($title, $content);
        } catch (Exception $e) {
            exit('ただいま障害により大変ご迷惑をおかけしております。');
        }

        header('Location: ' . BASE_URL . '/index.php');

        exit;
    }

    public function showEdit()
    {
        $id = $_POST['id'] ?? '';
        if (empty($id)) {
            exit('不正なアクセスです。IDが指定されていません。');
        }
        // IDに一致するタスクを1件だけ取得する
        $task = $this->model->findById($id);
        $title = $task->getTitle() ?? '';
        $content = $task->getContent() ?? '';

        // もしタスクが見つからなかった場合のエラー処理
        if (!$task) {
            exit('指定されたタスクが見つかりません。すでに削除された可能性があります。');
        }

        require_once __DIR__ . '/../todo_views/edit_view.php';
    }

    public function storeEdit()
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

    public function delete()
    {
        $id = $_POST['id'] ?? '';
        if (empty($id)) {
            exit('不正なアクセスです。IDが指定されていません。');
        }

        $task = $this->model->findById($id);

        if (!$task) {
            exit('指定されたタスクが見つかりません。すでに削除された可能性があります。');
        }

        try {
            $this->model->delete($id);
        } catch (Exception $e) {
            exit('ただいま障害により大変ご迷惑をおかけしております。');
        }

        header('Location: ' . BASE_URL . '/index.php');

        exit;
    }
}

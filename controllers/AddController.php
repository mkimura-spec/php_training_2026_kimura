<?php

require_once __DIR__ . '/../common/TaskValidator.php';
require_once __DIR__ . '/../common/common.php';
require_once __DIR__ . '/../models/Interfacedb.php';

/**
 * ToDoの追加機能を担当するコントローラー
 * 追加画面を表示するshowAdd()、追加処理を行うstoreAdd().
 */
class AddController
{
    private $model;

    public function __construct(Interfacedb $model)
    {
        $this->model = $model;
    }

    public function showAdd(): void
    {
        $title = '';
        $content = '';
        $errors = [];

        require_once __DIR__ . '/../todo_views/add_view.php';
    }

    public function storeAdd(): void
    {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        $errors = TaskValidator::validate($title, $content);

        if (!empty($errors)) {
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
}

<?php

require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../common/common.php';
require_once __DIR__ . '/../models/Interfacedb.php';

/**
 * ToDoの削除機能を担当するコントローラー
 * 削除を実行し,一覧画面に遷移するdelete().
 */
class DeleteController
{
    private $model;

    public function __construct(Interfacedb $model)
    {
        $this->model = $model;
    }

    public function delete(): void
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

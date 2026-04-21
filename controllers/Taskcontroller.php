<?php

// controllers/TaskController.php

require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../common/common.php';

// 一覧画面の表示をするクラス
class TaskController
{
    public function index()
    {
        // 1. DB接続（※後で共通化したい）
        try {
            $pdo = require __DIR__ . '/../config/database.php';
        } catch (PDOException $e) {
            exit('ただいま障害により大変ご迷惑をおかけしております。');
        }

        // 2. Modelを使ってデータを取得
        $model = new TaskModel($pdo);
        $tasks = $model->getAll();

        // 3. View（画面）を読み込んで表示する
        // ここで読み込んだViewファイルの中では、上で定義した $tasks がそのまま使えます！
        require_once __DIR__ . '/../todo_views/index.php';
    }
}

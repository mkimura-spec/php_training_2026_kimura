<?php

require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../strategies/sorts/SortFactory.php';
require_once __DIR__ . '/../models/Interfacedb.php';

/**
 * ToDoの一覧を表示するためのコントローラー
 * 表示方法をGETパラメータで取得し,getSortclassで固定値を受け取る.
 */
class ListController
{
    private $model;

    public function __construct(Interfacedb $model)
    {
        $this->model = $model;
    }

    public function index(): void
    {
        $sort = $_GET['sort'] ?? 'created_desc';

        $strategy = SortFactory::create($sort);
        // 一覧を取得する
        $tasks = $this->model->getAll($strategy);

        // View（画面）を読み込んで表示する
        // ここで読み込んだViewファイルの中では、上で定義した $tasks がそのまま使える
        require_once __DIR__ . '/../todo_views/todo_list.php';
    }
}

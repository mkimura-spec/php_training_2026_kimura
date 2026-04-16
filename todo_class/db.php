<?php

// TaskModel.php
require_once 'task.php'; // Taskクラスを使うので読み込む

class TaskModel
{
    private $dbh;

    // クラスが呼ばれた時に、データベースに接続する
    public function __construct()
    {
        $dsn = 'mysql:dbname=php_advance;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';

        $this->dbh = new PDO($dsn, $user, $password);
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // 一覧を取得する機能（メソッド）
    public function getAll()
    {
        // 作成日時の降順（新しい順）で取得するようにORDER BYを追加
        $sql = 'SELECT id, title, content, created_at, updated_at FROM table_todolist ORDER BY created_at DESC';
        $stmt = $this->dbh->query($sql);

        $tasks = [];
        // 取ってきたデータを1行ずつTaskクラスの箱に詰め替える
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tasks[] = new Task(
                $row['id'],
                $row['title'],
                $row['content'],
                $row['created_at'],
                $row['updated_at']
            );
        }

        return $tasks; // Taskクラスが入った配列を返す
    }

    public function add($title, $content)
    {
        // SQL文を作る
        $sql = 'INSERT INTO table_todolist(title, content, created_at, updated_at) VALUES (?, ?, NOW(), NOW())';
        // 準備
        $stmt = $this->dbh->prepare($sql);
        // データを配列にまとめる
        $data = [$title, $content];
        // 実行（エグゼキュート）
        $stmt->execute($data);
    }
}

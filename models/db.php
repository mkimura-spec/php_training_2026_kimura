<?php

require_once 'Task.php'; // Taskクラスを使うので読み込む

class TaskModel
{
    private $dbh;

    // クラスが呼ばれた時に、データベースに接続する
    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
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

    public function findById($id)
    {
        $sql = 'SELECT id, title, content, created_at, updated_at FROM table_todolist WHERE id=?';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Task(
            $row['id'],
            $row['title'],
            $row['content'],
            $row['created_at'],
            $row['updated_at']
        );
    }

    public function add($title, $content)
    {
        // SQL文を作る
        $sql = 'INSERT INTO table_todolist(title, content, created_at, updated_at) VALUES (?, ?, NOW(), NOW())';
        // 準備
        $stmt = $this->dbh->prepare($sql);
        // データを配列にまとめる
        $data = [$title, $content];
        // 実行
        $stmt->execute($data);
    }

    public function delete($id)
    {
        // SQL文を作る
        $sql = 'DELETE FROM table_todolist WHERE id=?';
        // 準備
        $stmt = $this->dbh->prepare($sql);
        // データを配列にまとめる
        $data = [$id];
        // 実行
        $stmt->execute($data);
    }

    public function update($id, $title, $content)
    {
        // SQL文を作る
        $sql = 'UPDATE table_todolist SET title=? , content=? , updated_at=NOW() WHERE id=?';
        // 準備
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        // データを配列にまとめる
        $data[] = $title;
        $data[] = $content;
        $data[] = $id;
        // 実行
        $stmt->execute($data);
    }
}

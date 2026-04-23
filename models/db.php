<?php

/**
 * データベースに関する操作(追加/編集/削除/一覧表示/検索)をまとめたクラス
 * このクラスを用いてSQL文を作成し実行する.
 */

require_once __DIR__ . '/Task.php'; // Taskクラスを使うので読み込む

class TaskModel
{
    private $dbh;

    // クラスが呼ばれた時に、データベースに接続する
    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    /**
     * 指定された並び替え戦略を用いてToDo一覧を取得する.
     * StrategyInterfaceの実装クラスを受け取り、その並び順でToDoデータを取得する。
     *
     * @return Task[] ToDoオブジェクトの配列
     */
    public function getAll(StrategyInterface $strategy)
    {
        // コントローラ側で受け取ったstrategyクラスの中のメソッドを使ってSQL文を作る
        // メソッド名はインターフェースで統一している
        $orderBy = $strategy->getOrderByClause();
        // ここの$orderByは各Strategyクラスの戻り値で固定値しか入らないので安全
        $sql = "SELECT id, title, content, created_at, updated_at FROM table_todolist ORDER BY {$orderBy}";
        $stmt = $this->dbh->query($sql);

        $tasks = [];
        // 取ってきたデータを1行ずつTaskクラスに詰め替える
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

    /**
     * 指定されたIDのToDoを1件取得するメソッド
     * 該当するデータが存在しない場合は null を返す。
     *
     * @param int|string $id 取得対象のToDo ID
     *
     * @return Task|null
     */
    public function findById($id)
    {
        $sql = 'SELECT id, title, content, created_at, updated_at FROM table_todolist WHERE id=?';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Task(
            $row['id'],
            $row['title'],
            $row['content'],
            $row['created_at'],
            $row['updated_at']
        );
    }

    /**
     * 入力された情報をもとにToDoをInsertする.
     *
     * @param string $title   //入力されたタイトル
     * @param string $content //入力された内容
     */
    public function add($title, $content): void
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

    /**
     * 指定したIDのToDoをDeleteする.
     *
     * @param string $id //削除するToDoのID
     */
    public function delete($id): void
    {
        $sql = 'DELETE FROM table_todolist WHERE id=?';
        $stmt = $this->dbh->prepare($sql);
        $data = [$id];

        $stmt->execute($data);
    }

    /**
     * 入力された情報をもとにToDoをUpdateする.
     *
     * @param string $title   //入力されたタイトル
     * @param string $content //入力された内容
     */
    public function update($id, $title, $content): void
    {
        $sql = 'UPDATE table_todolist SET title=? , content=? , updated_at=NOW() WHERE id=?';
        $stmt = $this->dbh->prepare($sql);
        $data = [];
        $data[] = $title;
        $data[] = $content;
        $data[] = $id;

        $stmt->execute($data);
    }
}

<?php

/**
 * ToDoリストの1件分のデータを表すクラス.
 */
class Task
{
    // プロパティ
    private int $id;
    private string $title;
    private string $content;
    private string $created_at;
    private string $updated_at;
    // マジックナンバーを定数化
    public const MAX_TITLE_LENGTH = 50;
    public const MAX_CONTENT_LENGTH = 200;

    public function __construct($id, $title, $content, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    // ゲッター
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}

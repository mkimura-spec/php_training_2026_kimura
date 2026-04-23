<?php

/**
 * データベース接続を生成するクラス.
 * DSN、ユーザー名、パスワードなどの接続情報を保持し、PDOインスタンスを作成して返す。
 */
class Database
{
    private string $dsn = 'mysql:dbname=php_advance;host=localhost;charset=utf8';
    private string $user = 'root';
    private string $password = '';

    // エラーモードを例外に設定
    // エラーが出た場合エラーメッセージを配列にして格納させる
    public function createPDO(): PDO
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        // 作られたPDOオブジェクトを返す
        return new PDO($this->dsn, $this->user, $this->password, $options);
    }
}

<?php

/**
 * バリデーションを行うクラスを定義
 * タイトルと内容が入力されているか、文字数の制限を行う.
 */

// Taskクラスの定義を読み込む
require_once __DIR__ . '/../models/Task.php';

class TaskValidator
{
    // タイトルと内容の入力チェックを行う

    public static function validate($title, $content)
    {
        $error = [];

        if ('' == $title) {
            $error[] = 'タイトルが入力されていません。';
        } elseif (mb_strlen($title) > Task::MAX_TITLE_LENGTH) {
            $error[] = 'タイトルは' . Task::MAX_TITLE_LENGTH . '文字以内で入力してください。';
        }

        if ('' == $content) {
            $error[] = '内容が入力されていません。';
        } elseif (mb_strlen($content) > Task::MAX_CONTENT_LENGTH) {
            $error[] = '内容は' . Task::MAX_CONTENT_LENGTH . '文字以内で入力してください。';
        }

        return $error;
    }
}

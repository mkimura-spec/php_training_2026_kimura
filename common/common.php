<?php

// クラス名などは今後変更する
class Sanitizer
{
    // XSS対策のためにHTMLエスケープを施す関数
    public static function sanitize($str)
    {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }

    // エスケープに加えて改行をbrタグに置き換える関数、contentを表示するときに使用
    public static function nl2br_sanitize($str)
    {
        return nl2br(self::sanitize($str));
    }
}

<?php

require_once __DIR__ . '/Created_Desc.php';
require_once __DIR__ . '/Created_Asc.php';
require_once __DIR__ . '/Updated_Desc.php';
require_once __DIR__ . '/Updated_Asc.php';

/**
 * 指定された並び替え条件に対応するソートクラスのインスタンスを返す.
 */
class SortFactory
{
    // ここでクラス名を定義し、対応したクラス名を文字列として代入する
    private const SORTS = [
        'created_desc' => Created_Desc::class,
        'created_asc' => Created_Asc::class,
        'updated_desc' => Updated_Desc::class,
        'updated_asc' => Updated_Asc::class,
    ];

    public static function create(string $sort): StrategyInterface
    {
        $sortName = self::SORTS[$sort] ?? Created_Desc::class;

        // 取得したクラス名をもとにインスタンスを生成して返す
        return new $sortName();
    }
}

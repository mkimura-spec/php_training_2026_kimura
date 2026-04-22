<?php

require_once __DIR__ . '/Created_Desc.php';
require_once __DIR__ . '/Created_Asc.php';
require_once __DIR__ . '/Updated_Desc.php';
require_once __DIR__ . '/Updated_Asc.php';

/**
 * 指定された並び替え条件に対応するソートクラスを返す.
 */
class Sort_branch
{
    public static function getSortclass($sort)
    {
        switch ($sort) {
            case 'created_asc':
                return new Created_Asc();

            case 'updated_desc':
                return new Updated_Desc();

            case 'updated_asc':
                return new Updated_Asc();

            case 'created_desc':
            default:
                return new Created_Desc();
        }
    }
}

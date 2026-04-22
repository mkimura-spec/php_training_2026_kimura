<?php

require_once __DIR__ . '/StrategyInterface.php';

/**
 * 作成日時の新しい順で並び替える.
 */
class Created_Desc implements StrategyInterface
{
    public function getOrderByClause(): string
    {
        return 'created_at DESC';
    }
}

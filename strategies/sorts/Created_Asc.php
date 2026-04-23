<?php

require_once __DIR__ . '/StrategyInterface.php';

/**
 * 作成日時の古い順で並び替える.
 */
class Created_Asc implements StrategyInterface
{
    public function getOrderByClause(): string
    {
        return 'created_at ASC';
    }
}

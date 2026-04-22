<?php

require_once __DIR__ . '/StrategyInterface.php';

/**
 * 更新日時の古い順で並び替える.
 */
class Updated_Asc implements StrategyInterface
{
    public function getOrderByClause(): string
    {
        return 'updated_at ASC';
    }
}

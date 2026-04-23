<?php

require_once __DIR__ . '/StrategyInterface.php';

/**
 * 更新日時の新しい順で並び替える.
 */
class Updated_Desc implements StrategyInterface
{
    public function getOrderByClause(): string
    {
        return 'updated_at DESC';
    }
}

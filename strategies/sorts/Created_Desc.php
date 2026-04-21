<?php

require_once __DIR__ . '/StrategyInterface.php';

class Created_Desc implements StrategyInterface
{
    public function getOrderByClause(): string
    {
        return 'created_at DESC';
    }
}

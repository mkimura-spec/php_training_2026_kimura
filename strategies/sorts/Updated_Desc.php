<?php

require_once __DIR__ . '/StrategyInterface.php';

class Updated_Desc implements StrategyInterface
{
    public function getOrderByClause(): string
    {
        return 'updated_at DESC';
    }
}

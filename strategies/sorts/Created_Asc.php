<?php

require_once __DIR__ . '/StrategyInterface.php';

class Created_Asc implements StrategyInterface
{
    public function getOrderByClause(): string
    {
        return 'created_at ASC';
    }
}

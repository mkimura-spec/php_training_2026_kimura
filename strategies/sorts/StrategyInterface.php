<?php

/**
 * 並び替え用SQL句を返すソート戦略の共通インターフェース.
 */
interface StrategyInterface
{
    public function getOrderByClause(): string;
}

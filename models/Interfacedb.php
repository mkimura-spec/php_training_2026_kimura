<?php

interface Interfacedb
{
    public function getAll(StrategyInterface $strategy): array;

    public function findById($id): ?Task;

    public function add($title, $content): void;

    public function delete($id): void;

    public function update($id, $title, $content): void;
}

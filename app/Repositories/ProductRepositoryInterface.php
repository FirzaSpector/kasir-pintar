<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function getByCategory(int $categoryId);
    public function search(string $keyword);
    public function updateStock(int $id, int $qty);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}

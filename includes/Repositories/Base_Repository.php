<?php
namespace Ohio_Tokyo_International_Sea_Monster_Society\Repositories;

use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Collection;

interface Base_Repository
{
	public function create(array $data): ?Entity;
	public function find(int $id): ?Entity;
	public function findAll(?string $orderBy): Collection;
}

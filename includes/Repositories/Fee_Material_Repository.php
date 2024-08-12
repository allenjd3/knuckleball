<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Repositories;

use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Collection;
use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Fee_Material;
use Ohio_Tokyo_International_Sea_Monster_Society\Traits\DbPrefix;

class Fee_Material_Repository implements Base_Repository
{
	use DbPrefix;
	private $wpdb;
	private $tableName = 'fee_materials';

	public function __construct(
		private int $userId,
	) {
		global $wpdb;
		$this->wpdb = $wpdb;
	}


	public function create(array $data): bool
	{
		if ($this->userId) {
			return (bool) $this->wpdb->insert($this->getTableName(), array_merge($data, ['user_id' => $this->userId]));
		}

		return false;
	}

	public function find(int $id): ?Entity
	{
		$preparedStatement = $this->wpdb->prepare('select * from '. $this->getTableName() . ' where id = %d', $id);
		$result = $this->wpdb->get_row($preparedStatement);

		if ($result) {
			return Fee_Material::make($result);
		}

		return null;
	}

	public function findAll(?string $orderBy = null): Collection
	{
		$results = $this->wpdb->get_results('select * from ' . $this->getTableName());

		$fee_materials = Collection::make();
		foreach($results as $result) {
			$fee_materials->push(Fee_Material::make($result));
		}

		return $fee_materials;
	}
}

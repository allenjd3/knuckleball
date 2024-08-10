<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Repositories;

use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Collection;
use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Fee_Material;

class Fee_Material_Repository implements Base_Repository
{
	private $wpdb;

	public function __construct()
	{
		global $wpdb;
		$this->wpdb = $wpdb;
	}


	public function create(array $data): bool
	{
		return (bool) $this->wpdb->insert('wp_knuckleball_fee_materials', $data);
	}

	public function find(int $id): ?Entity
	{
		$preparedStatement = $this->wpdb->prepare('select * from wp_knuckball_fee_materials where id = %d', $id);
		$result = $this->wpdb->get_row($preparedStatement);

		if ($result) {
			return Fee_Material::make($result);
		}

		return null;
	}

	public function findAll(?string $orderBy): Collection
	{
		$preparedStatement = $this->wpdb->prepare('select * from wp_knuckball_fee_materials');
		$results = $this->wpdb->get_results($preparedStatement);

		$fee_materials = Collection::make();
		foreach($results as $result) {
			$fee_materials->push(Fee_Material::make($result));
		}

		return $fee_materials;
	}
}

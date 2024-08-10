<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Repositories;

use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Collection;
use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Fee;

class Fee_Repository implements Base_Repository
{
	private $wpdb;

	public function __construct()
	{
		global $wpdb;
		$this->wpdb = $wpdb;
	}


	public function create (array $data): bool
	{
		return (bool) $this->wpdb->insert('wp_knuckleball_fees', $data);
	}

	public function find (int $id): ?Entity
	{
		$preparedStatement = $this->wpdb->prepare('select * from wp_knuckball_fees where id = %d', $id);
		$result = $this->wpdb->get_row($preparedStatement);

		if ($result) {
			return Fee::make($result);
		}

		return null;
	}

	public function findAll(?string $orderBy): Collection
	{
		$preparedStatement = $this->wpdb->prepare('select * from wp_knuckball_fees');
		$results = $this->wpdb->get_results($preparedStatement);

		$fees = Collection::make();
		foreach($results as $result) {
			$fees->push(Fee::make($result));
		}

		return $fees;
	}
}

<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Repositories;

use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Collection;
use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Player;
use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Team;
use Ohio_Tokyo_International_Sea_Monster_Society\Traits\DbPrefix;

class Team_Repository implements Base_Repository
{
	use DbPrefix;
	private $wpdb;
	private $tableName = 'teams';

	public function __construct(
		private ?int $userId = 0,
	) {
		global $wpdb;
		$this->wpdb = $wpdb;
	}


	public function create(array $data): ?Entity
	{

		if ($this->wpdb->insert($this->getTableName(), $this->sanitizeInput($data))) {
			return Team::make($data);
		}

		return null;
	}

	public function find(int $id): ?Entity
	{
		$preparedStatement = $this->wpdb->prepare('select * from '. $this->getTableName() . ' where id = %d', $id);
		$result = $this->wpdb->get_row($preparedStatement);

		if ($result) {
			return Team::make($result);
		}

		return null;
	}

	public function findAll(?string $orderBy = null): Collection
	{
		$results = $this->wpdb->get_results('select * from ' . $this->getTableName(), ARRAY_A);

		$teams = Collection::make();
		foreach($results as $result) {
			$teams->push(Team::make($result));
		}

		return $teams;
	}

	public function sanitizeInput($data): array
	{
		if ($this->userId) {
			$data = array_merge($data, ['user_id' => $this->userId]);
		}

		return $data;
	}
}

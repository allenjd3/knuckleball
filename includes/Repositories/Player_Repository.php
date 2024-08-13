<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Repositories;

use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Card;
use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Collection;
use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Player;
use Ohio_Tokyo_International_Sea_Monster_Society\Traits\DbPrefix;

class Player_Repository implements Base_Repository
{
	use DbPrefix;
	private $wpdb;
	private $tableName = 'players';

	public function __construct(
		private int $userId,
	) {
		global $wpdb;
		$this->wpdb = $wpdb;
	}


	public function create (array $data): bool
	{
		if ($this->userId) {
			print_r(array_merge($data, ['user_id' => $this->userId]));
			return (bool) $this->wpdb->insert($this->getTableName(), array_merge($data, ['user_id' => $this->userId]));
		}

		return false;
	}

	public function find (int $id): ?Entity
	{
		$preparedStatement = $this->wpdb->prepare('select * from ' . $this->getTableName() . ' where id = %d', $id);
		$result = $this->wpdb->get_row($preparedStatement);

		if ($result) {
			return Player::make($result);
		}

		return null;
	}

	public function findAll(?string $orderBy = null): Collection
	{
		$results = $this->wpdb->get_results('select * from ' . $this->getTableName());

		$players = Collection::make();
		foreach($results as $result) {
			$players->push(Player::make($result));
		}

		return $players;
	}
}

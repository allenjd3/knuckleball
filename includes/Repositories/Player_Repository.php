<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Repositories;

use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Card;
use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Collection;
use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Player;
use Ohio_Tokyo_International_Sea_Monster_Society\Traits\DbPrefix;
use Ohio_Tokyo_International_Sea_Monster_Society\Traits\Slugify;

class Player_Repository implements Base_Repository
{
	use DbPrefix;

	private $wpdb;
	private $tableName = 'players';

	public function __construct(
		private ?int $userId = 0,
	) {
		global $wpdb;
		$this->wpdb = $wpdb;
	}

	public function create(array $data): ?Entity
	{
		if ($this->wpdb->insert($this->getTableName(), $data)) {
			return Player::make($data);
		}

		return null;
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

	public function baseQuery(): string
	{
		return 'select * from ' . $this->getTableName();
	}

	public function findAll(?string $orderBy = null): Collection
	{
		$results = $this->wpdb->get_results('select * from ' . $this->getTableName(), ARRAY_A);

		$players = Collection::make();
		foreach($results as $result) {
			$players->push(Player::make($result));
		}

		return $players;
	}

	public function search(?string $search = null): Collection
	{
		if (! $search) {
			return $this->findAll();
		}

		$results = $this->wpdb->get_results(
			$this->wpdb->prepare("select * from {$this->getTableName()} where name like %s", '%'. $this->wpdb->esc_like($search) . '%'),
			ARRAY_A
		);

		$players = Collection::make();
		foreach($results as $result) {
			$players->push(Player::make($result));
		}

		return $players;
	}

	public function findBySlug(string $slug): ?Entity
	{
		$query = $this->wpdb->prepare($this->baseQuery() . ' where slug = %s', $slug);
		$result = $this->wpdb->get_row($query);

		if ($result) {
			return Player::make($result);
		}

		return null;
	}
}

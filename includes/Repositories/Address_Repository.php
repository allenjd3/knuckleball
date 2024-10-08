<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Repositories;

use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Address;
use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Collection;
use Ohio_Tokyo_International_Sea_Monster_Society\Traits\DbPrefix;

class Address_Repository implements Base_Repository, AddressContract
{
	use DbPrefix;
	private $wpdb;
	private $tableName = 'addresses';

	public function __construct() {
		global $wpdb;
		$this->wpdb = $wpdb;
	}

	public function create(array $data): ?Entity
	{
		if ($this->wpdb->insert($this->getTableName(), $data)) {
			return Address::make($data);
		}

		return null;
	}

	public function find(int $id): ?Entity
	{
		$preparedStatement = $this->wpdb->prepare("select * from " . $this->getTableName() .  " where id = %d", $id);
		$result = $this->wpdb->get_row($preparedStatement);

		if ($result) {
			return Address::make($result);
		}

		return null;
	}

	public function findAll(?string $orderBy = null): Collection
	{
		$results = $this->wpdb->get_results('select * from ' . $this->getTableName());

		$addresses = Collection::make();
		foreach ($results as $result) {
			$addresses->push(Address::make($result));
		}

		return $addresses;
	}

	public function getPlayerAddress(int $id): ?Entity
	{
		$preparedStatement = $this->wpdb
			->prepare(
				'select * from ' . $this->getTableName() . ' where addressable_type = %s and addressable_id = %d',
				'player',
				$id
			);

		$result = $this->wpdb->get_row($preparedStatement);

		if ($result) {
			return Address::make($result);
		}

		return null;
	}
}

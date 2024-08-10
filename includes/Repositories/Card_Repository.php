<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Repositories;

use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Card;
use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Collection;

class Card_Repository implements Base_Repository
{
	private $wpdb;

	public function __construct()
	{
		global $wpdb;
		$this->wpdb = $wpdb;
	}


	public function create (array $data): bool
	{
		return (bool) $this->wpdb->insert('wp_knuckleball_cards', $data);
	}

	public function find (int $id): ?Entity
	{
		$preparedStatement = $this->wpdb->prepare('select * from wp_knuckball_cards where id = %d', $id);
		$result = $this->wpdb->get_row($preparedStatement);

		if ($result) {
			return Card::make($result);
		}

		return null;
	}

	public function findAll(?string $orderBy): Collection
	{
		$preparedStatement = $this->wpdb->prepare('select * from wp_knuckball_cards');
		$results = $this->wpdb->get_results($preparedStatement);

		$cards = Collection::make();
		foreach($results as $result) {
			$cards->push(Card::make($result));
		}

		return $cards;
	}
}

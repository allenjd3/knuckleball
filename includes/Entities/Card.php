<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Entities;

use Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Entity;

class Card implements Entity
{
	public function __construct(
	    private int $id,
		private ?int $team_id,
		public string $name,
		private int $user_id,
		public ?string $published_at,
	) {
	}

	public static function make(object $rawData): self
	{
		return new self(
			id: $rawData->id,
			team_id: $rawData->team_id,
			name: $rawData->name,
			user_id: $rawData->user_id,
			published_at: $rawData->published_at,
		);
	}
}

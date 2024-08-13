<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Entities;

use Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Entity;

class Fee implements Entity
{
	public function __construct(
	    private int $id,
		public int $amount,
		private int $user_id,
		public ?string $published_at,
	) {
	}

	public static function make(object $rawData): self
	{
		return new self(
			id: $rawData->id,
			amount: $rawData->team_id,
			user_id: $rawData->user_id,
			published_at: $rawData->published_at,
		);
	}
}

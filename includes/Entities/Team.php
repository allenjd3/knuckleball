<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Entities;

use Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Entity;

class Team implements Entity
{
	public function __construct(
	    public int $id,
		public string $name,
		private ?int $user_id,
		public ?string $published_at,
	) {
	}

	public static function make(mixed $rawData): self
	{
		if (is_array($rawData)) {
			$rawData = (object) $rawData;
		}

		return new self(
			id: $rawData->id,
			name: $rawData->name,
			user_id: $rawData->user_id,
			published_at: $rawData->published_at,
		);
	}
}

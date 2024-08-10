<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Entities;

use Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Entity;

class Team implements Entity
{
	public function __construct(
	    private int $id,
		public string $name,
		public ?string $published_at,
	) {
	}

	public static function make(object $rawAddress): self
	{
		return new self(
			id: $rawAddress->id,
			name: $rawAddress->name,
			published_at: $rawAddress->published_at,
		);
	}
}

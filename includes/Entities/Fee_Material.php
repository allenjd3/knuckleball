<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Entities;

use Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Entity;

class Fee_Material implements Entity
{
	public function __construct(
	    private int $id,
		private int $fee_id,
		public string $name,
		public ?string $published_at,
	) {
	}

	public static function make(object $rawData): self
	{
		return new self(
			id: $rawData->id,
			fee_id: $rawData->fee_id,
			name: $rawData->name,
			published_at: $rawData->published_at,
		);
	}
}

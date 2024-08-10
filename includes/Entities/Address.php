<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Entities;

use Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Entity;

class Address implements Entity
{
	public function __construct(
	    private int $id,
		private string $addressable_type,
		private int $addressable_id,
		public string $address_1,
		public ?string $address_2,
		public string $city,
		public string $state,
		public string $postal_code,
		public ?string $published_at,
	) {
	}

	public static function make(object $rawData): self
	{
		return new self(
			id: $rawData->id,
			addressable_type: $rawData->addressable_type,
			addressable_id: $rawData->addressable_id,
			address_1: $rawData->address_1,
			address_2: $rawData->address_2,
			city: $rawData->city,
			state: $rawData->state,
			postal_code: $rawData->postal_code,
			published_at: $rawData->published_at,
		);
	}
}

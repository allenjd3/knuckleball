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

	public static function make(object $rawAddress): self
	{
		return new self(
			id: $rawAddress->id,
			addressable_type: $rawAddress->addressable_type,
			addressable_id: $rawAddress->addressable_id,
			address_1: $rawAddress->address_1,
			address_2: $rawAddress->address_2,
			city: $rawAddress->city,
			state: $rawAddress->state,
			postal_code: $rawAddress->postal_code,
			published_at: $rawAddress->published_at,
		);
	}
}

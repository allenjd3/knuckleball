<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Entities;

class Address extends Base_Entity
{
	public function __construct(
	    private ?int $id,
		private ?string $addressable_type,
		private ?int $addressable_id,
		public ?string $address_1,
		public ?string $address_2,
		public ?string $city,
		public ?string $state,
		public ?string $postal_code,
		public ?string $published_at,
	) {
	}

	public static function make(mixed $rawData): self
	{
		if (is_array($rawData)) {
			$rawData = (object) $rawData;
		}

		return new self(
			id: $rawData->id ?? null,
			addressable_type: $rawData->addressable_type ?? null,
			addressable_id: $rawData->addressable_id ?? null,
			address_1: $rawData->address_1 ?? null,
			address_2: $rawData->address_2 ?? null,
			city: $rawData->city ?? null,
			state: $rawData->state ?? null,
			postal_code: $rawData->postal_code ?? null,
			published_at: $rawData->published_at ?? null,
		);
	}

	public function toArray (): array
	{
		return [
			'id' => $this->id,
			'addressable_type' => $this->addressable_type,
			'addressable_id' => $this->addressable_id,
			'address_1' => $this->address_1,
			'address_2' => $this->address_2,
			'city' => $this->city,
			'state' => $this->state,
			'postal_code' => $this->postal_code,
			'published_at' => $this->published_at,
		];
	}
}

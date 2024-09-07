<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Entities;

use Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Entity;

class Player implements Entity
{
	public function __construct(
	    private int $id,
		private ?int $user_id,
		private ?int $team_id,
		public string $name,
		public string $slug,
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
			user_id: $rawData->user_id,
			team_id: $rawData->team_id,
			name: $rawData->name,
			slug: $rawData->slug,
			published_at: $rawData->published_at,
		);
	}

	public function getAvatarUrl()
	{
		return get_avatar_url($this->user_id);
	}

	public function getPath(): string
	{
		return get_site_url() . '/players/' . $this->slug;
	}
}

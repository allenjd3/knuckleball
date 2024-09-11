<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Entities;

use Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Entity;
use Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Player_Repository;
use Ohio_Tokyo_International_Sea_Monster_Society\Traits\Slugify;

class Player implements Entity
{
	use Slugify;

	public array $errors = [];

	public function __construct(
	    private ?int $id,
		private ?int $user_id,
		private ?int $team_id,
		public ?string $name,
		public ?string $slug,
		public ?string $published_at,
	) {
		if ($name && strlen($name) > 0 && ! $slug) {
			$slug = $this->slugify($name);
		}
	}

	public static function make(mixed $rawData): self
	{
		if (is_array($rawData)) {
			$rawData = (object) $rawData;
		}

		return new self(
			id: $rawData->id ?? null,
			user_id: $rawData->user_id ?? null,
			team_id: $rawData->team_id ?? null,
			name: $rawData->name ?? null,
			slug: $rawData->slug ?? null,
			published_at: $rawData->published_at ?? null,
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

	private function validate(): bool
	{
		if (strlen($this->name) <= 0 || strlen($this->name) > 255 ) {
			$this->errors['name'] = 'Name must be between 0 and 255 chars';
			return false;
		}

		return true;
	}

	private function toArray(): array
	{
		return [
			'id' => $this->id,
			'user_id' => $this->user_id,
			'team_id' => $this->team_id,
			'name' => $this->name,
			'slug' => $this->slug,
			'published_at' => $this->published_at,
		];
	}

	public function getSlugifyAttribute(): string
	{
		return $this->name;
	}

	public function create(Player_Repository $repository): ?Entity
	{
		if ($this->validate()) {
			return $repository->create($this->toArray());
		}

		return $this;
	}

	public function hasError($key): bool
	{
		return array_key_exists($key, $this->errors);
	}
}

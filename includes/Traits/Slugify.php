<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Traits;

trait Slugify
{
	abstract public function getSlugifyAttribute(): string;

	public function slugify(): self
	{
		if ($this->slug) {
			return $this;
		}

		$slug = strtolower(trim($this->getSlugifyAttribute()));
		$slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
		$slug = preg_replace('/-+/', '-', $slug);
		$slug = trim($slug, '-');

		$this->slug = $slug;
		return $this;
	}

	public function sanitizeInput($data): array
	{
		$data = $this->slugify($data);

		if ($this->userId) {
			$data = array_merge($data, ['user_id' => $this->userId]);
		}

		return $data;
	}
}

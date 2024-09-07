<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Traits;

trait Slugify
{
	public function slugify(array $data, string $key = 'name'): array
	{
		if (! isset($data[$key])) {
			throw new \Exception('Cannot slugify empty value');
		}

		$slug = strtolower(trim($data[$key]));
		$slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
		$slug = preg_replace('/-+/', '-', $slug);
		$slug = trim($slug, '-');

		$data['slug'] = $slug;
		return $data;
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

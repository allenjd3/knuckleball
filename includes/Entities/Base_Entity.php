<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Entities;

use Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Base_Repository;
use Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Entity;
use Ohio_Tokyo_International_Sea_Monster_Society\Traits\HasValidation;

abstract class Base_Entity implements Entity
{
	use HasValidation;

	public array $errors = [];

	abstract public function toArray(): array;

	public function getBaseRepository(?Base_Repository $repository = null)
	{
		return $repository ?? 'Ohio_Tokyo_International_Sea_Monster_Society\\Repositories\\' . (new \ReflectionClass($this))->getShortName() . '_Repository';
	}

	public function create(): ?Entity
	{
		$repoName = $this->getBaseRepository();

		$repository = new $repoName();
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

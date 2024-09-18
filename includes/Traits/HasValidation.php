<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Traits;

trait HasValidation
{
	public function getRules(): array
	{
		return $this->rules ?? [];
	}

	public function validate(): bool
	{
		$result = true;

		foreach ($this->getRules() as $attribute => $rule) {
			if (method_exists($this, $rule)) {
				$result = $result && $this->$rule($attribute);
			}
		}

		return $result;
	}

	public function required(string $attributeName): bool
	{
		if (strlen($this->$attributeName) <= 0 || strlen($this->$attributeName) > 255 ) {
			$this->errors[$attributeName] = ucwords(str_replace('_', ' ', $attributeName)) . ' must be between 0 and 255 chars';
			return false;
		}

		return true;
	}
}

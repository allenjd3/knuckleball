<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Entities;

class Collection
{
	private $items;

	public function __construct(array $items = [])
	{
		$this->items = $items;
	}

	public static function make(array $items = []): self
	{
		return new self($items);
	}

	public function map(callable $callback)
	{
		$keys = array_keys($this->items);

		$items = array_map($callback, $this->items, $keys);

		return new static(array_combine($keys, $items));
	}

	public function each(callable $callback)
	{
		foreach ($this->items as $key => $item) {
			if ($callback($item, $key) === false) {
				break;
			}
		}

		return $this;
	}

	public function push($item)
	{
		$this->items[] = $item;
	}

	public function pluck(string $columnName)
	{
		return $this->map(fn($item, $key) => $item->$columnName);
	}

	public function toArray()
	{
		return $this->items;
	}
}

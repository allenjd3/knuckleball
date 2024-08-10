<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Knuckleball;

class Knuckleball
{
	public function __construct()
	{
		$this->update_database_schema();
	}

	public static function init()
	{
		return new self();
	}

	private function update_database_schema()
	{
		(new Knuckleball_Database())->update_database_schema();
	}
}

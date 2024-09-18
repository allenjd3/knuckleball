<?php
namespace Ohio_Tokyo_International_Sea_Monster_Society\Repositories;

interface AddressContract {
	public function getPlayerAddress(int $id): ?Entity;
}

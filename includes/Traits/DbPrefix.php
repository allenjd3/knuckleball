<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Traits;

trait DbPrefix
{
	public function getTableName()
	{
		global $wpdb;
		return $wpdb->prefix . WP_KNUCKLEBALL_DB_PREFIX . $this->tableName;
	}
}

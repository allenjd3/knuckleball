<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Knuckleball;

class Knuckleball_Database
{
	public string $version = "1.0.1";

	public function update_database_schema()
	{
		$version = get_option('wp_knuckball_db_version');

		if ($version !== $this->version) {
			global $wpdb;

			$sql = file_get_contents(plugin_dir_path(__FILE__) . '../../Schemas/knuckleball.sql');

			$queries = explode(';', $sql);

			foreach ($queries as $query) {
				if (!empty(trim($query))) {
					$wpdb->query($query);
				}
			}

			update_option('wp_knuckball_db_version', $this->version);
		}
	}
}

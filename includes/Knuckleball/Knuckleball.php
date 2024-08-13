<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Knuckleball;

class Knuckleball
{
	public function __construct()
	{
		$this->update_database_schema();
		$this->register_endpoints();
		$this->register_deactivation_hook();
		$this->register_templates();
	}

	public static function init()
	{
		return new self();
	}

	private function update_database_schema()
	{
		(new Knuckleball_Database())->update_database_schema();
	}

	private function register_endpoints()
	{
		add_action('init', [$this, 'register_profile_endpoint']);
		flush_rewrite_rules();
	}

	public function register_profile_endpoint() {
		add_rewrite_rule('^players/([^/]*)/?', 'index.php?player_slug=$matches[1]', 'top');
		add_rewrite_tag('%player_slug%', '([^&]+)');
	}

	private function register_deactivation_hook()
	{
		register_deactivation_hook(__FILE__, [$this, 'flush_rewrite_rules']);
	}

	public function flush_rewrite_rules()
	{
		flush_rewrite_rules();
	}

	private function register_templates()
	{
		add_filter('template_include', [$this, 'player_template']);
		$this->flush_rewrite_rules();
	}

	public function player_template($template)
	{
		if (get_query_var('player_slug')) {
			$plugin_template = plugin_dir_path(dirname(__FILE__, 1)) . 'templates/player-template.php';
			if (file_exists($plugin_template)) {
				return $plugin_template;
			}
			return $template;
		}

		return $template;
	}
}

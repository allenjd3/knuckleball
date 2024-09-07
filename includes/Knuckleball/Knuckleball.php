<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Knuckleball;

use Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Player_Repository;

class Knuckleball
{
	public function __construct()
	{
		$this->update_database_schema();
		$this->enqueue_assets();
		$this->register_endpoints();
		$this->register_deactivation_hook();
		$this->register_templates();
		$this->register_shortcodes();
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
		if ($slug = get_query_var('player_slug')) {
			$player = (new Player_Repository())->findBySlug($slug);

			set_query_var('player', $player);
			$plugin_template = plugin_dir_path(dirname(__FILE__, 1)) . 'templates/player-template.php';

			if (file_exists($plugin_template)) {
				return $plugin_template;
			}

			return $template;
		}

		return $template;
	}

	private function register_shortcodes ()
	{
		add_shortcode('knuckleball-all-players', [$this, 'all_players']);
	}

	public function all_players()
	{
		$players = (new Player_Repository())->search($_GET['search'] ?? null);
		include plugin_dir_path(dirname(__FILE__)) . "templates/players-template.php";
	}

	public function enqueue_assets ()
	{
		add_action('wp_enqueue_scripts', [$this, 'knuckleball_enqueue_styles']);
	}

	public function knuckleball_enqueue_styles()
	{
		wp_enqueue_style('knuckleball-style', plugin_dir_url(dirname(__FILE__)) . "assets/style.css", [], '1.0.0', 'all');
	}
}

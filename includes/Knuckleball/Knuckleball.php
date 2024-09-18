<?php

namespace Ohio_Tokyo_International_Sea_Monster_Society\Knuckleball;

use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Address;
use Ohio_Tokyo_International_Sea_Monster_Society\Entities\Player;
use Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Player_Repository;
use Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Team_Repository;

class Knuckleball
{
	public function __construct()
	{
		$this->update_database_schema();
		$this->enqueue_assets();
		$this->register_roles();
		$this->register_endpoints();
		$this->register_activation_hook();
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
		add_action('admin_post_handle_create_player', [$this, 'handle_create_player']);
		add_action('admin_post_handle_create_address', [$this, 'handle_create_address']);
		flush_rewrite_rules();
	}

	public function register_profile_endpoint()
	{
		add_rewrite_rule('^players/([^/]*)/?', 'index.php?player_slug=$matches[1]', 'top');
		add_rewrite_tag('%player_slug%', '([^&]+)');
	}

	public function handle_create_player()
	{
		$player = Player::make(['name' => ($_POST['name'] ?? null), 'team_id' => $_POST['team_id']]);
		$player = $player->create();

		if (count($player->errors)) {
			set_transient('player', $player, 60);
			return wp_redirect('/players-create');
		}

		return wp_redirect('/players');
	}

	public function handle_create_address()
	{
		$address = Address::make([
			'addressable_type' => $_POST['type'] ?? 'player',
			'address_1' => $_POST['address_1'],
			'address_2' => $_POST['address_2'] ?? '',
			'city' => $_POST['city'],
			'state' => $_POST['state'],
			'postal_code' => $_POST['postal_code'],
		]);

		$address = $address->create();

		if (count($address->errors)) {
			set_transient('address', $address, 60);
		}

		return wp_redirect('/addresses');
	}

	private function register_activation_hook()
	{
		register_activation_hook(__FILE__, [$this, 'flush_rewrite_rules']);
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
		add_shortcode('knuckleball-create-player', [$this, 'create_player']);
		add_shortcode('knuckleball-create-address', [$this, 'create_address']);
	}

	public function all_players()
	{
		$players = (new Player_Repository())->search($_GET['search'] ?? null);
		include plugin_dir_path(dirname(__FILE__)) . "templates/players-template.php";
	}

	public function create_player()
	{
		$teams = (new Team_Repository())->findAll();
		if (current_user_can('create_knuckleball')) {
			include plugin_dir_path(dirname(__FILE__)) . "templates/create-player-template.php";
			return;
		}

		include plugin_dir_path(dirname(__FILE__)) . "templates/403.php";
	}

	public function create_address()
	{
//		$teams = (new Team_Repository())->findAll();
		if (current_user_can('create_knuckleball')) {
			include plugin_dir_path(dirname(__FILE__)) . "templates/create-address-template.php";
			return;
		}

		include plugin_dir_path(dirname(__FILE__)) . "templates/403.php";
	}

	public function enqueue_assets ()
	{
		add_action('wp_enqueue_scripts', [$this, 'knuckleball_enqueue_styles']);
	}

	public function knuckleball_enqueue_styles()
	{
		wp_enqueue_style('knuckleball-style', plugin_dir_url(dirname(__FILE__)) . "assets/style.css", [], '1.0.0', 'all');
	}

	private function register_roles()
	{
		add_action('init', [$this, 'add_roles']);
		add_action('admin_init', function () {
			get_role('administrator')->add_cap('create_knuckleball');
		});
	}

	public function add_roles()
	{
		add_role('create_players_and_cards', 'Create Players and Cards', [
			'read' => true,
			'create_knuckleball' => true,
		]);
	}
}

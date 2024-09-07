<?php
/**
 * Class SampleTest
 *
 * @package Knuckball
 */

/**
 * Sample test case.
 */
class SampleTest extends WP_UnitTestCase {

	/**
	 * @test
	 */
	public function sample() {
		$repo = new \Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Player_Repository(1);

		$repo->create([
			'name' => 'James Allen Rookie',
			'team_id' => 1
		]);
//		$repo->create([
//			'addressable_type' => 'player',
//			'addressable_id' => 1,
//			'address_1' => '2671 Rochester Ave',
//			'city' => 'Hamilton',
//			'state' => 'Ohio',
//			'postal_code' => '45011',
//		]);
//
//		$repo->create([
//			'addressable_type' => 'player',
//			'addressable_id' => 1,
//			'address_1' => '7305 Morris Road',
//			'city' => 'Hamilton',
//			'state' => 'Ohio',
//			'postal_code' => '45011',
//		]);
		print_r($allAddresses = $repo->findAll());
//		print_r($allAddresses->pluck('address_1')->toArray());
	}
}

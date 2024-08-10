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
	 * A single example test.
	 */
	public function test_sample() {
		$repo = new \Ohio_Tokyo_International_Sea_Monster_Society\Repositories\Address_Repository();
		$repo->create([
			'addressable_type' => 'player',
			'addressable_id' => 1,
			'address_1' => '7305 Morris Road',
			'city' => 'Hamilton',
			'state' => 'Ohio',
			'postal_code' => '45011',
		]);
		print_r($repo->findAll());
	}
}

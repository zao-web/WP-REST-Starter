<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Tests\Unit\Core;

use Brain\Monkey;
use Inpsyde\WPRESTStarter\Core\LinkAwareResponseDataAccess as Testee;
use Inpsyde\WPRESTStarter\Tests\TestCase;
use Mockery;

/**
 * Test case for the link-awre response data access class.
 *
 * @package Inpsyde\WPRESTStarter\Tests\Unit\Core
 * @since   2.0.0
 */
class LinkAwareResponseDataAccessTest extends TestCase {

	/**
	 * Tests getting the response data in array form without any links due the REST server being unaware of links.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\LinkAwareResponseDataAccess::get_data
	 *
	 * @return void
	 */
	public function test_get_data_with_rest_server_unaware_of_links() {

		$data = 'some data here';

		$response = Mockery::mock( 'WP_REST_Response' );
		$response->shouldReceive( 'get_data' )
			->andReturn( $data );

		Monkey\Functions::when( 'rest_get_server' )
			->justReturn();

		$expected = [ $data ];

		$this->assertSame( $expected, ( new Testee() )->get_data( $response ) );
	}

	/**
	 * Tests getting the response data with compoact links.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\LinkAwareResponseDataAccess::get_data
	 *
	 * @return void
	 */
	public function test_get_data_with_compact_links() {

		$data = 'some data here';

		$response = Mockery::mock( 'WP_REST_Response' );
		$response->shouldReceive( 'get_data' )
			->andReturn( $data );

		$links = [ 'some', 'links', 'here' ];

		$server_class = 'WP_REST_Server_Pre_4_5';
		Monkey\Functions::when( 'rest_get_server' )
			->justReturn( new $server_class( $links ) );

		$expected = [
			$data,
			'_links' => $links,
		];

		$this->assertSame( $expected, ( new Testee() )->get_data( $response ) );
	}

	/**
	 * Tests getting the response data with links.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\LinkAwareResponseDataAccess::get_data
	 *
	 * @return void
	 */
	public function test_get_data_with_links() {

		$data = 'some data here';

		$response = Mockery::mock( 'WP_REST_Response' );
		$response->shouldReceive( 'get_data' )
			->andReturn( $data );

		$links = [ 'some', 'links', 'here' ];

		$server_class = 'WP_REST_Server_Pre_4_5';
		Monkey\Functions::when( 'rest_get_server' )
			->justReturn( new $server_class( $links ) );

		$expected = [
			$data,
			'_links' => $links,
		];

		$this->assertSame( $expected, ( new Testee() )->get_data( $response ) );
	}
}

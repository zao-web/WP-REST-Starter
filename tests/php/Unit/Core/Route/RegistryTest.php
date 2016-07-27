<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Tests\Unit\Core\Route;

use ArrayIterator;
use Brain\Monkey;
use Inpsyde\WPRESTStarter\Core\Route\Registry as Testee;
use Inpsyde\WPRESTStarter\Tests\TestCase;
use Mockery;

/**
 * Test case for the route registry class.
 *
 * @package Inpsyde\WPRESTStarter\Tests\Unit\Core\Route
 * @since   1.0.0
 */
class RegistryTest extends TestCase {

	/**
	 * Tests registering routes of an empty route collection.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Route\Registry::register_routes()
	 *
	 * @return void
	 */
	public function test_register_routes_of_empty_collection() {

		$namespace = 'some-namespace-here';

		$routes = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Route\Collection' );
		$routes->shouldReceive( 'getIterator' )
			->andReturn( new ArrayIterator() );

		Monkey\WP\Actions::expectFired( 'wp_rest_starter.register_routes' )
			->once()
			->with( $routes, $namespace );

		( new Testee( $namespace ) )->register_routes( $routes );
	}

	/**
	 * Tests registering routes.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Route\Registry::register_routes()
	 *
	 * @return void
	 */
	public function test_register_routes() {

		$namespace = 'some-namespace-here';

		$route_foo = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Route\Route' )
			->shouldReceive( 'get_url' )
			->andReturn( 'route_foo_url' )
			->shouldReceive( 'get_options' )
			->andReturn( [ 'route_foo_options' ] )
			->getMock();

		$route_bar = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Route\Route' )
			->shouldReceive( 'get_url' )
			->andReturn( 'route_bar_url' )
			->shouldReceive( 'get_options' )
			->andReturn( [ 'route_bar_options' ] )
			->getMock();

		$routes = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Route\Collection' );
		$routes->shouldReceive( 'getIterator' )
			->andReturn( new ArrayIterator( [
				$route_foo,
				$route_bar,
				$route_foo,
				$route_foo,
				$route_bar,
			] ) );

		Monkey\WP\Actions::expectFired( 'wp_rest_starter.register_routes' )
			->once()
			->with( $routes, $namespace );

		Monkey\Functions::expect( 'register_rest_route' )
			->times( 3 )
			->with( $namespace, 'route_foo_url', [ 'route_foo_options' ] );
		Monkey\Functions::expect( 'register_rest_route' )
			->times( 2 )
			->with( $namespace, 'route_bar_url', [ 'route_bar_options' ] );

		( new Testee( $namespace ) )->register_routes( $routes );
	}
}

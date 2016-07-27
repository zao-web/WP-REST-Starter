<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Tests\Unit\Core\Route;

use Inpsyde\WPRESTStarter\Common\Endpoint\Schema;
use Inpsyde\WPRESTStarter\Core\Route\Options as Testee;
use Inpsyde\WPRESTStarter\Tests\TestCase;
use Mockery;

/**
 * Test case for the route options class.
 *
 * @package Inpsyde\WPRESTStarter\Tests\Unit\Core\Route
 * @since   1.0.0
 */
class OptionsTest extends TestCase {

	/**
	 * Tests the class instance is returned.
	 *
	 * Only test the "fluent" part of the method. The "functional" part is covered in the according integration test.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Route\Options::add()
	 *
	 * @return void
	 */
	public function test_add_returns_this() {

		$testee = new Testee();

		$this->assertSame( $testee, $testee->add( [] ) );
	}

	/**
	 * Tests the class instance is returned.
	 *
	 * Only test the "fluent" part of the method. The "functional" part is covered in the according integration test.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Route\Options::add_from_arguments()
	 *
	 * @return void
	 */
	public function test_add_from_arguments_returns_this() {

		$testee = new Testee();

		$this->assertSame( $testee, $testee->add_from_arguments() );
	}

	/**
	 * Tests the class instance is returned.
	 *
	 * Only test the "fluent" part of the method. The "functional" part is covered in the according integration test.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Route\Options::set_schema()
	 *
	 * @return void
	 */
	public function test_set_schema_returns_this() {

		$testee = new Testee();

		$schema = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Endpoint\Schema' );

		$this->assertSame( $testee, $testee->set_schema( $schema ) );
	}

	/**
	 * Tests returning an empty options array.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Route\Options::to_array()
	 *
	 * @return void
	 */
	public function test_getting_empty_options_array() {

		$this->assertSame( [], ( new Testee() )->to_array() );
	}

	/**
	 * Tests returning the options in array form.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Route\Options::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Route\Options::to_array()
	 *
	 * @return void
	 */
	public function test_getting_options_as_array() {

		$options = [ 'some', 'values', 'here' ];

		$this->assertSame( [ $options ], ( new Testee( $options ) )->to_array() );
	}
}

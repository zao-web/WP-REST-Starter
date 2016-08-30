<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Tests\Unit\Factory;

use Inpsyde\WPRESTStarter\Factory\Response as Testee;
use Inpsyde\WPRESTStarter\Tests\TestCase;

/**
 * Test case for the error factory class.
 *
 * @package Inpsyde\WPRESTStarter\Tests\Unit\Factory
 * @since   2.0.0
 */
class ResponseTest extends TestCase {

	/**
	 * Tests creating an instance of the default class.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Factory\Response::__construct()
	 * @covers Inpsyde\WPRESTStarter\Factory\Response::create()
	 *
	 * @return void
	 */
	public function test_creating_instance_of_default_class() {

		$this->assertInstanceOf( Testee::BASE, ( new Testee() )->create() );
	}

	/**
	 * Tests creating an instance of the given (base) class.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Factory\Response::__construct()
	 * @covers Inpsyde\WPRESTStarter\Factory\Response::create()
	 *
	 * @return void
	 */
	public function test_creating_instance_of_given_base_class() {

		$this->assertInstanceOf( Testee::BASE, ( new Testee() )->create( [], Testee::BASE ) );
	}

	/**
	 * Tests creating an instance of the given class.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Factory\Response::__construct()
	 * @covers Inpsyde\WPRESTStarter\Factory\Response::create()
	 *
	 * @return void
	 */
	public function test_creating_instance_of_given_class() {

		$this->assertInstanceOf( '\CustomResponse', ( new Testee() )->create( [], '\CustomResponse' ) );
	}

	/**
	 * Tests creating an instance of the given class.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Factory\Response::__construct()
	 * @covers Inpsyde\WPRESTStarter\Factory\Response::create()
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_creating_instance_of_default_class_with_invalid_given_class_while_not_debugging() {

		define( 'WP_DEBUG', false );

		$this->assertInstanceOf( Testee::BASE, ( new Testee() )->create( [], '\InvalidClass' ) );
	}

	/**
	 * Tests creating an instance of the given class.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Factory\Response::__construct()
	 * @covers Inpsyde\WPRESTStarter\Factory\Response::create()
	 * @expectedException \Inpsyde\WPRESTStarter\Exception\InvalidClassException
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_creating_instance_of_default_class_with_invalid_given_class_throws_exception_when_debugging() {

		define( 'WP_DEBUG', true );

		( new Testee() )->create( [], '\InvalidClass' );
	}
}

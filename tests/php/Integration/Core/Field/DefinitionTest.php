<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Tests\Integration\Core\Field;

use Inpsyde\WPRESTStarter\Common\Field\Reader;
use Inpsyde\WPRESTStarter\Common\Field\Updater;
use Inpsyde\WPRESTStarter\Common\Schema;
use Inpsyde\WPRESTStarter\Core\Field\Definition as Testee;
use Inpsyde\WPRESTStarter\Tests\TestCase;
use Mockery;

/**
 * Test case for the field definition class.
 *
 * @package Inpsyde\WPRESTStarter\Tests\Integration\Core\Field
 * @since   1.0.0
 */
class DefinitionTest extends TestCase {

	/**
	 * Tests creating an object, instantiated according to the given arguments.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::from_arguments()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::set_get_callback()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::set_schema()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::set_update_callback()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::to_array()
	 *
	 * @return void
	 */
	public function test_creating_from_arguments() {

		$reader = Mockery::mock( '\Inpsyde\WPRESTStarter\Common\Field\Reader' );

		$updater = Mockery::mock( '\Inpsyde\WPRESTStarter\Common\Field\Updater' );

		$schema = Mockery::mock( '\Inpsyde\WPRESTStarter\Common\Schema' );

		/**
		 * @var Reader  $reader
		 * @var Updater $updater
		 * @var Schema  $schema
		 */
		$testee = Testee::from_arguments(
			$reader,
			$updater,
			$schema,
			[ 'key' => 'value' ]
		);

		$expected = [
			'get_callback'    => [ $reader, 'get_value' ],
			'update_callback' => [ $updater, 'update_value' ],
			'schema'          => [ $schema, 'get_schema' ],
			'key'             => 'value',
		];

		$this->assertEquals( $expected, $testee->to_array() );
	}

	/**
	 * Tests setting the GET callback.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::set_get_callback()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::to_array()
	 *
	 * @return void
	 */
	public function test_set_get_callback() {

		$reader = Mockery::mock( '\Inpsyde\WPRESTStarter\Common\Field\Reader' );

		$testee = ( new Testee() )->set_get_callback( $reader );

		$expected = [
			'get_callback' => [ $reader, 'get_value' ],
		];

		$this->assertEquals( $expected, $testee->to_array() );
	}

	/**
	 * Tests resetting the GET callback.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::set_get_callback()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::to_array()
	 *
	 * @return void
	 */
	public function test_reset_get_callback() {

		$testee = ( new Testee( [ 'get_callback' => 'get_callback' ] ) )->set_get_callback();

		$expected = [
			'get_callback' => null,
		];

		$this->assertEquals( $expected, $testee->to_array() );
	}

	/**
	 * Tests setting the schema callback.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::set_schema()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::to_array()
	 *
	 * @return void
	 */
	public function test_set_schema() {

		$schema = Mockery::mock( '\Inpsyde\WPRESTStarter\Common\Schema' );

		$testee = ( new Testee() )->set_schema( $schema );

		$expected = [
			'schema' => [ $schema, 'get_schema' ],
		];

		$this->assertEquals( $expected, $testee->to_array() );
	}

	/**
	 * Tests resetting the schema callback.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::set_schema()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::to_array()
	 *
	 * @return void
	 */
	public function test_reset_schema() {

		$testee = ( new Testee( [ 'schema' => 'schema' ] ) )->set_schema();

		$expected = [
			'schema' => null,
		];

		$this->assertEquals( $expected, $testee->to_array() );
	}

	/**
	 * Tests setting the UPDATE callback.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::set_update_callback()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::to_array()
	 *
	 * @return void
	 */
	public function test_set_update_callback() {

		$updater = Mockery::mock( '\Inpsyde\WPRESTStarter\Common\Field\Updater' );

		$testee = ( new Testee() )->set_update_callback( $updater );

		$expected = [
			'update_callback' => [ $updater, 'update_value' ],
		];

		$this->assertEquals( $expected, $testee->to_array() );
	}

	/**
	 * Tests resetting the UPDATE callback.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::set_update_callback()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::to_array()
	 *
	 * @return void
	 */
	public function test_reset_update_callback() {

		$testee = ( new Testee( [ 'update_callback' => 'update_callback' ] ) )->set_update_callback();

		$expected = [
			'update_callback' => null,
		];

		$this->assertEquals( $expected, $testee->to_array() );
	}
}

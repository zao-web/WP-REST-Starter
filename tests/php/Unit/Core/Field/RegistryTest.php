<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Tests\Unit\Core\Field;

use ArrayIterator;
use Brain\Monkey;
use Inpsyde\WPRESTStarter\Core\Field\Registry as Testee;
use Inpsyde\WPRESTStarter\Tests\TestCase;
use Mockery;

/**
 * Test case for the field registry class.
 *
 * @package Inpsyde\WPRESTStarter\Tests\Unit\Core\Field
 * @since   1.0.0
 */
class RegistryTest extends TestCase {

	/**
	 * Tests failing silently when depended-upon function does not exist and not debugging.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Registry::register_fields()
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_register_fields_fails_silently() {

		define( 'WP_DEBUG', false );

		( new Testee() )->register_fields( Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Field\Collection' ) );
	}

	/**
	 * Tests failing with a notice when depended-upon function does not exist and debugging.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Registry::register_fields()
	 * @expectedException \PHPUnit_Framework_Error_Notice
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_register_fields_triggers_notice() {

		define( 'WP_DEBUG', true );

		( new Testee() )->register_fields( Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Field\Collection' ) );
	}

	/**
	 * Tests registering fields of an empty field collection.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Registry::register_fields()
	 *
	 * @return void
	 */
	public function test_register_fields_of_empty_collection() {

		$fields = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Field\Collection' );
		$fields->shouldReceive( 'getIterator' )
			->andReturn( new ArrayIterator() );

		Monkey\WP\Actions::expectFired( 'wp_rest_starter.register_fields' )
			->once()
			->with( $fields );

		// This has to stay because the code checks for register_rest_field() being available.
		Monkey\Functions::expect( 'register_rest_field' )
			->never();

		( new Testee() )->register_fields( $fields );
	}

	/**
	 * Tests registering fields.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Registry::register_fields()
	 *
	 * @return void
	 */
	public function test_register_fields() {

		$field_foo = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Field\Field' )
			->shouldReceive( 'get_definition' )
			->andReturn( [ 'field_foo_definition' ] )
			->getMock();

		$field_bar = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Field\Field' )
			->shouldReceive( 'get_definition' )
			->andReturn( [ 'field_bar_definition' ] )
			->getMock();

		$fields = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Field\Collection' );
		$fields->shouldReceive( 'getIterator' )
			->andReturn( new ArrayIterator( [
				'resource_foo' => compact( 'field_foo' ),
				'resource_bar' => compact( 'field_foo', 'field_bar' ),
			] ) );

		Monkey\WP\Actions::expectFired( 'wp_rest_starter.register_fields' )
			->once()
			->with( $fields );

		Monkey\Functions::expect( 'register_rest_field' )
			->once()
			->with( 'resource_foo', 'field_foo', [ 'field_foo_definition' ] );
		Monkey\Functions::expect( 'register_rest_field' )
			->once()
			->with( 'resource_bar', 'field_foo', [ 'field_foo_definition' ] );
		Monkey\Functions::expect( 'register_rest_field' )
			->once()
			->with( 'resource_bar', 'field_bar', [ 'field_bar_definition' ] );

		( new Testee() )->register_fields( $fields );
	}
}

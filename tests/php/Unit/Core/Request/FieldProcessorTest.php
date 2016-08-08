<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Tests\Unit\Core\Request;

use Brain\Monkey;
use Inpsyde\WPRESTStarter\Core\Request\FieldProcessor as Testee;
use Inpsyde\WPRESTStarter\Tests\TestCase;
use Mockery;

/**
 * Test case for the field procesor class.
 *
 * @package Inpsyde\WPRESTStarter\Tests\Unit\Core\Request
 * @since   2.0.0
 */
class FieldProcessorTest extends TestCase {

	/**
	 * Tests adding fields to the given object with no readable fields being registered.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Request\FieldProcessor::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Request\FieldProcessor::add_fields_to_object()
	 *
	 * @return void
	 */
	public function test_add_fields_with_no_fields_registered() {

		$object = [
			'some',
			'data',
			'here',
		];

		$request = Mockery::mock( 'WP_REST_Request' );

		$object_type = 'some_type_here';

		$field_access = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Field\Access' );
		$field_access->shouldReceive( 'get_fields' )
			->with( $object_type )
			->andReturn( [] );

		$actual = ( new Testee( $field_access ) )->add_fields_to_object( $object, $request, $object_type );

		$this->assertSame( $object, $actual );
	}

	/**
	 * Tests adding fields to the given object.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Request\FieldProcessor::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Request\FieldProcessor::add_fields_to_object()
	 *
	 * @return void
	 */
	public function test_add_fields() {

		$object = [
			'some',
			'data',
			'here',
		];

		$request = Mockery::mock( 'WP_REST_Request' );

		$object_type = 'some_type_here';

		$field_name = 'field_name';

		$field_callback = 'some_field_callback';

		$field_access = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Field\Access' );
		$field_access->shouldReceive( 'get_fields' )
			->with( $object_type )
			->andReturn( [
				'no_callback'      => [],
				'invalid_callback' => [
					'get_callback' => 'invalid callback',
				],
				$field_name        => [
					'get_callback' => $field_callback,
				],
			] );

		$field_value = 'some value here';

		Monkey\Functions::expect( $field_callback )
			->once()
			->with(
				$object,
				$field_name,
				$request,
				$object_type
			)
			->andReturn( $field_value );

		$expected = [
			'some',
			'data',
			'here',
			$field_name => $field_value,
		];

		$actual = ( new Testee( $field_access ) )->add_fields_to_object( $object, $request, $object_type );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * Tests adding fields to the given object triggers an error for an invalid callback when in debug mode.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Request\FieldProcessor::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Request\FieldProcessor::add_fields_to_object()
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_add_fields_triggers_error_for_invalid_callback_when_debugging() {

		define( 'WP_DEBUG', true );

		$object = [];

		$request = Mockery::mock( 'WP_REST_Request' );

		$object_type = 'some_type_here';

		$field_name = 'field_name';

		$field_access = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Field\Access' );
		$field_access->shouldReceive( 'get_fields' )
			->with( $object_type )
			->andReturn( [
				$field_name => [
					'get_callback' => 'invalid callback',
				],
			] );

		$this->setExpectedException(
			'PHPUnit_Framework_Error_Notice',
			"Invalid callback. Cannot read {$field_name} field for {$object_type}."
		);

		( new Testee( $field_access ) )->add_fields_to_object( $object, $request, $object_type );
	}

	/**
	 * Tests updating fields of the given object with no updatable fields being registered.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Request\FieldProcessor::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Request\FieldProcessor::update_fields_for_object()
	 *
	 * @return void
	 */
	public function test_update_fields_with_no_fields_registered() {

		$object = [];

		$request = Mockery::mock( 'WP_REST_Request' );

		$object_type = 'some_type_here';

		$field_access = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Field\Access' );
		$field_access->shouldReceive( 'get_fields' )
			->with( $object_type )
			->andReturn( [] );

		$actual = ( new Testee( $field_access ) )->update_fields_for_object( $object, $request, $object_type );

		$this->assertSame( 0, $actual );
	}

	/**
	 * Tests updating fields of the given object.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Request\FieldProcessor::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Request\FieldProcessor::update_fields_for_object()
	 *
	 * @return void
	 */
	public function test_update_fields() {

		$object = [
			'some',
			'data',
			'here',
		];

		$valid_field_1 = 'valid_field_1';

		$valid_field_2 = 'valid_field_2';

		$field_value = 'some value here';

		$request = Mockery::mock( 'WP_REST_Request', 'ArrayAccess' );
		$request->shouldReceive( 'offsetExists' )
			->andReturn( true );
		$request->shouldReceive( 'offsetGet' )
			->andReturn( $field_value );

		$request->no_callback      = true;
		$request->invalid_callback = true;
		$request->$valid_field_1   = true;
		$request->$valid_field_2   = true;

		$object_type = 'some_type_here';

		$field_callback = 'some_field_callback';

		$field_access = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Field\Access' );
		$field_access->shouldReceive( 'get_fields' )
			->with( $object_type )
			->andReturn( [
				'field_not_registered' => [],
				'no_callback'          => [],
				'invalid_callback'     => [
					'update_callback' => 'invalid callback',
				],
				$valid_field_1         => [
					'update_callback' => $field_callback,
				],
				$valid_field_2         => [
					'update_callback' => $field_callback,
				],
			] );

		Monkey\Functions::expect( $field_callback )
			->once()
			->with(
				$field_value,
				$object,
				$valid_field_1,
				$request,
				$object_type
			);

		Monkey\Functions::expect( $field_callback )
			->once()
			->with(
				$field_value,
				$object,
				$valid_field_2,
				$request,
				$object_type
			);

		$actual = ( new Testee( $field_access ) )->update_fields_for_object( $object, $request, $object_type );

		$this->assertSame( 2, $actual );
	}

	/**
	 * Tests updating fields of the given object triggers an error for an invalid callback when in debug mode.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Request\FieldProcessor::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Request\FieldProcessor::update_fields_for_object()
	 * @runInSeparateProcess
	 *
	 * @return void
	 */
	public function test_updating_fields_triggers_error_for_invalid_callback_when_debugging() {

		define( 'WP_DEBUG', true );

		$object = [];

		$request = Mockery::mock( 'WP_REST_Request', 'ArrayAccess' );
		$request->shouldReceive( 'offsetExists' )
			->andReturn( true );

		$object_type = 'some_type_here';

		$field_name = 'field_name';

		$field_access = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Field\Access' );
		$field_access->shouldReceive( 'get_fields' )
			->with( $object_type )
			->andReturn( [
				$field_name => [
					'update_callback' => 'invalid callback',
				],
			] );

		$this->setExpectedException(
			'PHPUnit_Framework_Error_Notice',
			"Invalid callback. Cannot update {$field_name} field for {$object_type}."
		);

		( new Testee( $field_access ) )->update_fields_for_object( $object, $request, $object_type );
	}
}

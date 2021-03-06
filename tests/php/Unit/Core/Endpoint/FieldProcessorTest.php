<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Tests\Unit\Core\Endpoint;

use Inpsyde\WPRESTStarter\Core\Endpoint\FieldProcessor as Testee;
use Inpsyde\WPRESTStarter\Tests\TestCase;
use Mockery;

/**
 * Test case for the endpoint schema field procesor class.
 *
 * @package Inpsyde\WPRESTStarter\Tests\Unit\Core\Endpoint
 * @since   2.0.0
 */
class FieldProcessorTest extends TestCase {

	/**
	 * Tests adding fields to the given schema properties with no schema-aware fields being registered.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Endpoint\FieldProcessor::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Endpoint\FieldProcessor::get_extended_properties()
	 *
	 * @return void
	 */
	public function test_get_extended_properties_with_no_fields_registered() {

		$properties = [
			'some',
			'data',
			'here',
			'properties' => [
				'some',
				'data',
				'here',
			],
		];

		$object_type = 'some_type_here';

		$field_access = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Field\Access' );
		$field_access->shouldReceive( 'get_fields' )
			->with( $object_type )
			->andReturn( [] );

		$actual = ( new Testee( $field_access ) )->get_extended_properties( $properties, $object_type );

		$this->assertSame( $properties, $actual );
	}

	/**
	 * Tests adding fields to the given schema properties.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Endpoint\FieldProcessor::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Endpoint\FieldProcessor::get_extended_properties()
	 *
	 * @return void
	 */
	public function test_add_fields() {

		$field_name_1 = 'field_name_1';

		$field_name_2 = 'field_name_2';

		$properties = [
			'some',
			'data',
			'here',
			'properties' => [
				'some',
				'data',
				'here',
				$field_name_1 => null,
			],
		];

		$object_type = 'some_type_here';

		$field_schema = 'some field schema';

		$field_access = Mockery::mock( 'Inpsyde\WPRESTStarter\Common\Field\Access' );
		$field_access->shouldReceive( 'get_fields' )
			->with( $object_type )
			->andReturn( [
				'no_schema'    => [],
				'empty_schema' => [
					'schema' => null,
				],
				$field_name_1  => [
					'schema' => $field_schema,
				],
				$field_name_2  => [
					'schema' => $field_schema,
				],
			] );

		$expected = [
			'some',
			'data',
			'here',
			'properties' => [
				'some',
				'data',
				'here',
				$field_name_1 => $field_schema,
				$field_name_2 => $field_schema,
			],
		];

		$actual = ( new Testee( $field_access ) )->get_extended_properties( $properties, $object_type );

		$this->assertSame( $expected, $actual );
	}
}

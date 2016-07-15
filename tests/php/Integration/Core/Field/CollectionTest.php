<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Tests\Integration\Core\Field;

use Inpsyde\WPRESTStarter\Core\Field\Collection as Testee;
use Inpsyde\WPRESTStarter\Core\Field\Definition;
use Inpsyde\WPRESTStarter\Core\Field\Field;
use Inpsyde\WPRESTStarter\Tests\TestCase;

/**
 * Test case for the field collection class.
 *
 * @package Inpsyde\WPRESTStarter\Tests\Integration\Core\Field
 * @since   1.0.0
 */
class CollectionTest extends TestCase {

	/**
	 * Tests adding and deleting fields.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Collection::add()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Collection::delete()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Collection::to_array()
	 *
	 * @return void
	 */
	public function test_add_and_delete() {

		$testee = new Testee();

		$field_name = 'field_name';

		$field = new Field( $field_name, Definition::from_arguments() );

		$resource = 'resource';

		$fields = $testee->add( $resource, $field )->to_array();
		$this->assertSame( $fields[ $resource ][ $field_name ], $field );

		$fields = $testee->delete( $resource, $field_name )->to_array();
		$this->assertTrue( empty( $fields[ $resource ][ $field_name ] ) );
	}
}

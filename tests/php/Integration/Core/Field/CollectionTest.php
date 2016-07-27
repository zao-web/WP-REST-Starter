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
	 * @since  1.1.0 Use `Testee::getIterator()` instead of deprecated `Testee::to_array()`.
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Collection::add()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Collection::delete()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Collection::getIterator()
	 *
	 * @return void
	 */
	public function test_add_and_delete() {

		$testee = new Testee();

		$field_name = 'field_name';

		$field = new Field( $field_name, Definition::from_arguments() );

		$resource = 'resource';

		$fields = iterator_to_array( $testee->add( $resource, $field )->getIterator() );
		$this->assertSame( $fields[ $resource ][ $field_name ], $field );

		$fields = iterator_to_array( $testee->delete( $resource, $field_name )->getIterator() );
		$this->assertTrue( empty( $fields[ $resource ][ $field_name ] ) );
	}
}

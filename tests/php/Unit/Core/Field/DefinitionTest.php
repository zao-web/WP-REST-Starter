<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Tests\Unit\Core\Field;

use Inpsyde\WPRESTStarter\Core\Field\Definition as Testee;
use Inpsyde\WPRESTStarter\Tests\TestCase;

/**
 * Test case for the field definition class.
 *
 * @package Inpsyde\WPRESTStarter\Tests\Unit\Core\Field
 * @since   1.0.0
 */
class DefinitionTest extends TestCase {

	/**
	 * Tests the class instance is returned.
	 *
	 * Only test the "fluent" part of the method. The "functional" part is covered in the according integration test.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::set_get_callback()
	 *
	 * @return void
	 */
	public function test_set_get_callback_returns_this() {

		$testee = new Testee();

		$this->assertSame( $testee, $testee->set_get_callback() );
	}

	/**
	 * Tests the class instance is returned.
	 *
	 * Only test the "fluent" part of the method. The "functional" part is covered in the according integration test.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::set_schema()
	 *
	 * @return void
	 */
	public function test_set_schema_returns_this() {

		$testee = new Testee();

		$this->assertSame( $testee, $testee->set_schema() );
	}

	/**
	 * Tests the class instance is returned.
	 *
	 * Only test the "fluent" part of the method. The "functional" part is covered in the according integration test.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::set_update_callback()
	 *
	 * @return void
	 */
	public function test_set_update_callback_returns_this() {

		$testee = new Testee();

		$this->assertSame( $testee, $testee->set_update_callback() );
	}

	/**
	 * Tests returning an empty definition array.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::to_array()
	 *
	 * @return void
	 */
	public function test_getting_empty_definition_array() {

		$this->assertSame( [], ( new Testee() )->to_array() );
	}

	/**
	 * Tests returning the definition in array form.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Definition::to_array()
	 *
	 * @return void
	 */
	public function test_getting_definition_as_array() {

		$definition = [ 'some', 'values', 'here' ];

		$fields = ( new Testee( $definition ) )->to_array();

		$this->assertSame( $definition, $fields );
	}
}

<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Tests\Unit\Core\Field;

use Inpsyde\WPRESTStarter\Common\Arguments;
use Inpsyde\WPRESTStarter\Core\Field\Field as Testee;
use Inpsyde\WPRESTStarter\Tests\TestCase;
use Mockery;

/**
 * Test case for the field class.
 *
 * @package Inpsyde\WPRESTStarter\Tests\Unit\Core\Field
 * @since   1.0.0
 */
class FieldTest extends TestCase {

	/**
	 * Tests getting the field definition.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Field::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Field::get_definition()
	 *
	 * @return void
	 */
	public function test_get_definition() {

		$definition_array = [ 'some', 'values', 'here' ];

		$definition = Mockery::mock( '\Inpsyde\WPRESTStarter\Common\Arguments' );
		$definition->shouldReceive( 'to_array' )
			->andReturn( $definition_array );

		/** @var Arguments $definition */
		$this->assertSame( $definition_array, ( new Testee( null, $definition ) )->get_definition() );
	}

	/**
	 * Tests getting the field name.
	 *
	 * @since  1.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Field::__construct()
	 * @covers Inpsyde\WPRESTStarter\Core\Field\Field::get_name()
	 *
	 * @return void
	 */
	public function test_get_name() {

		$name = 'some_name_here';

		$definition = Mockery::mock( '\Inpsyde\WPRESTStarter\Common\Arguments' );

		/** @var Arguments $definition */
		$this->assertSame( $name, ( new Testee( $name, $definition ) )->get_name() );
	}
}

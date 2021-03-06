<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Tests\Integration\Factory;

use Brain\Monkey;
use Inpsyde\WPRESTStarter\Factory\PermissionCallback as Testee;
use Inpsyde\WPRESTStarter\Tests\TestCase;

/**
 * Test case for the permission callback factory class.
 *
 * @package Inpsyde\WPRESTStarter\Tests\Integration\Factory
 * @since   2.0.0
 */
class PermissionCallbackTest extends TestCase {

	/**
	 * Tests the current_user_can permission callback with no capabilities.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Factory\PermissionCallback::current_user_can()
	 *
	 * @return void
	 */
	public function test_current_user_can_with_empty_capabilities() {

		$capabilities = [];

		$testee = ( new Testee() )->current_user_can( $capabilities );

		$this->assertSame( true, $testee() );
	}

	/**
	 * Tests the current_user_can permission callback with the single capability.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Factory\PermissionCallback::current_user_can()
	 *
	 * @return void
	 */
	public function test_current_user_can_with_single_capability() {

		$capabilities = [
			'some_cap_here',
		];

		$testee = ( new Testee() )->current_user_can( $capabilities );

		Monkey\Functions::when( 'current_user_can' )
			->justReturn( true );

		$this->assertSame( true, $testee() );
	}

	/**
	 * Tests the current_user_can permission callback without the single capability.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Factory\PermissionCallback::current_user_can()
	 *
	 * @return void
	 */
	public function test_current_user_can_without_single_capability() {

		$capabilities = [
			'some_cap_here',
		];

		$testee = ( new Testee() )->current_user_can( $capabilities );

		Monkey\Functions::when( 'current_user_can' )
			->justReturn( false );

		$this->assertSame( false, $testee() );
	}

	/**
	 * Tests the current_user_can permission callback with multiple capabilities.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Factory\PermissionCallback::current_user_can()
	 *
	 * @return void
	 */
	public function test_current_user_can_with_multiple_capabilities() {

		$capabilities = [
			'some_cap_here',
			'some_other_cap',
			'yet_another_cap',
		];

		$testee = ( new Testee() )->current_user_can( $capabilities );

		Monkey\Functions::when( 'current_user_can' )
			->justReturn( true );

		$this->assertSame( true, $testee() );
	}

	/**
	 * Tests the current_user_can permission callback with multiple capabilities of which the first fails.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Factory\PermissionCallback::current_user_can()
	 *
	 * @return void
	 */
	public function test_current_user_can_with_all_but_the_first_of_multiple_capabilities() {

		$capabilities = [
			'some_cap_here',
			'some_other_cap',
			'yet_another_cap',
		];

		$testee = ( new Testee() )->current_user_can( $capabilities );

		Monkey\Functions::expect( 'current_user_can' )
			->andReturnUsing( function ( $capability ) use ( $capabilities ) {

				return $capability !== $capabilities[0];
			} );

		$this->assertSame( false, $testee() );
	}

	/**
	 * Tests the current_user_can permission callback with multiple capabilities of which the last fails.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Factory\PermissionCallback::current_user_can()
	 *
	 * @return void
	 */
	public function test_current_user_can_with_all_but_the_last_of_multiple_capabilities() {

		$capabilities = [
			'some_cap_here',
			'some_other_cap',
			'yet_another_cap',
		];

		$testee = ( new Testee() )->current_user_can( $capabilities );

		Monkey\Functions::expect( 'current_user_can' )
			->andReturnUsing( function ( $capability ) use ( $capabilities ) {

				return $capability !== $capabilities[ count( $capabilities ) - 1 ];
			} );

		$this->assertSame( false, $testee() );
	}

	/**
	 * Tests the current_user_can permission callback with none of multiple capabilities.
	 *
	 * @since  2.0.0
	 *
	 * @covers Inpsyde\WPRESTStarter\Factory\PermissionCallback::current_user_can()
	 *
	 * @return void
	 */
	public function test_current_user_can_with_none_of_multiple_capabilities() {

		$capabilities = [
			'some_cap_here',
			'some_other_cap',
			'yet_another_cap',
		];

		$testee = ( new Testee() )->current_user_can( $capabilities );

		Monkey\Functions::when( 'current_user_can' )
			->justReturn( false );

		$this->assertSame( false, $testee() );
	}
}

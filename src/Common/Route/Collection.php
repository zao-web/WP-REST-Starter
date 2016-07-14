<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Common\Route;

use IteratorAggregate;

/**
 * Interface for all route collection implementations.
 *
 * @package Inpsyde\WPRESTStarter\Common\Route
 * @since   1.0.0
 */
interface Collection extends IteratorAggregate {

	/**
	 * Adds the given route object to the collection.
	 *
	 * @since 1.0.0
	 *
	 * @param Route $route Route object.
	 *
	 * @return $this
	 */
	public function add( Route $route );

	/**
	 * Deletes the route object at the given index from the collection.
	 *
	 * @since 1.0.0
	 *
	 * @param int $index Index of the route object.
	 *
	 * @return $this
	 */
	public function delete( $index );
}

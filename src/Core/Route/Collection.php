<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Core\Route;

use ArrayIterator;
use Inpsyde\WPRESTStarter\Common;

/**
 * Traversable route collection implementation using an array iterator.
 *
 * @package Inpsyde\WPRESTStarter\Core\Route
 * @since   1.0.0
 * @since   1.1.0 Deprecated `to_array()` method.
 */
class Collection implements Common\Route\Collection {

	/**
	 * @var Common\Route\Route[]
	 */
	private $routes = [];

	/**
	 * Adds the given route object to the collection.
	 *
	 * @since 1.0.0
	 *
	 * @param Common\Route\Route $route Route object.
	 *
	 * @return static Collection object.
	 */
	public function add( Common\Route\Route $route ) {

		$this->routes[] = $route;

		return $this;
	}

	/**
	 * Deletes the route object at the given index from the collection.
	 *
	 * @since 1.0.0
	 *
	 * @param int $index Index of the route object.
	 *
	 * @return static Collection object.
	 */
	public function delete( $index ) {

		unset( $this->routes[ $index ] );

		return $this;
	}

	/**
	 * Returns the routes in array form.
	 *
	 * @deprecated 1.1.0 If you really need this, use `iterator_to_array( $this->getIterator() );` instead.
	 * @since      1.0.0
	 *
	 * @return Common\Route\Route[] Routes array.
	 */
	public function to_array() {

		return $this->routes;
	}

	/**
	 * Returns an iterator object for the internal routes array.
	 *
	 * @since 1.0.0
	 *
	 * @return ArrayIterator Iterator object.
	 */
	public function getIterator() {

		return new ArrayIterator( $this->routes );
	}
}

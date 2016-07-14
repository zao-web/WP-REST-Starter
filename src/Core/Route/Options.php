<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Core\Route;

use Inpsyde\WPRESTStarter\Common;
use Inpsyde\WPRESTStarter\Common\Endpoint;
use WP_REST_Server;

/**
 * Route options implementation providing several named constructors and setters.
 *
 * @package Inpsyde\WPRESTStarter\Core\Route
 * @since   1.0.0
 */
class Options implements Common\Route\Options {

	/**
	 * Default comma-separated HTTP verbs.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	const DEFAULT_METHODS = WP_REST_Server::READABLE;

	/**
	 * @var array
	 */
	private $options = [];

	/**
	 * Returns a new route options object with the given arguments.
	 *
	 * @since 1.0.0
	 *
	 * @param callable $callback Endpoint callback.
	 * @param array    $args     Optional. Endpoint arguments. Defaults to empty array.
	 * @param string   $methods  Optional. Comma-separated HTTP verbs. Defaults to self::DEFAULT_METHODS.
	 *
	 * @return self Route options object.
	 */
	public static function with_callback( $callback, $args = [ ], $methods = self::DEFAULT_METHODS ) {

		return ( new self() )->add( compact( 'methods', 'callback', 'args' ) );
	}

	/**
	 * Returns a new route options object with a schema callback on the given object.
	 *
	 * @since 1.0.0
	 *
	 * @param Endpoint\Schema $schema Schema object.
	 *
	 * @return self Route options object.
	 */
	public static function with_schema( Endpoint\Schema $schema ) {

		return ( new self() )->set_schema( $schema );
	}

	/**
	 * Adds the given array to the options.
	 *
	 * @since 1.0.0
	 *
	 * @param array $options Options array.
	 *
	 * @return $this
	 */
	public function add( array $options ) {

		$this->options[] = $options;

		return $this;
	}

	/**
	 * Adds data to the options according to the given arguments.
	 *
	 * @since 1.0.0
	 *
	 * @param Endpoint\Handler $handler Optional. Request handler object. Defaults to null.
	 * @param Common\Arguments $args    Optional. Endpoint arguments object. Defaults to null.
	 * @param string           $methods Optional. Comma-separated HTTP verbs. Defaults to self::DEFAULT_METHODS.
	 * @param array            $options Optional. Additional options array. Defaults to empty array.
	 *
	 * @return $this
	 */
	public function add_from_arguments(
		Endpoint\Handler $handler = null,
		Common\Arguments $args = null,
		$methods = self::DEFAULT_METHODS,
		array $options = []
	) {

		if ( $handler ) {
			$options['callback'] = [ $handler, 'process' ];
		}

		if ( $args ) {
			$options['args'] = $args->to_array();
		}

		$options['methods'] = (string) $methods;

		$this->options[] = $options;

		return $this;
	}

	/**
	 * Sets the schema callback in the options to the according callback on the given schema object.
	 *
	 * @since 1.0.0
	 *
	 * @param Endpoint\Schema $schema Schema object.
	 *
	 * @return $this
	 */
	public function set_schema( Endpoint\Schema $schema ) {

		$this->options['schema'] = [ $schema, 'get_schema' ];

		return $this;
	}

	/**
	 * Returns the route options in array form.
	 *
	 * @since 1.0.0
	 *
	 * @return array Route options.
	 */
	public function to_array() {

		return $this->options;
	}
}

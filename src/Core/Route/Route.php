<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Core\Route;

use Inpsyde\WPRESTStarter\Common;

/**
 * Route implementation using the route options data type.
 *
 * @package Inpsyde\WPRESTStarter\Core\Route
 * @since   1.0.0
 */
class Route implements Common\Route\Route {

	/**
	 * @var Common\Route\Options
	 */
	private $options;

	/**
	 * @var string
	 */
	private $url;

	/**
	 * Constructor. Sets up the properties.
	 *
	 * @since 1.0.0
	 *
	 * @param string               $url     Base URL of the route.
	 * @param Common\Route\Options $options Route options object.
	 */
	public function __construct( $url, Common\Route\Options $options ) {

		$this->url = trim( $url, '/' );

		$this->options = $options;
	}

	/**
	 * Returns an array of options for the endpoint, or an array of arrays for multiple methods.
	 *
	 * @see   register_rest_route()
	 * @since 1.0.0
	 *
	 * @return array Route options.
	 */
	public function get_options() {

		return $this->options->to_array();
	}

	/**
	 * Returns the base URL of the route.
	 *
	 * @see   register_rest_route()
	 * @since 1.0.0
	 *
	 * @return string Base URL of the route.
	 */
	public function get_url() {

		return $this->url;
	}
}

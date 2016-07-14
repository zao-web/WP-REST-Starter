<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Common\Route;

/**
 * Interface for all route options implementations.
 *
 * @package Inpsyde\WPRESTStarter\Common\Route
 * @since   1.0.0
 */
interface Options {

	/**
	 * Returns the route options in array form.
	 *
	 * @since 1.0.0
	 *
	 * @return array Route options.
	 */
	public function to_array();
}

<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Common\Endpoint;

use Inpsyde\WPRESTStarter\Common;

/**
 * Interface for all response data schema implementations.
 *
 * @package Inpsyde\WPRESTStarter\Common\Endpoint
 * @since   1.0.0
 */
interface Schema extends Common\Schema {

	/**
	 * Returns the base of the schema.
	 *
	 * @since 1.0.0
	 *
	 * @return string Namespace/URL base.
	 */
	public function get_base();

	/**
	 * Returns the properties of the schema.
	 *
	 * @since 1.0.0
	 *
	 * @return array Properties definition.
	 */
	public function get_properties();
}

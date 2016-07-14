<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Common\Endpoint;

use WP_REST_Request;
use WP_REST_Response;

/**
 * Interface for all request handler implementations.
 *
 * @package Inpsyde\WPRESTStarter\Common\Endpoint
 * @since   1.0.0
 */
interface Handler {

	/**
	 * Processes the given request object and returns the according response object.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_REST_Request $request Request object.
	 *
	 * @return WP_REST_Response Response object.
	 */
	public function process( WP_REST_Request $request );
}

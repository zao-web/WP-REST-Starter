<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Common\Endpoint;

use WP_REST_Request;
use WP_REST_Response;

/**
 * Interface for all request handler implementations.
 *
 * @deprecated 1.1.0 Depreacted in favor of {@see RequestHandler}.
 * @package    Inpsyde\WPRESTStarter\Common\Endpoint
 * @since      1.0.0
 */
interface Handler {

	/**
	 * Processes the given request object and returns the according response object.
	 *
	 * @deprecated 1.1.0 Depreacted in favor of {@see RequestHandler::handle_request}.
	 * @since      1.0.0
	 *
	 * @param WP_REST_Request $request Request object.
	 *
	 * @return WP_REST_Response Response object.
	 */
	public function process( WP_REST_Request $request );
}

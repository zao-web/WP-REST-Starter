<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Core\Response;

use Inpsyde\WPRESTStarter\Common\Response\DataAccess;
use WP_REST_Response;

/**
 * Response data access implementation aware of links.
 *
 * @package Inpsyde\WPRESTStarter\Core\Response
 * @since   2.0.0
 */
final class LinkAwareDataAccess implements DataAccess {

	/**
	 * Returns an array holding the data as well as the defined links of the given response object.
	 *
	 * @since 2.0.0
	 *
	 * @param WP_REST_Response $response Response object.
	 *
	 * @return array The array holding the data as well as the defined links of the given response object.
	 */
	public function get_data( WP_REST_Response $response ) {

		$data = (array) $response->get_data();

		$links = $this->get_links( $response );
		if ( $links ) {
			$data['_links'] = $links;
		}

		return $data;
	}

	/**
	 * Returns an array holding the defined links of the given response object.
	 *
	 * @since 2.0.0
	 *
	 * @param WP_REST_Response $response Response object.
	 *
	 * @return array The array holding the defined links of the given response object.
	 */
	private function get_links( WP_REST_Response $response ) {

		$server = rest_get_server();

		foreach ( [ 'get_compact_response_links', 'get_response_links' ] as $method ) {
			if ( is_callable( [ $server, $method ] ) ) {
				return (array) call_user_func( [ $server, $method ], $response );
			}
		}

		return [];
	}
}

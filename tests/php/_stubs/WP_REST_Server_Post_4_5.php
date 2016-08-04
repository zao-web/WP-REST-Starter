<?php # -*- coding: utf-8 -*-

/**
 * Stub for the WP_REST_Server class as of WordPress 4.5.
 *
 * @since 2.0.0
 */
class WP_REST_Server_Post_4_5 {

	/**
	 * @var mixed
	 */
	private $links;

	/**
	 * Constructor. Sets up the properties.
	 *
	 * @since 2.0.0
	 *
	 * @param mixed $links
	 */
	public function __construct( $links ) {

		$this->links = $links;
	}

	/**
	 * @since 2.0.0
	 *
	 * @return mixed
	 */
	public function get_compact_response_links() {

		return $this->links;
	}
}

<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Common\Field;

/**
 * Interface for all field registry implementations.
 *
 * @package Inpsyde\WPRESTStarter\Common\Field
 * @since   1.0.0
 */
interface Registry {

	/**
	 * Registers the given fields.
	 *
	 * @since 1.0.0
	 *
	 * @param Collection $fields Field collection object.
	 *
	 * @return void
	 */
	public function register_fields( Collection $fields );
}

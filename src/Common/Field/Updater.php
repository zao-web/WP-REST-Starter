<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Common\Field;

/**
 * Interface for all field updater implementations.
 *
 * @package Inpsyde\WPRESTStarter\Common\Field
 * @since   1.0.0
 */
interface Updater {

	/**
	 * Updates the value of the field with the given name of the given object to the given value.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed  $value      New field value.
	 * @param object $object     Object from the response.
	 * @param string $field_name Field name.
	 *
	 * @return bool Whether or not the field was updated successfully.
	 */
	public function update_value( $value, $object, $field_name );
}

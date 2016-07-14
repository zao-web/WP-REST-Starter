<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Core\Field;

use Inpsyde\WPRESTStarter\Common;

/**
 * Field implementation using the field definition data type.
 *
 * @package Inpsyde\WPRESTStarter\Core\Field
 * @since   1.0.0
 */
class Field implements Common\Field\Field {

	/**
	 * @var Definition
	 */
	private $definition;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * Constructor. Sets up the properties.
	 *
	 * @param string     $name       Field name.
	 * @param Definition $definition Field definition object.
	 */
	public function __construct( $name, Definition $definition ) {

		$this->name = (string) $name;

		$this->definition = $definition;
	}

	/**
	 * Returns the field definition (i.e., callbacks and schema).
	 *
	 * @see   register_rest_field()
	 * @since 1.0.0
	 *
	 * @return array Field definition.
	 */
	public function get_definition() {

		return $this->definition->to_array();
	}

	/**
	 * Returns the name of the field.
	 *
	 * @see   register_rest_field()
	 * @since 1.0.0
	 *
	 * @return string Field name.
	 */
	public function get_name() {

		return $this->name;
	}
}

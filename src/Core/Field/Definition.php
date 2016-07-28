<?php # -*- coding: utf-8 -*-

namespace Inpsyde\WPRESTStarter\Core\Field;

use Inpsyde\WPRESTStarter\Common;

/**
 * Field definition data type.
 *
 * @deprecated 1.1.0 Deprecated in favor of {@see Field}.
 * @package    Inpsyde\WPRESTStarter\Core\Field
 * @since      1.0.0
 */
class Definition implements Common\Arguments {

	/**
	 * @var array
	 */
	private $definition;

	/**
	 * Constructor. Sets up the properties.
	 *
	 * @deprecated 1.1.0 Deprecated in favor of {@see Field::__construct}.
	 * @since      1.0.0
	 *
	 * @param array $definition Optional. Field definition. Defaults to empty array.
	 */
	public function __construct( array $definition = [] ) {

		_deprecated_function(
			__METHOD__,
			'1.1.0',
			'Inpsyde\WPRESTStarter\Core\Field\Field::__construct()'
		);

		$this->definition = $definition;
	}

	/**
	 * Returns a new definition object, instantiated according to the given arguments.
	 *
	 * @deprecated 1.1.0 Deprecated in favor of {@see Field::__construct} and the available setters.
	 * @since      1.0.0
	 *
	 * @param Common\Field\Reader  $reader     Optional. Field reader object. Defaults to null.
	 * @param Common\Field\Updater $updater    Optional. Field updater object. Defaults to null.
	 * @param Common\Schema        $schema     Optional. Schema object. Defaults to null.
	 * @param array                $definition Optional. Field definition. Defaults to empty array.
	 *
	 * @return self Definition object.
	 */
	public static function from_arguments(
		Common\Field\Reader $reader = null,
		Common\Field\Updater $updater = null,
		Common\Schema $schema = null,
		array $definition = []
	) {

		_deprecated_function(
			__METHOD__,
			'1.1.0',
			'Inpsyde\WPRESTStarter\Core\Field\Field::__construct() and the available setters'
		);

		return ( new self( $definition ) )
			->set_get_callback( $reader )
			->set_update_callback( $updater )
			->set_schema( $schema );
	}

	/**
	 * Sets the callback for reading the field value to the according callback on the given field reader object.
	 *
	 * @deprecated 1.1.0 Deprecated in favor of {@see Field::set_get_callback}.
	 * @since      1.0.0
	 *
	 * @param Common\Field\Reader $reader Optional. Field reader object. Defaults to null.
	 *
	 * @return $this
	 */
	public function set_get_callback( Common\Field\Reader $reader = null ) {

		_deprecated_function(
			__METHOD__,
			'1.1.0',
			'Inpsyde\WPRESTStarter\Core\Field\Field::set_get_callback()'
		);

		$this->definition['get_callback'] = $reader ? [ $reader, 'get_value' ] : null;

		return $this;
	}

	/**
	 * Sets the schema callback in the options to the according callback on the given schema object.
	 *
	 * @deprecated 1.1.0 Deprecated in favor of {@see Field::set_schema}.
	 * @since      1.0.0
	 *
	 * @param Common\Schema $schema Optional. Schema object. Defaults to null.
	 *
	 * @return $this
	 */
	public function set_schema( Common\Schema $schema = null ) {

		_deprecated_function(
			__METHOD__,
			'1.1.0',
			'Inpsyde\WPRESTStarter\Core\Field\Field::set_schema()'
		);

		$this->definition['schema'] = $schema ? [ $schema, 'get_schema' ] : null;

		return $this;
	}

	/**
	 * Sets the callback for updating the field value to the according callback on the given field updater object.
	 *
	 * @deprecated 1.1.0 Deprecated in favor of {@see Field::set_update_callback}.
	 * @since      1.0.0
	 *
	 * @param Common\Field\Updater $updater Optional. Field updater object. Defaults to null.
	 *
	 * @return $this
	 */
	public function set_update_callback( Common\Field\Updater $updater = null ) {

		_deprecated_function(
			__METHOD__,
			'1.1.0',
			'Inpsyde\WPRESTStarter\Core\Field\Field::set_update_callback()'
		);

		$this->definition['update_callback'] = $updater ? [ $updater, 'update_value' ] : null;

		return $this;
	}

	/**
	 * Returns the definition in array form.
	 *
	 * @since 1.0.0
	 *
	 * @return array[] Definition array.
	 */
	public function to_array() {

		return $this->definition;
	}
}

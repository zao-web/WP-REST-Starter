# WP REST Starter

[![Latest Stable Version](https://poser.pugx.org/inpsyde/wp-rest-starter/version)](https://packagist.org/packages/inpsyde/wp-rest-starter)
[![Project Status](http://opensource.box.com/badges/active.svg)](http://opensource.box.com/badges)
[![Build Status](https://travis-ci.org/inpsyde/WP-REST-Starter.svg?branch=master)](http://travis-ci.org/inpsyde/WP-REST-Starter)
[![Total Downloads](https://poser.pugx.org/inpsyde/wp-rest-starter/downloads)](https://packagist.org/packages/inpsyde/wp-rest-starter)
[![License](https://poser.pugx.org/inpsyde/wp-rest-starter/license)](https://packagist.org/packages/inpsyde/wp-rest-starter)

> Starter package for working with the WordPress REST API in an object-oriented fashion.

![WP REST Starter](resources/images/banner.png)

## Introduction

Since the infrastructure of the WordPress REST API got merged into Core and more and more will be integrated, it's obvious for others to jump on the bandwagon. This package provides you with virtually anything you need to start _feeling RESTful_.

WP REST Starter consists of several interfaces for both data types and _business logic_, and it comes with straightforward implementations suitable for the common needs. All you have to do is configure your REST routes and data structures, and implement the according request handlers.

## Installation

Install with Composer:

```
$ composer require inpsyde/wp-rest-starter
```

Run the tests:

```
$ vendor/bin/phpunit
```

### Requirements

This package requires PHP 5.4 or higher.

Adding custom fields to existing resources requires the [WP REST API](https://wordpress.org/plugins/rest-api/) plugin. If all you want to do is defining custom REST routes, you're already good to go with WordPress 4.4 or higher. 

## Usage

The following sections will help you get started with the WordPress REST API in an object-oriented fashion.  
If you're new to working with the WordPress REST API in general, please refer to [the official WP REST API documentation](http://v2.wp-api.org/).

### Actions

In order to inform about certain events, some of the shipped classes provide you with custom actions. For each of these, a short description as well as a code example on how to _take action_ is given below.

#### `wp_rest_starter.register_fields`

When using the default field registry class, `\Inpsyde\WPRESTStarter\Core\Field\Registry`, this action fires right before the fields are registered.

**Arguments:**

- `$fields` [`\Inpsyde\WPRESTStarter\Common\Field\Collection`](src/Common/Field/Collection.php): Field collection object.

**Usage Example:**

```php
<?php

use Inpsyde\WPRESTStarter\Common\Field\Collection;

add_action( 'wp_rest_starter.register_routes', function ( Collection $fields ) {

	// Remove a specific field from all post resources.
	$fields->delete( 'post', 'some-field-with-sensible-data' );
} );
```

#### `wp_rest_starter.register_routes`

When using the default route registry class, `\Inpsyde\WPRESTStarter\Core\Route\Registry`, this action fires right before the routes are registered.

**Arguments:**

- `$routes` [`\Inpsyde\WPRESTStarter\Common\Route\Collection`](src/Common/Route/Collection.php): Route collection object.
- `$namespace` `string`: Namespace.

**Usage Example:**

```php
<?php

use Inpsyde\WPRESTStarter\Common\Route\Collection;
use Inpsyde\WPRESTStarter\Core\Route\Options;
use Inpsyde\WPRESTStarter\Core\Route\Route;

add_action( 'wp_rest_starter.register_routes', function ( Collection $routes, $namespace ) {

	if ( 'desired-namespace' !== $namespace ) {
		return;
	}

	// Register a custom REST route in the desired namespace.
	$routes->add( new Route(
		'some-custom-route/maybe-even-with-arguments',
		Options::with_callback( 'some_custom_request_handler_callback' )
	) );
}, 10, 2 );
```

### Registering a Custom Route

```php
<?php

use Inpsyde\WPRESTStarter\Core\Route\Collection;
use Inpsyde\WPRESTStarter\Core\Route\Options;
use Inpsyde\WPRESTStarter\Core\Route\Registry;
use Inpsyde\WPRESTStarter\Core\Route\Route;
use Inpsyde\WPRESTStarter\Factory\PermissionCallback;

add_action( 'rest_api_init', function() {

	// Create a new route collection.
	$routes = new Collection();

	// Optional: Create a permission callback factory.
	$permission = new PermissionCallback();

	$endpoint_base = 'some-data-type';

	// TODO: Set up the $handler for the READ request (implement ~\Common\Endpoint\Handler).
	// TODO: Optional: Set up according endpoint $args (implement ~\Common\Arguments).

	// Register a route for the READ endpoint.
	$routes->add( new Route(
		$endpoint_base . '(?:/(?P<id>\d+))?',
		Options::from_arguments( $handler, $args )
	) );

	// TODO: Set up the $handler for the CREATE request (implement ~\Common\Endpoint\Handler).
	// TODO: Optional: Set up according endpoint $args (implement ~\Common\Arguments).

	// Register a route for the CREATE endpoint.
	$routes->add( new Route(
		$endpoint_base,
		Options::from_arguments( $handler, $args, WP_REST_Server::CREATABLE, [
			// Optional: Set a callback to check permission.
			'permission_callback' => $permission->current_user_can( [ 'edit_posts', 'custom_cap' ] ),
		] )
	) );

	// Optional: Register a route for the endpoint $schema object (implement ~\Common\Endpoint\Schema).
	$routes->add( new Route(
		$endpoint_base . '/schema',
		Options::with_callback( [ $schema, 'get_schema' ] )
	) );

	// Register all routes in the given namespace.
	( new Registry( 'some-namespace-here' ) )->register_routes( $routes );
} );
```

### Adding Custom Fields to the Response of Existing Endpoints

```php
<?php

use Inpsyde\WPRESTStarter\Core\Field\Collection;
use Inpsyde\WPRESTStarter\Core\Field\Field;
use Inpsyde\WPRESTStarter\Core\Field\Registry;

add_action( 'rest_api_init', function() {

	// Create a new field collection.
	$fields = new Collection();

	// TODO: Optional: Set up the $reader to READ the field value (implement ~\Common\Field\Reader).
	// TODO: Optional: Set up the $updater to UPDATE the field value (implement ~\Common\Field\Updater).
	// TODO: Optional: Create a field $schema object (implement ~\Common\Schema).

	// Register a read- and updatable field for some resource.
	$fields->add(
		'some-data-type',
		( new Field( 'has_explicit_content' ) )
			->set_get_callback( $reader )
			->set_update_callback( $updater )
			->set_schema( $schema )
	);

	// TODO: Set up the $reader to READ the field value (implement ~\Common\Field\Reader).

	// Register another read-only field for some resource.
	$fields->add(
		'some-data-type',
		( new Field( 'is_long_read' ) )
			->set_get_callback( $reader )
	);

	// Register all fields.
	( new Registry() )->register_fields( $fields );
} );
```

### Example Endpoint Schema Implementation

```php
<?php

use Inpsyde\WPRESTStarter\Common\Endpoint\Schema;

class SomeEndpointSchema implements Schema {

	/**
	 * Returns the properties of the schema.
	 *
	 * @return array Properties definition.
	 */
	public function get_properties() {

		return [
			'id' => [
				'description' => __( "The ID of the data object.", 'some-text-domain' ),
				'type'        => 'integer',
				'context'     => [ 'view', 'edit' ],
			],
		];
	}

	/**
	 * Returns the schema definition.
	 *
	 * @return array Schema definition.
	 */
	public function get_schema() {

		return [
			'$schema'    => 'http://json-schema.org/draft-04/schema#',
			'title'      => 'some-data-type',
			'type'       => 'object',
			'properties' => $this->get_properties(),
		];
	}
}
```

### Example Endpoint Arguments Implementation

```php
<?php

use Inpsyde\WPRESTStarter\Common\Arguments;

class SomeEndpointArguments implements Arguments {

	/**
	 * Returns the arguments in array form.
	 *
	 * @return array[] Arguments array.
	 */
	public function to_array() {

		return [
			'id'   => [
				'description' => __( "The ID of a data object.", 'some-text-domain' ),
				'type'        => 'integer',
				'minimum'     => 1,
				'required'    => true,
			],
			'type' => [
				'description' => __( "The type of the data object.", 'some-text-domain' ),
				'type'        => 'string',
				'default'     => 'foo',
			],
		];
	}
}
```

### Example Request Handler Implementation

```php
<?php

use Inpsyde\WPRESTStarter\Common\Endpoint\Handler;
use Inpsyde\WPRESTStarter\Factory\Response;
use Some\External\API;

class SomeRequestHandler implements Handler {

	/**
	 * @var API
	 */
	private $api;

	/**
	 * @var Response
	 */
	private $response;

	/**
	 * Constructor. Sets up the properties.
	 *
	 * @param API      $api      External data API object.
	 * @param Response $response Response factory object.
	 */
	public function __construct( API $api, Response $response ) {

		$this->api = $api;

		$this->response = $response;
	}

	/**
	 * Processes the given request object and returns the according response object.
	 *
	 * @param WP_REST_Request $request Request object.
	 *
	 * @return WP_REST_Response Response object.
	 */
	public function process( WP_REST_Request $request ) {

		$id = $request->get_param( 'id' );

		// Update the according object data by using the injected data API.
		if ( ! $this->api->update_data( $id, $request->get_body_params() ) ) {
			// Ooops! Send an error response.
			return $this->response->create( [
				[
					'code'    => 'could_not_update',
					'message' => __( "The object could not be updated.", 'some-text-domain' ),
					'data'    => $request->get_params(),
				],
				400,
			] );
		}

		// Send a response object containing the updated data.
		return $this->response->create( [ $this->api->get_data( $id ) ] );
	}
}
```

### Example Field Schema Implementation

```php
<?php

use Inpsyde\WPRESTStarter\Common\Schema;

class SomeFieldSchema implements Schema {

	/**
	 * Returns the schema definition.
	 *
	 * @return array Schema definition.
	 */
	public function get_schema() {

		return [
			'description' => __( "Whether the object contains explicit content.", 'some-text-domain' ),
			'type'        => 'boolean',
			'context'     => [ 'view', 'edit' ],
		];
	}
}
```

### Example Field Reader Implementation

```php
<?php

use Inpsyde\WPRESTStarter\Common\Field\Reader;

class SomeFieldReader implements Reader {

	/**
	 * Returns the value of the field with the given name of the given object.
	 *
	 * @param array           $object     Object data in array form.
	 * @param string          $field_name Field name.
	 * @param WP_REST_Request $request    Request object.
	 *
	 * @return bool Field value.
	 */
	public function get_value( array $object, $field_name, WP_REST_Request $request ) {

		if ( empty( $object['id'] ) ) {
			return false;
		}

		return (bool) some_field_getter_callback( $object['id'], $field_name );
	}
}
```

### Example Field Updater Implementation

```php
<?php

use Inpsyde\WPRESTStarter\Common\Field\Updater;

class SomeFieldUpdater implements Updater {

	/**
	 * @var callable
	 */
	private $permission_callback;

	/**
	 * Constructor. Sets up the properties.
	 *
	 * @param callable $permission_callback Optional. Permission callback. Defaults to null.
	 */
	public function __construct( callable $permission_callback = null ) {

		if ( $permission_callback ) {
			$this->permission_callback = $permission_callback;
		}
	}

	/**
	 * Updates the value of the field with the given name of the given object to the given value.
	 *
	 * @param mixed  $value      New field value.
	 * @param object $object     Object from the response.
	 * @param string $field_name Field name.
	 *
	 * @return bool Whether or not the field was updated successfully.
	 */
	public function update_value( $value, $object, $field_name ) {

		if ( $this->permission_callback && ! call_user_func( $this->permission_callback ) ) {
			return false;
		}

		if ( empty( $object->id ) ) {
			return false;
		}

		return some_field_updater_callback( $object->id, $field_name, (bool) $value );
	}
}
```

## License

Copyright (c) 2016 Inpsyde GmbH

This code is licensed under the [MIT License](LICENSE).

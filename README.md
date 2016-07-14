# WP REST Starter

Starter package for working with the WordPress REST API in an object-oriented fashion.

## Introduction

Since the infrastructure of the WordPress REST API got merged into Core and more and more will be integrated, it's obvious for others to jump on the bandwagon. This package provides you with virtually anything you need to start feeling RESTful yourself.

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

The WP REST Starter package requires PHP 5.4+.  
In order to define custom REST routes, you need **either** WordPress 4.4+ **or** the [WP REST API](https://wordpress.org/plugins/rest-api/) plugin 1.2.4+.  
If you would like to add custom fields to existing resources, however, you actually need the [WP REST API](https://wordpress.org/plugins/rest-api/) plugin.

## Usage

The following sections can be seen as documentation of this package and will help you get started with the WordPress REST API, in an object-oriented fashion.  
If you're new to working with the WordPress REST API in general, please refer to [the official WP REST API documentation](http://v2.wp-api.org/).

### Actions

In order to inform about certain events, some of the shipped classes provide you with custom actions. For each of these, a short description as well as a code example on how to _take action_ is given below.

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

### TODO

Provide examples for both setting up a custom route (with at least two endpoints and schema) and adding a custom field to an existing resource. The former can be extracted from the MultilingualPress REST API plugin...

## License

Copyright (c) 2016 Inpsyde GmbH

This code is licensed under the [MIT License](LICENSE).

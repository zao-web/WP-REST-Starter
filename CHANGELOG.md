# Changelog

## 2.0.0

* **[BREAKING]** **Finalize** all classes that implement at least one provided interface and that are not overcomplete.
* **[BREAKING]** **Remove** deprecated `~\Common\Endpoint\Handler` and `~\Common\Route\Options` interfaces, and `~\Core\Field\Definition` implementation.
* **[BREAKING]** **Remove** deprecated `to_array()` method from `~\Core\Field\Collection` and `~\Core\Route\Collection` implementations.
* **Adapt** `~\Core\Field\Field` and `~\Core\Route\Options` implementations.
* **Introduce** `~\Common\Response\DataAccess` interface and `~\Core\Response\LinkAwareDataAccess` implementation.
* **Introduce** `~\Common\Response\DataFilter` interface and `~\Core\Response\SchemaAwareDataFilter` implementation.

### TODO

Introduce (and integrate) interfaces and reference implementations for:

* [`WP_REST_Controller::add_additional_fields_to_object()`](https://github.com/WP-API/WP-API/blob/c661101fd4f8889a68c34105e09a39e00c2e122f/lib/endpoints/class-wp-rest-controller.php#L304-L325).
* [`WP_REST_Controller::update_additional_fields_for_object()`](https://github.com/WP-API/WP-API/blob/c661101fd4f8889a68c34105e09a39e00c2e122f/lib/endpoints/class-wp-rest-controller.php#L327-L350).
* [`WP_REST_Controller::add_additional_fields_schema()`](https://github.com/WP-API/WP-API/blob/c661101fd4f8889a68c34105e09a39e00c2e122f/lib/endpoints/class-wp-rest-controller.php#L352-L380).

## 1.1.0

* **Introduce** `~\Common\Endpoint\RequestHandler` interface.
* **Introduce** `~\Common\Field\ReadableField`, `~\Common\Field\UpdatableField` and `~\Common\Field\SchemaAwareField` interfaces.
* **Introduce** `~\Common\Route\ExtensibleOptions` and `~\Common\Route\SchemaAwareOptions` interfaces.
* **Refactor** `~\Common\Field\Collection` interface and `~\Core\Field\Collection` implementation.
* **Refactor** `~\Core\Field\Field` implementation.
* **Refactor** `~\Common\Route\Collection` interface and `~\Core\Route\Collection` implementation.
* **Refactor** `~\Core\Route\Options` implementation.
* **Deprecate** `~\Common\Endpoint\Handler` interface in favor of `~\Common\Endpoint\RequestHandler`.
* **Deprecate** `~\Core\Field\Definition` implementation in favor of `~\Core\Field\Field`.
* **Deprecate** `~\Common\Route\Options` interface in favor of `~\Common\Arguments`.

## 1.0.0

* Initial release.

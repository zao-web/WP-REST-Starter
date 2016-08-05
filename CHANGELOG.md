# Changelog

## 2.0.0

* **[BREAKING]** **Finalize** all classes that implement at least one provided interface and that are not overcomplete.
* **[BREAKING]** **Remove** deprecated `~\Common\Endpoint\Handler` and `~\Common\Route\Options` interfaces, and `~\Core\Field\Definition` implementation.
* **[BREAKING]** **Remove** deprecated `to_array()` method from `~\Core\Field\Collection` and `~\Core\Route\Collection` implementations.
* **Adapt** `~\Core\Field\Field` and `~\Core\Route\Options` implementations.
* **Introduce** `~\Common\Response\DataAccess` interface and `~\Core\Response\LinkAwareDataAccess` implementation.
* **Introduce** `~\Common\Response\DataFilter` interface and `~\Core\Response\SchemaAwareDataFilter` implementation.

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

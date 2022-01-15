# Resolver Container Service

Resolver container implementation.

## Table of Contents

- [Getting started](#getting-started)
    - [Requirements](#requirements)
    - [Highlights](#highlights)
- [Documentation](#documentation)
    - [Resolver Factory](#resolver-factory)
- [Credits](#credits)
___

# Getting started

Add the latest version of the autowire service running this command.

```
composer require tobento/service-resolver-container
```

## Requirements

- PHP 8.0 or greater

## Highlights

- Framework-agnostic, will work with any project

# Documentation

## Resolver Factory

```php
use Tobento\Service\ResolverContainer\ResolverFactory;
use Tobento\Service\Resolver\ResolverFactoryInterface;
use Tobento\Service\Resolver\ResolverInterface;

$resolverFactory = new ResolverFactory();

var_dump($resolverFactory instanceof ResolverFactoryInterface);
// bool(true)

// create resolver
$resolver = $resolverFactory->createResolver();

var_dump($resolver instanceof ResolverInterface);
// bool(true)
```

Visit [Resolver Service](https://github.com/tobento-ch/service-resolver) to learn more about the resolver.

# Credits

- [Tobias Strub](https://www.tobento.ch)
- [All Contributors](../../contributors)
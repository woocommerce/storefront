# PHP Unit Tests

This directory contains PHP unit tests for the Storefront theme.

## Setup

Install dependencies:

```bash
npm install
composer install
```

## Running Tests

Run tests inside wp-env:

```bash
npm run wp-env start
npm run test:php
```

## Test Coverage

Currently, the following classes are tested:

-   `Storefront_WooCommerce_Adjacent_Products` - Integration tests verifying adjacent product selection skips hidden products on identical publish dates.

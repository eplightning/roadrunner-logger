# WIP: RoadRunner Application Logging Service

Logging service for RoadRunner exposing RPC method(s) to integrate with RoadRunner logging facilities. It aims to simplify logging in PHP applications, letting RoadRunner handle everything.

## PHP

```
composer require eplightning/roadrunner-logger
```

PHP composer package includes simple helper class for making RPC calls to RR service. PSR-3 spec is also implemented allowing simple integration with existing logging libraries - such as Monolog.

## RoadRunner Service

WIP, need docs

## TODO

 * Monolog handler (not really needed since Monolog's PsrHandler exists)
 * Option to log application stderr without enabling debug mode in RR - might be useful for catching fatal PHP errors (OOM?) without all the extra debug logging
 * Docs and tests

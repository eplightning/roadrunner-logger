# WIP: RoadRunner Application Logging Service

Logging service for RoadRunner exposing RPC method(s) to integrate with RoadRunner logging facilities. It aims to simplify logging in PHP applications, letting RoadRunner handle everything.

## TODO

 * PHP library, PSR-3 implementation
 * Monolog handler (probably not required, can use PsrHandler if PSR-3 is implemented)
 * Option to log application stderr without enabling debug mode in RR - might be useful for catching fatal PHP errors (OOM?) without all the extra debug logging
 * Docs and tests

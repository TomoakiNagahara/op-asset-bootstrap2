# Bootstrap As-Is

## Overview

This document describes the current implementation of:

- `asset/bootstrap/index.php`

as it exists today.

The bootstrap layer is responsible for making the framework usable before normal application flow begins.

It belongs to the pre-app-unit startup stage.

## Main Responsibility

The current bootstrap entry does not perform broad application logic by itself.

Its practical role is:

- include the required startup files in a fixed order
- stop startup immediately if a required file is missing
- stop startup immediately if an included startup step throws

## Current Include Order

The current implementation iterates through this fixed list:

1. `core/Bootstrap.php`
2. `config/op.php`
3. `config/php.php`
4. `bootstrap/include/php.php`
5. `bootstrap/include/root.php`
6. `bootstrap/include/appid.php`
7. `bootstrap/include/admin.php`
8. `bootstrap/include/rewrite.php`
9. `bootstrap/include/session.php`

The full path is generated from:

- `dirname(__DIR__) . '/' . $file`

So the bootstrap entry uses `asset/` as its fixed base.

## Include Style

Each target file is included inside a closure:

```php
call_user_func(function($file){
    include($file);
}, $file);
```

Current practical meaning:

- each startup file is executed in a limited include scope
- bootstrap itself keeps control of the overall order

## Missing File Behavior

If a required file does not exist:

- bootstrap checks whether `_ROOT_OP_` is already defined
- if it is defined, the error message rewrites the `_ROOT_OP_` prefix to `OP:/`
- then bootstrap throws an exception

This means missing bootstrap files are treated as fatal startup errors.

## Failure Handling

The whole startup sequence is wrapped in:

- `try`
- `catch (\Throwable $e)`

If any included startup step throws:

- HTTP status is set to `500`
- `Bootstrap: ...` is printed
- the stack trace is printed
- bootstrap terminates with `exit(__LINE__)`

This means bootstrap failure is handled inside bootstrap itself, before normal App-unit control begins.

## Included Startup Steps

### `bootstrap/include/php.php`

Current role:

- verify required PHP extensions such as `mbstring` and `openssl`
- terminate immediately if they are unavailable

### `bootstrap/include/root.php`

Current role:

- load `RootPath.php`
- register root labels such as `real`, `op`, `git`, `doc`, `app`, `asset`, `core`, and `unit`

### `bootstrap/include/appid.php`

Current role:

- check whether `_APP_ID_` is already available in app config
- if not, render bootstrap-side guidance template output

### `bootstrap/include/admin.php`

Current role:

- in CI mode, inject fallback admin config values
- otherwise, verify whether admin config exists
- if missing, render bootstrap-side guidance template output

### `bootstrap/include/rewrite.php`

Current role:

- skip when already running through `app.php`
- skip for built-in server
- skip for CI
- otherwise, check current PHP SAPI compatibility and render bootstrap-side guidance when needed

### `bootstrap/include/session.php`

Current role:

- skip for CLI
- skip if a session already exists
- otherwise start a session
- terminate immediately if session startup fails

## Boundary Meaning

This file should be understood as a startup orchestrator.

It is not the normal place for:

- page-level rendering logic
- reusable application templates
- post-startup business flow

Those concerns belong later in the framework lifecycle.

## Summary

Current `asset/bootstrap/index.php` is:

- a fixed-order startup loader
- a fatal-error boundary for startup failures
- the bridge between `app.php` and the later App-unit-driven application flow

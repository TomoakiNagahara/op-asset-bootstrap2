# Bootstrap Boundary

## Overview

`asset/bootstrap/` belongs to the startup stage before OP-CORE is fully available.

Because of that, bootstrap-side code should be treated as a self-contained startup layer rather than as an ordinary reusable framework/application layer.

## Template Boundary

Templates under:

- `asset/bootstrap/template/`

are intended to stay inside bootstrap itself.

They are not expected to be reused from other framework layers or from ordinary application-side template flows.

In other words, these templates are bootstrap-internal assets.

## Operational Meaning

When working in `asset/bootstrap/`, the safer assumption is:

- bootstrap templates are for bootstrap only
- bootstrap code should not assume normal OP-CORE feature availability unless bootstrap has already established it

This keeps the startup layer isolated and avoids leaking ordinary framework assumptions into the pre-core stage.

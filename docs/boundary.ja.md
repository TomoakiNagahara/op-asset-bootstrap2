# Bootstrap Boundary

## 概要

`asset/bootstrap/` は、OP-CORE が fully available になる前の startup 段階に属します。

そのため bootstrap 側の code は、通常の reusable な framework/application layer ではなく、自立した startup layer として扱うべきです。

## template の境界

次にある template:

- `asset/bootstrap/template/`

は、bootstrap 単体の内部で閉じて使われることを想定しています。

他の framework layer や、通常の application-side template flow から再利用されることは想定していません。

つまり、これらの template は bootstrap-internal asset です。

## 運用上の意味

`asset/bootstrap/` を扱うときは、次を前提にするのが安全です。

- bootstrap template は bootstrap 専用である
- bootstrap code は、bootstrap 自身の中で availability が確立される前に、通常の OP-CORE 機能が使えると仮定しない

これにより、startup layer を isolated に保ち、pre-core 段階へ通常の framework 前提が漏れ込むことを防げます。

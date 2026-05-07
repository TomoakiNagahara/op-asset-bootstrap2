# Bootstrap As-Is

## 概要

この文書は、次の current 実装を説明します。

- `asset/bootstrap/index.php`

bootstrap layer は、通常の application flow が始まる前に framework を使える状態にする責務を持ちます。

これは pre-app-unit の startup 段階に属します。

## 主な責務

current の bootstrap entry 自体は、広い application logic を持ちません。

実務上の役割は次です。

- 必要な startup file を固定順で include する
- 必須 file が欠けていれば即座に startup を止める
- include された startup step が throw したら即座に startup を止める

## current の include 順

current 実装は、次の固定 list を順に処理します。

1. `core/Bootstrap.php`
2. `config/op.php`
3. `config/php.php`
4. `bootstrap/include/php.php`
5. `bootstrap/include/root.php`
6. `bootstrap/include/appid.php`
7. `bootstrap/include/admin.php`
8. `bootstrap/include/rewrite.php`
9. `bootstrap/include/session.php`

full path は次で組み立てられます。

- `dirname(__DIR__) . '/' . $file`

つまり bootstrap entry は `asset/` を固定 base として使っています。

## include の仕方

各対象 file は closure の中で include されます。

```php
call_user_func(function($file){
    include($file);
}, $file);
```

current の実務的意味は次です。

- 各 startup file は限定された include scope で実行される
- bootstrap 自体は全体の順序制御を保持する

## file 不足時の挙動

必須 file が存在しない場合:

- bootstrap は `_ROOT_OP_` が既に定義されているか確認する
- 定義済みなら、`_ROOT_OP_` prefix を `OP:/` に置換した message を作る
- その後 exception を throw する

つまり、bootstrap file の欠落は fatal startup error として扱われます。

## failure handling

startup sequence 全体は次で囲まれています。

- `try`
- `catch (\Throwable $e)`

include された startup step のどこかが throw すると:

- HTTP status を `500` にする
- `Bootstrap: ...` を出力する
- stack trace を出力する
- `exit(__LINE__)` で終了する

つまり bootstrap failure は、通常の App unit control に入る前に、bootstrap 自身の中で処理されます。

## include される startup step

### `bootstrap/include/php.php`

current の役割:

- `mbstring` や `openssl` のような必須 PHP extension を確認する
- 利用できなければ即終了する

### `bootstrap/include/root.php`

current の役割:

- `RootPath.php` を読み込む
- `real`, `op`, `git`, `doc`, `app`, `asset`, `core`, `unit` などの root label を登録する

### `bootstrap/include/appid.php`

current の役割:

- app config に `_APP_ID_` が既にあるか確認する
- 無ければ bootstrap 側 guidance template を描画する

### `bootstrap/include/admin.php`

current の役割:

- CI mode では fallback admin config を注入する
- それ以外では admin config の有無を確認する
- 無ければ bootstrap 側 guidance template を描画する

### `bootstrap/include/rewrite.php`

current の役割:

- 既に `app.php` 経由なら skip する
- built-in server なら skip する
- CI なら skip する
- それ以外では current PHP SAPI の互換性を確認し、必要なら bootstrap 側 guidance を描画する

### `bootstrap/include/session.php`

current の役割:

- CLI なら skip する
- session が既に存在すれば skip する
- それ以外では session を開始する
- session 開始に失敗したら即終了する

## 境界の意味

この file は startup orchestrator として理解するべきです。

ここは通常の:

- page-level rendering logic
- reusable application template
- post-startup business flow

を置く場所ではありません。

それらの関心事は、framework lifecycle のもっと後段に属します。

## まとめ

current の `asset/bootstrap/index.php` は:

- 固定順の startup loader
- startup failure の fatal-error boundary
- `app.php` と後段の App-unit-driven application flow を繋ぐ橋渡し

です。

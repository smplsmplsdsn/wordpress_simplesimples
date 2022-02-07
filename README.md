smplsmpls

# メモ（テンプレ流用時の注意）

## ドメインを修正する
functions/index.php

## manifestを用意する
assets/manifest/mainifest.json
assets/manifest/mainifest-192.json
assets/manifest/mainifest-256.json
assets/manifest/mainifest-512.json

## ogpとfaviconを用意する
assets/ogp.png
assets/favicon.png
assets/favicon.ico

## title と description、canonical を修正し、jQueryのバージョンが最新か確認する
home.php titleとcanonical

## GTM もしくは GA のタグを発行して貼り付ける（$is_honban で本番のみに表示するようif文を追加する）
include/google.php 作成

## WordPressメールの宛名を変更する
functions/admin/mp_mail_name.php

# WordPressプラグイン

- Admin Menu Editor
- Adminimize
- Advanced Custom Fields
- AMP
- Category Order and Taxonomy Terms Order
- Contact Form 7
- Custom Post Type UI
- No Category Base (WPML)
- Really Simple CSV Importer
- Search Regex
- Simple Page Ordering
- SiteGuard WP Plugin
- TinyPNG - JPEG, PNG & WebP image compression
- WordPress Popular Posts

# ほか

## サムネイル画像（記事リストに使用する）
assets/thumbnail/_noimage.png

## JSのファイル読み込み時の処理確認
_build/src/js/last.js

## fontがある場合の処理
_build/src/sass/setting/font.scss

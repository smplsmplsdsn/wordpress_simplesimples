# WordPressオリジナルテーマ
このリポジトリは、https://simplesimples.com で利用しているWordPressテーマです。

| タイプ | 特徴 | サンプルURL |
| :--- | :--- | :--- |
| STANDARD | トップ、事業概要、制作実績、お問い合わせ など固定ページで構成される事業概要ページ | https://simplesimples.com |
| POST | Web制作や映像制作に関する記事ページ | https://simplesimples.com/web/. https://simplesimples.com/video/ |
| BLOG | 写真、エッセイ、詩 | https://simplesimples.com/blog/ |
| MOVIEREVIEW | 映画レビュー | https://simplesimples.com/moviereview/ |
| API | 単体で機能するAPI | https://simplesimples.com/api/?class=lifequotes |
| EVENT | 単発ページ(イベントの一つ) | https://simplesimples.com/?event=otonanoaoharuten |
| MULELESWORLD | 単発ページ(特集の一つ) | https://simplesimples.com/?special=mulelesworld |
| SONY | 単発ページ(特集の一つ) | https://simplesimples.com/?special=sonyalpha |


 - 映画レビューはブログの中に位置付けしているが、映画レビューだけ切り出しできるようにするため、タイプを分けている
 - API　は特定のタイプでしか機能しない場合は、そのタイプとしてコミットするが、単独で機能するAPIはタイプとしてコミットする
 - 単発ページが増えるごとに新タイプが追加されるが、2022年2月8日以降に作成する分はここには記載しない
 - 単発ページは、home.php にてGetパラメータによる分岐処理を行っている
 - 単発ページは、POSTの延長で作られた場合、タイプ「POST」としてコミットする場合がある

# テンプレを流用する
プログラムコードは許可なくご自由にご利用いただいて全く問題ありません。<br>
ただし、コンテンツ内の**文書・テキストや画像を公開することは禁止**とさせていただきます(ご自身で用意するテキストや画像に差し替えてください)。<br>
<br>
下記、転用方法です。

## 1. はじめに

- 「root」タグをチェックアウトする
- 流用したいカテゴリと共通のコミットをチェリーピックする


## 2. ドメインを修正する

- functions/index.php

## 3. manifestを用意して、差し替える

- assets/manifest/mainifest.json
- assets/manifest/mainifest-192.json
- assets/manifest/mainifest-256.json
- assets/manifest/mainifest-512.json

## 4. ogpとfaviconを用意して、差し替える

- assets/ogp.png
- assets/favicon.png
- assets/favicon.ico

## 5. title と description、canonical を修正し、jQueryのバージョンが最新か確認する

- home.php titleとcanonical

## 6. GTM もしくは GA のタグを発行して貼り付ける
$is_honban で本番のみに表示するようif文を追加する

- include/google.php 作成

## 7. WordPressメールの宛名を変更する

- functions/admin/mp_mail_name.php

## 8. WordPressプラグイン
このテーマで利用しているプラグイン一覧です
(AMPは調整中で2022.2.8現在、使っていません)

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

## 9. サムネイル画像（記事リストに使用する）

- assets/thumbnail/_noimage.png

## 10. JSのファイル読み込み時の処理確認

- _build/src/js/last.js

## 11. fontがある場合の処理

- _build/src/sass/setting/font.scss

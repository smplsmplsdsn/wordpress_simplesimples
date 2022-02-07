<?php
/**
 * メールアドレスの差出人名を変更する
 * https://mirai-creators.com/10496/
 */
function mp_mail_name($email_from) {
  return 'シンプルシンプルデザイン運営事務局';
}
add_filter('wp_mail_from_name', 'mp_mail_name');
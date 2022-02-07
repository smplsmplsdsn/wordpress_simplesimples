<?php
/** 
 * ログイン時、ユーザー名ではなくメールアドレスのみを有効にする
 */
function mp_email_login($user, $username, $password) {
  
  // ユーザ情報を'email'を対象に検索
  $user = get_user_by('email', $username);
 
  // ユーザ情報が存在する場合
  if(!empty($user -> user_login)) {
    
    // ユーザ名を取得しセットする
    $username = $user -> user_login;
  } else {
    
    // メールアドレスに該当するユーザが存在しない場合は強制的に空文字
    $username = 'ありえない文字列';  // 認証失敗にする
  }
  
  // ログイン認証の判定結果を返す
  return wp_authenticate_username_password(null, $username, $password);
}
add_filter('authenticate', 'mp_email_login', 20, 3);

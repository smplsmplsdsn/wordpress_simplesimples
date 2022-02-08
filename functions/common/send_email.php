<?php
/**
 * メール送信
 * 注意事項
 * ・ローカル環境では確認できない（別途設定が必要）
 * ・gmail を from に設定できない
 *
 * @param {string} $to 宛先のメアド
 * @param {string} $subject タイトル
 * @param {string} $message 本文
 * @param {string} $from 差出人のメアド
 * @param {string} $from_name 差出人の表示名
 * @param {string} $additional_parameter MTAへ渡すコマンドライン引数
 * @return {boolean} メール送信が成功したかどうか
 */
function send_email($to, $subject, $message, $from = NULL, $from_name = NULL, $additional_parameter = NULL) {
	mb_language("Japanese");

	// 内部エンコーディング取得
	$org_encode = mb_internal_encoding();

	// 内部エンコーディングを文字列のエンコードに変換
	mb_internal_encoding("UTF-8");

	$additional_headers = "From:".mb_encode_mimeheader($from_name)."<".$from.">";  

	// mb_encode_mimeheader("川","ISO-2022-JP","AUTO")  
	$is_sendmail = mb_send_mail($to, $subject, $message, $additional_headers, $additional_parameter);

	// 内部エンコーディングを元に戻す
	mb_internal_encoding($org_encode);

	return $is_sendmail;
}
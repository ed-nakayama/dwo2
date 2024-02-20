<?php

return [
		'ORDER_HDR'            => env('ORDER_HDR', ''),
		'ORDER_DTL'            => env('ORDER_DTL', ''),
		'DWO_ORICON_ID'        => env('DWO_ORICON_ID', ''),
		'DWO_TM_ID'            => env('DWO_TM_ID', ''),
		'APPLICATION_LOG_FILE' => env('APPLICATION_LOG_FILE', ''),
		'APPLICATION_ROOT'     => env('APPLICATION_ROOT', ''),

		# ファイルダウンロードURL
		'ZIPUPDATE_DL_URL'               => env('ZIPUPDATE_DL_URL', ''),
		# アップロードファイル名
		'ZIPUPDATE_FILE_NAME'          => env('ZIPUPDATE_FILE_NAME', ''),
		# アップロードファイル
		'ZIPUPDATE_UPLOAD_FILE'          => env('ZIPUPDATE_UPLOAD_FILE', ''),
		# データファイル解凍先
		'ZIPUPDATE_TMP_DIR'              => env('ZIPUPDATE_TMP_DIR', ''),
		# データファイル名
		'ZIPUPDATE_DATA_FILE'            => env('ZIPUPDATE_DATA_FILE', ''),
		# 制御ファイル
		'ZIPUPDATE_CONTROL_FILE'         => env('ZIPUPDATE_CONTROL_FILE', ''),
		# ログファイル
		'ZIPUPDATE_LOG_FILE'             => env('ZIPUPDATE_LOG_FILE', ''),
		# BADファイル
		'ZIPUPDATE_BAD_FILE'             => env('ZIPUPDATE_BAD_FILE', ''),
		# 前回のファイル
		'ZIPUPDATE_LASTTIME_DATA_FILE'   => env('ZIPUPDATE_LASTTIME_DATA_FILE', ''),
		# 前々回ファイル
		'ZIPUPDATE_B_LASTTIME_DATA_FILE' => env('ZIPUPDATE_B_LASTTIME_DATA_FILE', ''),



		# 実行環境が画面表示でわかるようにするための設定（本番環境で設定しても意味はない）
		'APPLICATION_ENV'           => env('APPLICATION_ENV', ''),
		'APPLICATION_ENV_TITLE'     => env('APPLICATION_ENV_TITLE', ''),
		'APPLICATION_ENV_BARCOLOR'  => env('APPLICATION_ENV_BARCOLOR', ''),
		'APPLICATION_ENV_FONTCOLOR' => env('APPLICATION_ENV_FONTCOLOR', ''),

		# スクリプトが停止するような致命的なエラーが発生した場合に、自動的に共通エラー画面に転送するかどうか。
		# 0 : 転送しない
		# 1 : またはその他の有効な値 : 転送する
		'ERROR_FORWARDING' => env('ERROR_FORWARDING', ''),

		# 接続元アドレスによる管理画面の参照制限するかどうか。
		# 0 : しない
		# 1 : またはその他の有効な値 : する
		'ADMIN_ACL'               => env('ADMIN_ACL', ''),
		'ADMIN_ALLOW_REMOTE_ADDR' => env('ADMIN_ALLOW_REMOTE_ADDR', ''),

		# アプリケーションログをファイルに出力する際の、ログレベル
		# Ethnaの規定するログレベルを指定する ==> (/etc/dwo-ini.php)
		'APPLICATION_LOG_LEVEL' => env('APPLICATION_LOG_LEVEL', ''),

		# WEB実行時のホスト情報、アプリケーションのURLルートバス指定（スクリプト内でのURL生成時等に使用）
		'SERVER_NAME'  => env('SERVER_NAME', ''),
		'URL_DOC_ROOT' => env('URL_DOC_ROOT', ''),

		# データベース接続情報（for Oracle）
		'DB_NAME'     => env('DB_SERVICE_NAME', ''),
		'DB_USER'     => env('DB_USERNAME', ''),
		'DB_PASS'     => env('DB_PASSWORD', ''),
		'ORACLE_BIN'  => env('ORACLE_BIN', ''),
		'ORACLE_HOME' => env('ORACLE_HOME', ''),
		'TNS_ADMIN'   => env('TNS_ADMIN', ''),
		'USER_BIN'    => env('USER_BIN', ''),
		'TNS_NAME'    => env('TNS_NAME', ''),


		# メール送信時の送信者、およびシステム管理者、運用者通知メール送信先の指定
		'DWO_ORDER_CENTER_MAIL' => env('DWO_ORDER_CENTER_MAIL', ''),
		'DWO_SYS_MAIL_FROM'     => env('DWO_SYS_MAIL_FROM', ''),
		'DWO_SYS_MAIL_BCC'      => env('DWO_SYS_MAIL_BCC', ''),

		# 与信限度額超過エラーフラグ
		# -1:エラー処理無（金額表示なし）
		#  0:エラー処理無（金額表示あり）
		#  1:エラー処理有(次のページに進ませずにDWO_SYS_MAIL_FROMにメール送信)。
		'CREDIT_LIMIT_ERROR_FLG' => env('CREDIT_LIMIT_ERROR_FLG', ''),

		# 消費税処理設定（および’１４年度の税制改正対応設定）	
		'TAX_MSG_FLAG'     => env('TAX_MSG_FLAG', ''),
		'MSG_START_DATE'   => env('MSG_START_DATE', ''),
		'MSG_END_DATE'     => env('MSG_END_DATE', ''),
		'TAX_URL'          => env('TAX_URL', ''),
		'UPGRADE_TAX_URL'  => env('UPGRADE_TAX_URL', ''),
		'PRODUCT_TAX_URL'  => env('PRODUCT_TAX_URL', ''),
		'DWO_TAX_RATE'     => env('DWO_TAX_RATE', ''),
		'DWO_TAX_RATE_SUP' => env('DWO_TAX_RATE_SUP', ''),

		# 弥生　業務部署情報
		'DWO_COMP_NAME' => env('DWO_COMP_NAME', ''),
		'DWO_UNIT_NAME' => env('DWO_UNIT_NAME', ''),
		'DWO_ZIP'       => env('DWO_ZIP', ''),
		'DWO_ADDRESS'   => env('DWO_ADDRESS', ''),
		'DWO_TEL'       => env('DWO_TEL', ''),
		'DWO_FAX'       => env('DWO_FAX', ''),


];
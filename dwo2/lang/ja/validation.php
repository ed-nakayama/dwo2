<?php

return [

    /* メッセージの内容がご自身のアプリに適さない場合には、必要に応じて修正願います */

    'accepted' => ':attributeを承認してください。',
    'accepted_if' => ':otherが:valueの場合、:attributeを承認してください。',
    'active_url' => ':attributeが有効なURLではありません。',
    'after' => ':attributeには、:dateより後の日付を指定してください。',
    'after_or_equal' => ':attributeには、:date以降の日付を指定してください。',
    'alpha' => ':attributeはアルファベットのみがご利用できます。',
    'alpha_dash' => ':attributeはアルファベットとダッシュ(-)及び下線(_)がご利用できます。',
    'alpha_num' => ':attributeはアルファベット数字がご利用できます。',
    'array' => ':attributeは配列でなくてはなりません。',
    'ascii' => ':attributeは半角の英数字や記号のみで指定してください。',
    'before' => ':attributeには、:dateより前の日付をご利用ください。',
    'before_or_equal' => ':attributeには、:date以前の日付をご利用ください。',
    'between' => [
        'numeric' => ':attributeは、:minから:maxの間で指定してください。',
        'file' => ':attributeは、:min kbから、:max kbの間で指定してください。',
        'string' => ':attributeは、:min文字から、:max文字の間で指定してください。',
        'array' => ':attributeは、:min個から:max個の間で指定してください。',
    ],
    'boolean' => ':attributeは、trueかfalseを指定してください。',
    'confirmed' => ':attributeと確認フィールドが一致していません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attributeには有効な日付を指定してください。',
    'date_equals' => ':attributeには、:dateと同じ日付けを指定してください。',
    'date_format' => ':attributeは:format形式で指定してください。',
    'decimal' => ':attributeは、小数点以下:decimal桁の数字を指定してください。',
    'declined' => ':attributeは、拒否する指定をしてください。',
    'declined_if' => ':attributeは、:otherが:valueの時は、拒否する指定をしてください。',
    'different' => ':attributeと:otherには、異なった内容を指定してください。',
    'digits' => ':attributeは:digits桁で指定してください。',
    'digits_between' => ':attributeは:min桁から:max桁の間で指定してください。',
    'dimensions' => ':attributeの図形サイズが正しくありません。',
    'distinct' => ':attributeには異なった値を指定してください。',
    'doesnt_end_with' => ':attributeは、:values以外の値で終わるように指定してください。',
    'doesnt_start_with' => ':attributeは、:values以外の値で始まるように指定してください。',
    'email' => ':attributeには、有効なメールアドレスを指定してください。',
    'ends_with' => ':attributeには、:valuesのどれかで終わる値を指定してください。',
    'enum' => '選択された:attributeは正しくありません。',
    'exists' => '選択された:attributeは正しくありません。',
    'file' => ':attributeにはファイルを指定してください。',
    'filled' => ':attributeに値を指定してください。',
    'gt' => [
        'numeric' => ':attributeには、:valueより大きな値を指定してください。',
        'file' => ':attributeには、:value kbより大きなファイルを指定してください。',
        'string' => ':attributeは、:value文字より長く指定してください。',
        'array' => ':attributeには、:value個より多くのアイテムを指定してください。',
    ],
    'gte' => [
        'numeric' => ':attributeには、:value以上の値を指定してください。',
        'file' => ':attributeには、:value kb以上のファイルを指定してください。',
        'string' => ':attributeは、:value文字以上で指定してください。',
        'array' => ':attributeには、:value個以上のアイテムを指定してください。',
    ],
    'image' => ':attributeには画像ファイルを指定してください。',
    'in' => '選択された:attributeは正しくありません。',
    'in_array' => ':attributeには:otherの値を指定してください。',
    'integer' => ':attributeは整数で指定してください。',
    'ip' => ':attributeには、有効なIPアドレスを指定してください。',
    'ipv4' => ':attributeには、有効なIPv4アドレスを指定してください。',
    'ipv6' => ':attributeには、有効なIPv6アドレスを指定してください。',
    'json' => ':attributeには、有効なJSON文字列を指定してください。',
    'lowercase' => ':attributeは、小文字のみで指定してください。',
    'lt' => [
        'numeric' => ':attributeには、:valueより小さな値を指定してください。',
        'file' => ':attributeには、:value kbより小さなファイルを指定してください。',
        'string' => ':attributeは、:value文字より短く指定してください。',
        'array' => ':attributeには、:value個より少ないアイテムを指定してください。',
    ],
    'lte' => [
        'numeric' => ':attributeには、:value以下の値を指定してください。',
        'file' => ':attributeには、:value kb以下のファイルを指定してください。',
        'string' => ':attributeは、:value文字以下で指定してください。',
        'array' => ':attributeには、:value個以下のアイテムを指定してください。',
    ],
    'mac_address' => ':attributeには、有効なMACアドレスを指定してください。',
    'max' => [
        'numeric' => ':attributeには、:max以下の数字を指定してください。',
        'file' => ':attributeには、:max kb以下のファイルを指定してください。',
        'string' => ':attributeは、:max文字以下で指定してください。',
        'array' => ':attributeは:max個以下指定してください。',
    ],
    'max_digits' => ':attributeは、:max桁以下で指定してください。',
    'mimes' => ':attributeには:valuesタイプのファイルを指定してください。',
    'mimetypes' => ':attributeには:valuesタイプのファイルを指定してください。',
    'min' => [
        'numeric' => ':attributeには、:min以上の数字を指定してください。',
        'file' => ':attributeには、:min kb以上のファイルを指定してください。',
        'string' => ':attributeは、:min文字以上で指定してください。',
        'array' => ':attributeは:min個以上指定してください。',
    ],
    'min_digits' => ':attributeは、:min桁以上で指定してください。',
    'missing' => ':attributeは存在してはいけません。',
    'missing_if' => ':otherが:valueの場合、:attributeは存在してはいけません。',
    'missing_unless' => ':otherが:valueでない場合、:attributeは存在してはいけません。',
    'missing_with' => ':valuesを指定する場合は、:attributeは存在してはいけません。 ',
    'missing_with_all' => ':valuesを指定する場合は、:attributeは存在してはいけません。 ',
    'multiple_of' => ':attributeには、:valueの倍数を指定してください。',
    'not_in' => '選択された:attributeは正しくありません。',
    'not_regex' => ':attributeの形式が正しくありません。',
    'numeric' => ':attributeには、数字を指定してください。',
    'password' => [
        'letters' => ':attributeは、最低1文字以上の文字を含めてください。',
        'mixed' => ':attributeは、最低1文字以上の大文字と小文字をそれぞれ含めてください。',
        'numbers' => ':attributeは、最低1文字以上の数字を含めてください。',
        'symbols' => ':attributeは、最低1文字以上の記号を含めてください。',
        'uncompromised' => '指定の:attributeは、漏洩している恐れがあります。他の:attributeを指定してください。',
    ],
    'present' => ':attributeが存在していません。',
    'prohibited' => ':attributeは入力禁止です。',
    'prohibited_if' => ':otherが:valueの場合、:attributeは入力禁止です。',
    'prohibited_unless' => ':otherが:valueでない場合、:attributeは入力禁止です。',
    'prohibits' => 'attributeは:otherの入力を禁じています。',
    'regex' => ':attributeに正しい形式を指定してください。',
    'required' => ':attributeは必ず指定してください。',
    'required_array_keys' => ':attributeは、:valuesの項目を含めてください。',
    'required_if' => ':otherが:valueの場合、:attributeも指定してください。',
    'required_if_accepted' => ':attributeは、:otherが承認された場合は、必ず指定してください。',
    'required_unless' => ':otherが:valuesでない場合、:attributeを指定してください。',
    'required_with' => ':valuesを指定する場合は、:attributeも指定してください。',
    'required_with_all' => ':valuesを指定する場合は、:attributeも指定してください。',
    'required_without' => ':valuesを指定しない場合は、:attributeを指定してください。',
    'required_without_all' => ':valuesのどれも指定しない場合は、:attributeを指定してください。',
    'same' => ':attributeと:otherには同じ値を指定してください。',
    'size' => [
        'numeric' => ':attributeは:sizeを指定してください。',
        'file' => ':attributeのファイルは、:size kbでなくてはなりません。',
        'string' => ':attributeは:size文字で指定してください。',
        'array' => ':attributeは:size個指定してください。',
    ],
    'starts_with' => ':attributeには、:valuesのどれかで始まる値を指定してください。',
    'string' => ':attributeは文字列を指定してください。',
    'timezone' => ':attributeには、有効なゾーンを指定してください。',
    'unique' => ':attributeの値は既に存在しています。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'uppercase' => ':attributeは、大文字のみで指定してください。',
    'url' => ':attributeに正しい形式を指定してください。',
    'ulid' => ':attributeに有効なULIDを指定してください。',
    'uuid' => ':attributeに有効なUUIDを指定してください。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        '属性名' => [
            'ルール名' => 'カスタムメッセージ',
        ],
        'terms' => [
            'required' => '登録には規約への同意が必須となります。',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'address' => '住所',
        'age' => '歳',
        'amount' => '額',
        'area' => 'エリア',
        'available' => '利用可能',
        'birthday' => '誕生日',
        'body' => '本文',
        'city' => '市',
        'content' => 'コンテンツ',
        'country' => '国',
        'created_at' => '作成日',
        'creator' => '作成者',
        'current_password' => '現在のパスワード',
        'date' => '日付',
        'date_of_birth' => '生年月日',
        'day' => '日',
        'deleted_at' => '削除日',
        'description' => '説明',
        'district' => '地区',
        'duration' => '期間',
        'email' => 'メールアドレス',
        'excerpt' => '抜粋',
        'filter' => 'フィルタ',
        'first_name' => '名',
        'gender' => '性別',
        'group' => 'グループ',
        'hour' => '時間',
        'image' => '画像',
        'last_name' => '姓',
        'lesson' => 'レッスン',
        'line_address_1' => '回線アドレス1',
        'line_address_2' => '回線アドレス2',
        'message' => 'メッセージ',
        'middle_name' => 'ミドルネーム',
        'minute' => '分',
        'mobile' => '携帯',
        'month' => '月',
        'name' => '名前',
        'national_code' => '国コード',
        'number' => '番号',
//        'password' => 'パスワード',
        'password_confirmation' => '確認用パスワード',
        'phone' => '電話番号',
        'photo' => '写真',
        'postal_code' => '郵便番号',
        'prefecture' => '都道府県',
        'price' => '価格',
        'province' => '都道府県',
        'recaptcha_response_field' => 'recaptcha応答フィールド',
        'remember' => '記憶',
        'restored_at' => 'で復元',
        'result_text_under_image' => '画像の下の結果テキスト',
        'role' => '役割',
        'second' => '秒',
        'sex' => '性別',
        'short_text' => '短いテキスト',
        'size' => 'サイズ',
        'state' => '状態',
        'street' => '街',
        'student' => '学生',
        'subject' => '課題',
        'teacher' => '先生',
        'terms' => '利用規約',
        'test_description' => 'テスト内容',
        'test_locale' => 'テストロケール',
        'test_name' => 'テスト名',
        'text' => 'テキスト',
        'time' => '時間',
        'title' => 'タイトル',
        'updated_at' => '更新日',
        'username' => 'ユーザー名',
        'year' => '年',

		/* DWO 商品マスタ */
        'sample_price' => '通常製品参考価格',
        'start_date' => '販売開始日',
        'end_date' => '販売終了日',
        'stock_status' => '在庫状況',
        'ship_date' => '出荷可能日',

        'pass1' => 'パスワード1の新しいパスワード',
        'pass2' => 'パスワード2の新しいパスワード',
        'password' => 'パスワード',
        
        
        'operator_id' => 'オペレータID',
        'password1' => 'パスワード1',
        'password2' => 'パスワード2',
        'new_id' => 'ID',
        'name_roman' => '名前（ローマ字）',
        'new_password' => 'パスワード',
        'new_password1' => 'パスワード1',
        'new_password2' => 'パスワード2',
        'new_name' => '名前',
        'name_roman' => '名前（ローマ字）',

        'profile_cust_code' => 'ログインID',

        'new_id' => 'ID',
        'new_code' => 'コード',
        'new_name' => '名称',

        'search_prod_code' => '商品コード',
        'search_cust_code' => '得意先コード',
        'search_tel' => '電話番号',

        'prodCode' => '商品コード',

        'extra_mail' => '追加メールアドレス',

        'idList.*' => 'ID',
        'nameList.*' => '名前',
        'destList.*' => '納品先名称',
        'custList.*' => '得意先コード',
        'seqList.*' => 'シーケンスID',

        'orderPersonName' => '発注担当者',
        'destName1' => '納品先 名称',
        'destPost' => '納品先 郵便番号',
        'destAddress1' => '納品先 住所1',
        'destAddress2' => '納品先 住所2',
        'destAddress3' => '納品先 住所3',
        'destContactName1' => '納品先 担当者',
        'destTel' => '納品先 電話番号',
        'destFax' => '納品先 FAX番号',

        'new_mail_addr' => 'メールアドレス',


        'frm_regist_name' => '登録名義',
        'frm_regist_kana' => '登録名義(カタカナ)',
        'frm_regist_mail' => 'メールアドレス',
        'frm_regist_zip1' => '郵便番号',
        'frm_regist_zip2' => '郵便番号',
        'frm_regist_pref_cd' => '都道府県',
        'name="frm_regist_add1' => '市区町村',
        'name="frm_regist_add2' => '丁番地',
        'frm_regist_contact_tel1' => '連絡先電話番号',
        'frm_regist_contact_tel2' => '連絡先電話番号',
        'frm_regist_contact_tel3' => '連絡先電話番号',

		// ID 忘れ
        'frm_cust_tel' => 'ご登録の電話番号',
        'frm_cust_mail' => 'ご登録のE-Mail',

        'test_datetime' => 'テスト日付',

        'current-password' => '古いパスワード',
        'new-password' => '新しいパスワード',
        'new-password_confirmation' => '新しいパスワード(確認)',

        'mail' => 'メールアドレス',


        'orderNum'          => '受付No.',
		'orderLineNum.*'    => 'No.',
		'custOrderNum.*'    => '貴社発注No.',
		'itemCd.*'          => '商品コード',
		'itemPrice.*'       => 'ご提供価格',
		'itemVol.*'         => '数量',
		'itemAmt.*'         => '金額',
		'itemTaxRate.*'     => '消費税率',
		'itemTax.*'         => '消費税',


		'frm_zip1'             => '納品先郵便番号1',

		'reg_delivery_name'    => '納品先名称',
		'reg_delivery_zip1'    => '納品先郵便番号1',
		'reg_delivery_zip2'    => '納品先郵便番号2',
		'reg_delivery_pref_cd' => '納品先住所(都道府県)',
		'reg_delivery_add1'    => '納品先住所(市区町村)',
		'reg_delivery_add2'    => '納品先住所(番地)',
		'reg_delivery_tel1'    => '納品先電話番号1',
		'reg_delivery_tel2'    => '納品先電話番号2',
		'reg_delivery_tel3'    => '納品先電話番号3',

		'frm_cust_id'    => 'ログインID',
		'new_mail'    => 'E-Mail',
		'new_tel'     => '内線番号',
		'telList.*'     => '内線番号',
		'mailList.*'     => 'E-Mail',

		'frm_from_date'     => '受付日(From)',
		'frm_to_date'     => '受付日(To)',

    ],

];

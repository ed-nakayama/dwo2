＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
{{ $agentView->name1 . $agentView->name2 }}
{{ $orderInfo->order_tantou_name }}様

この度は弥生Webオーダーをご利用頂き、誠にありがとうございます。
ご予約いただきました製品は出荷可能日になりましたら、出荷手配をさせていただきます。
出荷可能日につきましては、下記をご参照下さい。

今回のご注文の内容です。
ご注文受付日　：{{ substr($weborderheader->order_date,0,4) }}年{{ substr($weborderheader->order_date,5,2) }}月{{ substr($weborderheader->order_date,8,2) }}日
出荷可能日　　：{{ substr($weborderheader->ship_date,0,4) }}年{{ substr($weborderheader->ship_date,5,2) }}月{{ substr($weborderheader->ship_date,8,2) }}日
ご注文受付番号：{{ $weborderheader->web_order_num }}
--------------------------------------------------------------------
@foreach ($basketList as $basket)
貴社発注No　　：{{ $basket->cust_order_num }}
商品コード　　：{{ $basket->product_code }}
商品名　　　　：{{ $basket->item_name_kanji }}
ご注文数量　　：{{ $basket->count }}
ご提供価格　　：￥{{ number_format($basket->price_invoice_price) }}
金額　　　　　：￥{{ number_format( $basket->price_invoice_price * $basket->count) }}
@if (!empty($basket->tax_rate) )消費税率　　　：{{ $basket->tax_rate * 100 }}%@endif 

@endforeach
--------------------------------------------------------------------
　　　小計　：￥{{ number_format($weborderheader->order_amt) }}
　　消費税　：￥{{ number_format($weborderheader->tax) }}
　合計金額　：￥{{ number_format($weborderheader->total_amt) }}
--------------------------------------------------------------------
@include ('weborder/common/tax10_comment_mail')

商品納品先
納品先名称　　：{{ $orderInfo->delivery_name }}
納品先郵便番号：{{ $orderInfo->delivery_zip }}
納品先住所　　：{{ $orderInfo->delivery_pref }}{{ $orderInfo->delivery_add1 }}{{ $orderInfo->delivery_add2 }}{{ $orderInfo->delivery_add3 }}
納品先担当者名：{{ $orderInfo->delivery_name_of_charge}　様
納品先電話番号：{{ $orderInfo->delivery_tel1 }}-{{ $orderInfo->delivery_tel2 }}-{{ $orderInfo->delivery_tel3 }}
--------------------------------------------------------------------
伝票送付先 [納品書][請求書]
送付先名称　：{{ $agentView->name1 . $agentView->name2 }}
送付先郵便番号：{{ $agentView->post }}
送付先住所　　：{{ $agentView->pref}}{{ $agentView->address1 }}{{ $agentView->address2 }}{{ $agentView->address3 }}
送付先担当者名：{{ $agentView->contact_name1 }}　様
送付先電話番号：{{ $agentView->tel }}
--------------------------------------------------------------------
運賃　　　　　　：当社負担
サプライ二重梱包：
@if ($orderInfo->double_package_type == "1")
有
@else
無
@endif
--------------------------------------------------------------------
■お問い合わせ先■
{{ config('dwo.DWO_COMP_NAME') }} {{ config('dwo.DWO_UNIT_NAME') }}
TEL    ： {{ config('dwo.DWO_TEL') }}
FAX    ： {{ config('dwo.DWO_FAX') }}
E-MAIL ： {{ config('dwo.DWO_ORDER_CENTER_MAIL') }}
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

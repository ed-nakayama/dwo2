＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
{{ $agentView->name1 . $agentView->name2 }}
{{ $weborderheader['dwo_order_person_name'] }}様

この度は弥生Webオーダーをご利用頂き、誠にありがとうございます。

以下のご注文はご購入のお客様（ユーザー登録のお客様）に「個人情報保護方針」について承認頂き、
予約受付が完了いたしましたのでお知らせいたします。
出荷可能日になりましたら出荷手配をさせていただきます。
出荷可能日につきましては、下記をご参照下さい。

※承認状況はこちらでご確認できます。
{{ url('') }}{{ config('dwo.URL_DOC_ROOT') }}

※製品のみご注文頂きますと、後日お客様に直接「あんしん保守サポート申込書」が送付されます。

今回のご注文の内容です。
ご注文受付日　：{{ substr($acceptance['order_acceptance_order_date'],0,4) }}年{{ substr($acceptance['order_acceptance_order_date'],5,2) }}月{{ substr($acceptance['order_acceptance_order_date'],8,2) }}日
出荷可能日　　：{{ substr($weborderheader->shipping_date,0,4) }}年{{ substr($weborderheader->shipping_date,5,2) }}月{{ substr($weborderheader->shipping_date,8,2) }}日
ご注文受付番号：{{ $acceptance['order_acceptance_header_no'] }}
--------------------------------------------------------------------
@foreach ($weborderdetailList as $detaillist)
貴社発注No　　：{{ $detaillist['remarks'] }}
商品コード　　：{{ $detaillist['item_cd'] }}
商品名　　　　：{{ $detaillist['item_name_kanji'] }}
ご注文数量　　：{{ $detaillist['item_vol'] }}
ご提供価格　　：￥{{ number_format($detaillist['item_price']) }}
金額　　　　　：￥{{ number_format($detaillist['item_amt']) }}
@if (!empty($detaillist['tax_rate']) )消費税率　　　：{{ $detaillist['tax_rate'] * 100 }}@endif 

@endforeach
--------------------------------------------------------------------
　　　小計　：￥{{ number_format($weborderheader['order_amt']) }}
　　消費税　：￥{{ number_format($weborderheader['tax']) }}
　合計金額　：￥{{ number_format($weborderheader['total_amt']) }}
--------------------------------------------------------------------
@include ('weborder/common/tax10_comment_mail')

商品納品先
納品先名称　　：{{ $weborderheader['dest_name1'] . $weborderheader['dest_name2'] }}
納品先郵便番号：{{ $weborderheader['dest_post'] }}
納品先住所　　：@foreach ($prefList as $kenlist)@if($weborderheader['dest_pref_cd'] == $kenlist-> pref_cd){{ $kenlist->pref_name }}@endif @endforeach{{ $weborderheader['dest_address1'] . $weborderheader['dest_address2'] . $weborderheader['dest_address3'] }}
納品先担当者名：{{ $weborderheader['dest_contact_name1'] }}　様
納品先電話番号：{{ $weborderheader['dest_tel'] }}
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
@if ($weborderheader['double_package_type'] == "1")
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

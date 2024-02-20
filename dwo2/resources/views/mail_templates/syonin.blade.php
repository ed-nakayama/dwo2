＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
{{ $weborderheader->name1 }}
{{ $weborderheader->contact_name1 }}様

{{ $agentview->name }}　{{ $weborderheader->dwo_order_person_name }}　様より下記ご注文を承りました。

ご注文受付日　：{{ substr($orderacceptance->order_acceptance_order_date,0,4) }}年{{ substr($orderacceptance->order_acceptance_order_date,5,2) }}月{{ substr($orderacceptance->order_acceptance_order_date,8,2) }}日
ご注文受付番号：{{ $weborderheader->web_order_num }}
--------------------------------------------------------------------
@foreach ($weborderdetailList as $detaillist)
貴社発注No　　：{{ $detaillist->remarks }}
商品コード　　：{{ $detaillist->item_cd }}
商品名　　　　：{{ $detaillist->item_name_kanji }}
ご注文数量　　：{{ $detaillist->item_vol }}

@endforeach

◆承認期限：{{ substr($ago2week,0,4) }}年{{ substr($ago2week,5,2) }}月{{ substr($ago2week,8,2) }}日 @if ($upgrade_flag == "1")15時 @endif

下記URLより「個人情報保護方針」についてご確認のうえ、承認の場合は「承認」ボタンをクリックしてください。
{{ url('') }}{{ config('dwo.URL_DOC_ROOT') }}recognize/top?id={{ $orderacceptance->order_acceptance_seq }}&aid={{ $orderacceptance->order_acceptance_id }}


※「否認」をクリックした場合および承認期限が切れた場合は、商品の注文ならびにユーザー登録情報は削除されます。


--------------------------------------------------------------------
■お問い合わせ先■
{{ config('dwo.DWO_COMP_NAME') }} {{ config('dwo.DWO_UNIT_NAME') }}
TEL    ： {{ config('dwo.DWO_TEL') }}
FAX    ： {{ config('dwo.DWO_FAX') }}
E-MAIL ： {{ config('dwo.DWO_ORDER_CENTER_MAIL') }}
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

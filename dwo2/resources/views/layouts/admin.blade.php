<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
	    <link href="{{ asset('assets/admin/css/style0.css') }}" rel="stylesheet">

        @vite(['resources/js/app.js'])

</HEAD>

<BODY bgcolor="#FFFFFF">


<TABLE border=0>
<tr>
	<td>
	@if ( config('dwo.APPLICATION_ENV') != 'PRODUCTION')
		<center>
		<div style="background-color:{{ config('dwo.APPLICATION_ENV_BARCOLOR') }};color:{{ config('dwo.APPLICATION_ENV_FONTCOLOR')  }};font-weight:bolder">
			{{ config('dwo.APPLICATION_ENV_TITLE') }} 今日の日付：{{ date('Y年m月d日') }}
		</div>
		</center>
	@endif
	</td>
</tr>
<tr>
	<td>
	<TABLE border=1>
	  <TR>
	    <TD nowrap colspan="5" align="left" valign="top" bgcolor="#ffff6a">　オペレーターID：{{ Auth::user()->operator_id }}　{{ Auth::user()->operator_name }}</TD>
	 	<td  bgcolor="#ffff6a">
	    	<a href="/admin/password/edit"">パスワード変更</a>
	 	</td>
	 	<td  bgcolor="#ffff6a">
			<form method="POST" action="{{ route('admin.logout') }}">
				@csrf

				<x-responsive-nav-link :href="route('admin.logout')"
					onclick="event.preventDefault();
					this.closest('form').submit();">
				{{ __('Log Out') }}
				</x-responsive-nav-link>
			</form>
	 	</td>
	  </TR>
	  <TR>
	    <TD><A href="/admin/product/list">商品サブマスタ</A></td>
	    <TD><A href="/admin/product/big">商品大分類マスタ</A></td>
	    <TD><A href="/admin/product/middle">商品中分類マスタ</A></td>
	    <TD><A href="/admin/product/category/list">商品分類登録マスタ</A></td>
	    <TD><A href="/admin/product/status">商品ステータスマスタ</A></td>
	    <TD><A href="/admin/batch/conf">バッチ設定</A></td>
	    <TD><A href="/admin/info">お知らせ</A></td>
	  </TR>
	  <TR>
	    <TD><A href="/admin/cust/list">得意先サブマスタ</A></td>
	    <TD><A href="/admin/operator/detail">管理ユーザマスタ</A></td>
	    <TD><A href="/admin/order/delivery/list">納品先マスタ</A></td>
	    <TD><A href="/admin/order/list">受付状況確認</A></td>
	    <TD><A href="/admin/order/search/history">受注履歴照会</A></td>
	    <TD><A href="/admin/order/status">受注ステータスマスタ</A></td>
	    <TD><A href="/admin/test/shipping/form">テスト</A></td>
	  </TR>
	  <TR>
	    <TD><A href="/admin/order/list2">受付編集</A></td>
	    <td><a href="/admin/zipdata/update/form">郵便番号辞書更新</a></td>
	  </TR>
	</TABLE>
	</td>
</tr>
<tr>
	<td>
		<br>
		{{ $slot }}
	</td>
</tr>
</TABLE>
</BODY>
</HTML>

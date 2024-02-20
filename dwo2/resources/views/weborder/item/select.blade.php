<x-app-layout>

<title>商品選択</title>

<x-slot name="menu">
	{!! App\Http\Controllers\Weborder\MenuManager::setMenu('itemselect') !!}
</x-slot>

<script type="text/javascript">
<!--
	function keyStrSearch() {

		var emptycnt=0;
		for(ii=0; ii<5; ++ii){
			if (document.frm.elements['frm_prod_code[]'][ii].value=="") {
				emptycnt=emptycnt+1;
			}
		}
		if ((emptycnt==5) && (document.frm.frm_prod_name.value=="")) {
			alert("商品コード、または商品名を入力して下さい。");
			return;
		}

		document.frm.frm_bigcode.value = "";
		document.frm.frm_midcode.value = "";
		document.frm.frm_salesstop.value = "";
		document.frm.frm_search_exec.value = "on";
		document.frm.submit();
	}

	function groupSearch(salesstop, cat_name) {
		selbox = document.getElementsByName(cat_name);
		selary = selbox[0].value.split(",");

		document.frm.frm_bigcode.value = selary[0];
		document.frm.frm_midcode.value = selary[1];
		document.frm.frm_salesstop.value = salesstop;
		document.frm.frm_search_exec.value = "on";
		document.frm.submit();
	}
-->
</script>


<div id="menu_userinfo">
<table border="0">
	<tr>
		<td class="userinfo" rowspan="3" valign="top">
			@include ('weborder/common/userinfo')
		</td>
		<td>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td valign="top">
						<p class="sidebar">買い物かご</p>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<iframe src="/common/shoppingcart" marginheight="4" marginwidth="2" width="385px"height="100px"frameborder="0"></iframe>
					</td>
				<tr>
			</table>
		</td>
	</tr>
</table>
</div>

<br /><table width="700px">
	<tr>
		<td>
		<h4>▼商品選択</h4>
		</td>
	</tr>
</table>

{{ html()->form('POST', '/item/detail')->attribute('name' , 'frm')->open() }}
{{ html()->hidden('frm_bigcode') }}
{{ html()->hidden('frm_midcode') }}
{{ html()->hidden('frm_salesstop') }}
{{ html()->hidden('frm_search_exec') }}

<table border="0" width="530px">
	<tr>
		<td class="search">
		▼商品を検索する
		</td>
	</tr>
	<tr>
		<td>
			<span id="essential">※</span>商品を検索する場合は最大5商品まで選択可能です。<br />
			<span id="essential">※</span>商品コード検索は，半角大文字で正しく入力しないと該当商品が表示されません。<br />
			<span id="essential">※</span>商品名の検索は「弥生会計」等のあいまい検索が可能です。
		</td>
	</tr>
	<tr>
		<td align="center">
			<table border="0">
				<tr>
					<td>
						<table class="item_search" border="1" cellspacing="0" frame="hsides" rules="none">
							<tr>
								<td class="item">商品コード検索</td>
								<td>&nbsp;&nbsp;
									{{ html()->text('frm_prod_code[]')->attributes(['size' => '10', 'maxlength' => '15']) }}&nbsp;
									{{ html()->text('frm_prod_code[]')->attributes(['size' => '10', 'maxlength' => '15']) }}&nbsp;
									{{ html()->text('frm_prod_code[]')->attributes(['size' => '10', 'maxlength' => '15']) }}&nbsp;
									{{ html()->text('frm_prod_code[]')->attributes(['size' => '10', 'maxlength' => '15']) }}&nbsp;
									{{ html()->text('frm_prod_code[]')->attributes(['size' => '10', 'maxlength' => '15']) }}&nbsp;
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table class="item_search" border="1" cellspacing="0" frame="hsides" rules="none">
							<tr>
								<td class="item" width="77px">商品名検索</td>
								<td>&nbsp;&nbsp;&nbsp;
									{{ html()->text('frm_prod_name')->attributes(['size' => '40', 'maxlength' => '50']) }}
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center">
					<br /><a href="javascript:keyStrSearch();"><img src="{{ asset('assets/cust/img/search.png') }}"></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
{{ html()->form()->close() }}


<table width="530px">
	<tr>
		<td class="search">
			▼商品を選択して下さい
		</td>
	</tr>
	<tr>
		<td>
			<span id="essential">※</span>グループ名を選択した後、詳細へをクリックして下さい。<br />
			&nbsp;&nbsp;&nbsp;該当する商品とサプライ用品の一覧が表示されます。<br />
			<span id="essential">※</span>小ロットサプライは、システムの都合上Webオーダーではご注文できません。<br/>&nbsp;&nbsp;&nbsp;お手数ですがカスタマーセンター@if ($orderinfo->cust_kbn == "OR" || $orderinfo->cust_kbn == "YBP")（0120-500-980）@else（0120-714-841）@endifへお問い合わせください。<br/>
		</td>
	</tr>
	<tr>
		<td align="center">
			<table class="select" border="0">
				<tr>
					<td colspan="2">
					▼&nbsp;販売中の@if ($orderinfo->cust_kbn == "OR" || $orderinfo->cust_kbn == "YBP")弥生製品および@endif関連サプライ&nbsp;▼
					</td>
				</tr>

				@php
					$f_found=false;
				@endphp
				@foreach ($bigCategory as $big)
					@if ($big->big_category_old_product == '0')
					<tr>
						<td>
							<select name="category_{{ $loop->index }}" style="width:400px">
								<option value="{{ $big->big_category_code }},">-- {{ $big->big_category_name }} --

								@foreach ($middleCategory as $mid)
									@if ($mid->middle_big_category_code == $big->big_category_code)
										<option value="{{ $mid->big_category_code }},{{ $mid->middle_category_code }}">{{ $mid->middle_category_name }}
									@endif
								@endforeach
							</select>
						</td>
						<td>&nbsp;&nbsp;
							<input type="button" value="詳細へ" onClick="groupSearch(0, 'category_{{ $loop->index }}');" />
						</td>
					</tr>
					@php
						$f_found=true;
					@endphp
					@endif
				@endforeach

				@if ($f_found==false)
					<tr>
						<td><font color="red">該当データがありません</font></td>
					</tr>
				@endif

				<tr>
					<td colspan="2"><br />▼&nbsp;過去に販売した弥生製品の関連サプライ&nbsp;▼</td>
				</tr>

				@php
					$n_found=false;
				@endphp
				@foreach ($bigCategory as $big)
					@if ($big->big_category_old_product == '1')
					<tr>
						<td>
							<select name="category_{{ $loop->index }}" style="width:400px">
								<option value="{{ $big->big_category_code }},">-- {{ $big->big_category_name }} --

								@foreach ($middleCategory as $mid)
									@if ($mid->middle_big_category_code == $big->big_category_code)
										<option value="{{ $mid->big_category_code }},{{ $mid->middle_category_code }}">{{ $mid->middle_category_name }}
									@endif
								@endforeach
							</select>
						</td>
						<td>&nbsp;&nbsp;
							<input type="button" value="詳細へ" onClick="groupSearch(0, 'category_{{ $loop->index }}');" />
						</td>
					</tr>
					@php
						$n_found=true;
					@endphp
					@endif
				@endforeach

				@if ($n_found==false)
					<tr>
						<td><font color="red">該当データがありません</font></td>
					</tr>
				@endif

			</table>
		</td>
	</tr>
</table>


</x-app-layout>

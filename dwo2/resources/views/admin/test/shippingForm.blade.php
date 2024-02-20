<x-admin-layout>

<head>
	<title>出荷日取得テストフォーム</title>
</head>


{{--------------------------------------------------------------------}}
        
	@foreach ($errors->all() as $error)
		<li style="list-style:none; color:red;">{{ $error }}</li>
	@endforeach
        
	{{ html()->form('POST', '/admin/test/shipping/result')->open() }}
        テスト日付(YYYY/MM/DD H24:MI:SS)<br>
	{{ html()->text('test_datetime', $test_datetime)->attributes(['size' => '50' , 'style' => 'width:200px;']) }}<br />
	{{ html()->submit('実行') }}
	{{ html()->form()->close() }}
        
{{--------------------------------------------------------------------}}

</x-admin-layout>

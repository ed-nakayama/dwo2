<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type"content="text/html;charset=utf-8">
	<link rel="stylesheet"type="text/css"href="{{ asset('css/common.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        @font-face{
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path('fonts/ipaexg.ttf')}}") format('truetype');
        }
        @font-face{
            font-family: ipag;
            font-style: bold;
            font-weight: bold;
            src: url("{{ storage_path('fonts/ipaexg.ttf')}}") format('truetype');
        }
        
@charset "UTF-8";
html,body{
	height: 100%;
}
body {
    font-size: 14px;
    font-family: ipag;
    line-height: 1.4;
    -webkit-text-size-adjust: 100%;

    /* footar用 */ 
    display: flex;
    flex-direction: column;
}

</head>

<style>
/* 共通 */
table {
    border-collapse: collapse;
    width: 520px;
}

/* 注文確認書 ヘッダ一覧 */
.tbl-bill {
    width: 200px;
    font-size: 14px;
	margin: 0 0 0 auto;
}

.tbl-bill th, .tbl-bill td {
    padding: 2px 5px;
}


/* 注文確認書 詳細一覧 */
.tbl-billdt {
	width: 100%;
	font-size: 12px;
}
.tbl-billdt th:nth-child(1) {
	width: 10%;
}
.tbl-billdt th:nth-child(2) {
	width: 10%;
}
.tbl-billdt th:nth-child(3) {
	width: auto;
}
.tbl-billdt th:nth-child(4) {
	width: 10%;
}
.tbl-billdt th:nth-child(5) {
	width: 12%;
}
.tbl-billdt th:nth-child(6) {
	width: 12%;
}
.tbl-billdt th:nth-child(7) {
	width: 10%;
}
.tbl-billdt th:nth-child(8) {
	width: 10%;
}

.tbl-billdt th, .tbl-billdt td {
    border: 1px solid #000;
    padding: 5px 10px;
}

/* 注文確認書 合計 */
.tbl-billtotal {
    width: 200px;
    font-size: 12px;
	margin: 0 0 0 auto;
}
.tbl-billltotal th:nth-child(1) {
	width: 40%;
}
.tbl-billtotal th:nth-child(2) {
	width: 60%;
}

.tbl-billtotal th, .tbl-billtotal td {
    border: 1px solid #000;
    padding: 5px 10px;
}

/* 注文確認書 その他 */
.tbl-bill-else {
    width: 100%;
    font-size: 14px;
}
.tbl-bill-else th {
    text-align:left;
    padding: 0px 0px;
}
.tbl-bill-else td {
    text-align:left;
    padding: 0px 20px;
}



</style>

<body>

@yield('content')

</body>
</html>


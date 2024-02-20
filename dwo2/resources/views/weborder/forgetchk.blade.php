<x-guest-layout>

<title>送信終了</title>

<center>
<br>
<h3><font color="#0000ff">{{ session('status') }}</font></h3>
メールをご確認ください
<br><br><br>
{{ html()->form('GET', '/information#forgetpassword')->open() }}
{{ html()->submit('戻る') }}
{{ html()->form()->close() }}
</center>

</x-guest-layout>

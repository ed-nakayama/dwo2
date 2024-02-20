<table border="0">
	<tr>
		<td width="600px">
		<p>
{%foreach from=$app.dwoMenu item=dwomenu%}
{%if $dwomenu.link == "#" %}
		<a>{%$dwomenu.viewstr%}</a>&nbsp;&gt;&nbsp;
{%else%}
		<a href="{%$dwomenu.link%}">{%$dwomenu.viewstr%}</a>&nbsp;&gt;&nbsp;
{%/if%}
{%/foreach%}
		</p>
		</td>
		<td>
		<p class="login">
		<a href="pdf/manual.pdf" target="_blank"><img src="img/usage.png" alt="マニュアル" width="60" height="20"></a>&nbsp;&nbsp;
		<a href="?action_weborderLogoutDo=t"><img src="img/logout.png" alt="ログアウト" width="60px" height="20px"></a>
		</p>
		</td>
	</tr>
</table>

<html>
<body>
<table border="1" width=150><tr><td colspan=7>
<center>
<a href="?action_AdminCalendarMap=t&year={%$form.preYear%}&month={%$form.preMonth%}"><<</a>
　{%$form.year%}年{%$form.month%}月　
<a href="?action_AdminCalendarMap=t&year={%$form.nextYear%}&month={%$form.nextMonth%}">>></a>
</td></tr>
<tr> 
<td><font color=red>日</font></td><td>月</td><td>火</td><td>水</td><td>木</td><td>金</td><td><font color=blue>土</font></td>
</tr>
{%foreach from=$form.dayList item=list %}
<tr>
<td {%if $list.sunOn == 1%}bgcolor="#dddd00"{%/if%}><a href="?action_AdminCalendarMap=t&year={%$form.year%}&month={%$form.month%}&day={%$list.sun%}&set={%$list.sunOn%}">{%$list.sun%}</a></td>
<td {%if $list.monOn == 1%}bgcolor="#dddd00"{%/if%}><a href="?action_AdminCalendarMap=t&year={%$form.year%}&month={%$form.month%}&day={%$list.mon%}&set={%$list.monOn%}">{%$list.mon%}</a></td>
<td {%if $list.tueOn == 1%}bgcolor="#dddd00"{%/if%}><a href="?action_AdminCalendarMap=t&year={%$form.year%}&month={%$form.month%}&day={%$list.tue%}&set={%$list.tueOn%}">{%$list.tue%}</a></td>
<td {%if $list.wedOn == 1%}bgcolor="#dddd00"{%/if%}><a href="?action_AdminCalendarMap=t&year={%$form.year%}&month={%$form.month%}&day={%$list.wed%}&set={%$list.wedOn%}">{%$list.wed%}</a></td>
<td {%if $list.thuOn == 1%}bgcolor="#dddd00"{%/if%}><a href="?action_AdminCalendarMap=t&year={%$form.year%}&month={%$form.month%}&day={%$list.thu%}&set={%$list.thuOn%}">{%$list.thu%}</a></td>
<td {%if $list.friOn == 1%}bgcolor="#dddd00"{%/if%}><a href="?action_AdminCalendarMap=t&year={%$form.year%}&month={%$form.month%}&day={%$list.fri%}&set={%$list.friOn%}">{%$list.fri%}</a></td>
<td {%if $list.satOn == 1%}bgcolor="#dddd00"{%/if%}><a href="?action_AdminCalendarMap=t&year={%$form.year%}&month={%$form.month%}&day={%$list.sat%}&set={%$list.satOn%}">{%$list.sat%}</a></td>
</tr>
{%/foreach%}
</tr>
</table>

</body>
</html>

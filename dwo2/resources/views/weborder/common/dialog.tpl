<HTML>
<HEAD>
<TITLE>�K�����ǂ݂�������</TITLE>
</HEAD>
<BODY bgcolor="#fafafa">
<FORM name="myform">
<div id="message">
<br>
<table border="0">
<tr>
	<td>�@<img src="../img/caution.jpg" width="45" height="40"></td>
	<td valign="middle">�@<font size="+2"><b>�K�����ǂ݂�������</b></font></td>
</tr>
</table>
<br>
�@<b>������Ɋ|�������łɂ���</b><br>
<br>
{%if $session.agentAry.custGroup2 == '430' || $session.agentAry.custGroup2 == '436' || $session.agentAry.custGroup2 == '454' || $session.agentAry.custGroup2 == '458'  || $session.agentAry.custGroup2 == '460' || $session.agentAry.custGroup2 == '464' %}
�@���i�o�׎��i���j�ɂ�����@��ŗ��ŉېł����������Ă��������܂��B<br>
�@���w���̂��q�l�i���[�U�[�o�^�̂��q�l�j�ɂ��u�����F�v���x�ꂽ�ꍇ�A<br>
�@���������͎��Ƃ͈قȂ����ŗ��Ő�������ꍇ���������܂��B<br>
<br>
�@�i���j���񂵂�ێ�T�|�[�g�́A�L���T�|�[�g�J�n���ɂ�����@��ŗ���<br>
�@�@�@�@�ېł��A���������Ă��������܂��B<br>
{%else%}{%*�񌵑I*%}
�@���i�o�׎��ɂ�����@��ŗ��ŉېł����������Ă��������܂��B<br>
�@���w���̂��q�l�i���[�U�[�o�^�̂��q�l�j�ɂ��u�����F�v���x�ꂽ�ꍇ�A<br>
�@���������͎��Ƃ͈قȂ����ŗ��Ő�������ꍇ���������܂��B<br>
{%/if%}
<br>
</div>
<center>
	<input type="button" name="buttonA" value="���ӂ��Ȃ�" onClick="returnValue=false; self.window.close()">�@�@�@
	<input type="button" name="buttonB" value="���ӂ���" onClick="returnValue=true; self.window.close()">
</center>
</form>
 </BODY>
</HTML>

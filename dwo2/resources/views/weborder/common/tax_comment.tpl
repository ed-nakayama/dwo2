{%if TAX_MSG_FLAG == 1 %}
	<b>����łɂ���</b><br>
	{%if $session.orderinfo.upgrade_order == TRUE %}
		�@���񂵂�ێ�T�|�[�g�̃A�b�v�O���[�h�͂��\���ݓ��̗���1�����_�ɂ�����@��ŗ��ɂĉېł����Ă��������܂��B<br>
		�@�ڂ�����<a href="{%$smarty.const.UPGRADE_TAX_URL%}" target="_blank">������</a>�����Q�Ƃ��������B<br><br>
	{%else%}
		�@�T�v���C�p�i�A�퐶���i�i�\�t�g�E�F�A�j�͏��i�o�׎��ɂ�����@��ŗ��ɂĉېł����Ă��������܂��B<br>
		{%if $session.agentAry.custGroup2 == '430' || $session.agentAry.custGroup2 == '436' || $session.agentAry.custGroup2 == '454' || $session.agentAry.custGroup2 == '458'  || $session.agentAry.custGroup2 == '460' || $session.agentAry.custGroup2 == '464' %}
			{%if $session.orderinfo.pap_order == TRUE %}
				�@���񂵂�ێ�T�|�[�g�͗L���T�|�[�g�J�n���ɂ�����@��ŗ��ɂĉېł����Ă��������܂��B<br>
				�@���w���̂��q�l�i���[�U�[�o�^�̂��q�l�j�́u�����F�v���x�ꂽ�ꍇ�A���������͎��Ƃ͈قȂ�Ŋz�ł���������ꍇ���������܂��B<br>
				�@�ڂ�����<a href="{%$smarty.const.PRODUCT_TAX_URL%}" target="_blank">������</a>�����Q�Ƃ��������B<br>
			{%/if%}
		{%/if%}
		<br>
	{%/if%}
{%/if%}
{if isset($permoverview['b_virtualserver_channelgroup_list']) AND empty($permoverview['b_virtualserver_channelgroup_list'])}
	<table class="border" style="width:50%;" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead">{$lang['error']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['nopermissions']}</td>
		</tr>
	</table>
{else}
{if !empty($error) OR !empty($noerror)}
<table>
	{if !empty($error)}
	<tr>
		<td class="error">{$error}</td>
	</tr>
	{/if}
	{if !empty($noerror)}
	<tr>
		<td class="noerror">{$noerror}</td>
	</tr>
	{/if}
</table>
{/if}
<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="6">{$lang['channelgroups']}</td>
	</tr>
	<tr>
		<td class="thead">{$lang['id']}</td>
		<td class="thead">{$lang['name']}</td>
		<td class="thead">{$lang['type']}</td>
		<td class="thead">{$lang['iconid']}</td>
		<td class="thead">{$lang['savedb']}</td>
		<td class="thead">{$lang['options']}</td>
	</tr>
	{if !empty($channelgroups)}
		{foreach key=key item=value from=$channelgroups}
			{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
			<tr>
				<td class="{$td_col} center">{$value['cgid']}</td>
				<td class="{$td_col}">
				<form method="post" action="index.php?site=cgroups&amp;sid={$sid}&amp;cgid={$value['cgid']}">
				<input type="text" name="name" value="{$value['name']}" /> <input class="button" type="submit" name="sendname" value="{$lang['rename']}" />
				</form>
				</td>
				<td class="{$td_col} center">{$value['type']}</td>
				<td class="{$td_col} center">{$value['iconid']}</td>
				<td class="{$td_col} center">{$value['savedb']}</td>
				<td class="{$td_col} center">
				{if $value['type'] != '0'}
				<form method="post" action="index.php?site=cgroupclients&amp;sid={$sid}&amp;cgid={$value['cgid']}">
				<input type="submit" class="clients" name="permedit" value="" title="{$lang['clients']}" />
				</form>
				{/if}
				<form method="post" action="index.php?site=cgroupeditperm&amp;sid={$sid}&amp;cgid={$value['cgid']}">
				<input type="submit" class="eperms" name="permedit" value="" title="{$lang['editperms']}" />
				</form>
				{if !isset($permoverview['b_virtualserver_channelgroup_delete']) or $permoverview['b_virtualserver_channelgroup_delete']==1}
				<form method="post" action="index.php?site=cgroups&amp;sid={$sid}&amp;cgid={$value['cgid']}">
				<input type="submit" class="delete" name="delgroup" value="" title="{$lang['delete']}"  onclick="return confirm('{$lang['deletemsgchannelgroup']}')" />
				</form>
				{/if}
				</td>
			</tr>
			{assign var=change_col value="`$change_col+1`"}
		{/foreach}
	{/if}
</table>
{/if}
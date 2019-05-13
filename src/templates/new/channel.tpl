{if isset($permoverview['b_virtualserver_channel_list']) AND empty($permoverview['b_virtualserver_channel_list'])}

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
		<td class="thead" colspan="4">{$lang['channel']}</td>
	</tr>
	<tr>
		<td class="thead">{$lang['id']}</td>
		<td class="thead">{$lang['pid']}</td>
		<td class="thead">{$lang['name']}</td>
		<td class="thead">{$lang['option']}</td>
	</tr>
{if !empty($channellist)}
	{foreach key=key item=value from=$channellist}
	{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
		<tr>
			<td class="{$td_col} center">{$value['cid']}</td>
			<td class="{$td_col} center">{$value['pid']}</td>
			<td class="{$td_col} center">{$value['channel_name']}</td>
			<td class="{$td_col} center">
			<form method="post" action="index.php?site=channelview&amp;sid={$sid}&amp;cid={$value['cid']}">
			<input type="submit" class="select" name="select" value="" title="{$lang['select']}" />
			</form>
			<form method="post" action="index.php?site=channeleditperm&amp;sid={$sid}&amp;cid={$value['cid']}">
			<input type="submit" class="eperms" name="editperms" value="" title="{$lang['editperms']}" />
			</form>
			<form method="post" action="index.php?site=channel&amp;sid={$sid}">
			<input type="hidden" name="cid" value="{$value['cid']}" />
			{if $value['total_clients'] > 0}
				<input type="hidden" name="force" value="1" />
			{/if}
			{if !isset($permoverview['b_channel_delete_permanent']) AND $value['channel_flag_permanent'] == 1 OR $permoverview['b_channel_delete_permanent'] == 1 AND $value['channel_flag_permanent'] == 1}
				{if !isset($permoverview['b_channel_delete_flag_force']) OR $value['total_clients'] == 0 AND $permoverview['b_channel_delete_flag_force'] == 0 OR $value['total_clients'] >= 0 AND $permoverview['b_channel_delete_flag_force'] == 1}
					<input type="submit" class="delete" name="delete" value="" title="{$lang['delete']}" onclick="return confirm('{$lang['deletemsgchannel']}')" />
				{/if}
			{/if}
			{if !isset($permoverview['b_channel_delete_semi_permanent']) AND $value['channel_flag_semi_permanent'] == 1 OR $permoverview['b_channel_delete_semi_permanent'] == 1 AND $value['channel_flag_semi_permanent'] == 1}
				{if !isset($permoverview['b_channel_delete_flag_force']) OR $value['total_clients'] == 0 AND $permoverview['b_channel_delete_flag_force'] == 0 OR $value['total_clients'] >= 0 AND $permoverview['b_channel_delete_flag_force'] == 1}
					<input type="submit" class="delete" name="delete" value="" title="{$lang['delete']}" onclick="return confirm('{$lang['deletemsgchannel']}')" />
				{/if}
			{/if}
			{if !isset($permoverview['b_channel_delete_temporary']) AND $value['channel_flag_permanent'] == 0 AND $value['channel_flag_semi_permanent'] == 0 OR $permoverview['b_channel_delete_temporary'] == 1 AND $value['channel_flag_permanent'] == 0 AND $value['channel_flag_semi_permanent'] == 0}
				{if !isset($permoverview['b_channel_delete_flag_force']) OR $value['total_clients'] == 0 AND $permoverview['b_channel_delete_flag_force'] == 0 OR $value['total_clients'] >= 0 AND $permoverview['b_channel_delete_flag_force'] == 1}
					<input type="submit" class="delete" name="delete" value="" title="{$lang['delete']}" onclick="return confirm('{$lang['deletemsgchannel']}')" />
				{/if}
			{/if}
			</form>
			</td>
		</tr>
		{assign var=change_col value="`$change_col+1`"}
		{/foreach}
	{/if}
</table>
{/if}
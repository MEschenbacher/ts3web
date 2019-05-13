{if isset($permoverview['b_client_ban_list']) AND empty($permoverview['b_client_ban_list'])}
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
<table class="border" style="width:100%" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="9">{$lang['banlist']}</td>
	</tr>
	<tr>
		<td class="thead">{$lang['banid']}</td>
		<td class="thead">{$lang['ip']}/{$lang['name']}/{$lang['uniqueid']}</td>
		<td class="thead">{$lang['created']}</td>
		<td class="thead">{$lang['invokername']}</td>
		<td class="thead">{$lang['invokeruid']}</td>
		<td class="thead">{$lang['reason']}</td>
		<td class="thead">{$lang['length']}</td>
		<td class="thead">{$lang['enforcement']}</td>
		<td class="thead">{$lang['option']}</td>
	</tr>
{if !empty($banlist)}
	{foreach key=key item=value from=$banlist}
		{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}	
		<tr>
			<td class="{$td_col} center">{$value['banid']}</td>
			<td class="{$td_col} center">{$value['ip']}{$value['name']}{$value['uid']}</td>
			<td class="{$td_col} center">{$value['created']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
			<td class="{$td_col} center">{secure($value['invokername'])}</td>
			<td class="{$td_col} center">{$value['invokeruid']}</td>
			<td class="{$td_col} center">{$value['reason']}</td>
			<td class="{$td_col} center">{if isset($value['duration'])} {$value['duration']}{else}0{/if}</td>
			<td class="{$td_col} center">{$value['enforcement']}</td>
			<td class="{$td_col} center">
			{if !isset($permoverview['b_client_ban_delete']) OR $permoverview['b_client_ban_delete'] == 1}
			<form method="post" action="index.php?site=banlist&amp;sid={$sid}">
			<input type="hidden" name="banid" value="{$value['banid']}" />
			<input class="button" type="submit" name="unban" value="Unban" />
			</form>
			{/if}
			</td>
		</tr>
		{assign var=change_col value="`$change_col+1`"}
	{/foreach}
{/if}
</table>
{/if}
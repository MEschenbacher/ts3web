{if isset($permoverview['b_client_ban_create']) AND empty($permoverview['b_client_ban_create'])}
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
<form method="post" action="index.php?site=banadd&amp;sid={$sid}">
<table class="border" cellpadding="0" cellspacing="0">
	<tr>
		<td class="thead" colspan="2">{$lang['addban']}</td>
	</tr>
	<tr>
		<td class="green1">{$lang['ip']}</td>
		<td class="green1"><input type="text" name="banip" value="" /></td>
	</tr>
	<tr>
		<td class="green2">{$lang['name']}</td>
		<td class="green2"><input type="text" name="banname" value="" /></td>
	</tr>
	<tr>
		<td class="green1">{$lang['uniqueid']}</td>
		<td class="green1"><input type="text" name="banuid" value="" /></td>
	</tr>
	<tr>
		<td class="green2">{$lang['reason']}</td>
		<td class="green2"><input type="text" name="reason" value="" /></td>
	</tr>
	<tr>
		<td class="green1">{$lang['bantime']}</td>
		<td class="green1"><input type="text" name="bantime" value="" />{$lang['seconds']}</td>
	</tr>
	<tr>
		<td class="green2">{$lang['option']}</td>
		<td class="green2"><input class="button" type="submit" name="addban" value="{$lang['ban']}" /></td>
	</tr>
</table>
</form>
{/if}
{if isset($permoverview['b_virtualserver_channelgroup_create']) AND empty($permoverview['b_virtualserver_channelgroup_create'])}
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
<form method="post" action="index.php?site=cgroupadd&amp;sid={$sid}">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td colspan="2" class="thead">{$lang['addchannelgroup']}</td>
	</tr>
	<tr>
		<td class="green1">{$lang['type']}:</td>
		<td class="green1">
		{$lang['template']}<input type="radio" name="type" value="0" /><br />
		{$lang['normal']}<input checked="checked" type="radio" name="type" value="1" /><br />
		</td>
	</tr>
	<tr>
		<td class="green2">{$lang['name']}</td>
		<td class="green2">
		<input type="text" name="name" value="" />
		</td>
	</tr>
	<tr>
		<td class="green1">{$lang['copypermsfrom']}:</td>
		<td class="green1">
		<select name="copyfrom">
		<option value="0">-</option>
		{foreach key=key item=value from=$channelgroups}
			<option value="{$value['cgid']}">{$value['name']}</option>
		{/foreach}
		</select>
		</td>
	</tr>
	<tr>
		<td class="green2">{$lang['overwritegroup']}:</td>
		<td class="green2">
		<select name="overwrite">
		<option value="0">-</option>
		{foreach key=key item=value from=$channelgroups}
			<option value="{$value['cgid']}">{$value['name']}</option>
		{/foreach}
		</select>
		</td>
	</tr>
	<tr>
		<td class="green1">{$lang['option']}</td>
		<td class="green1"><input class="button" type="submit" name="addgroup" value="{$lang['add']}" /></td>
	</tr>
</table>
</form>
{/if}
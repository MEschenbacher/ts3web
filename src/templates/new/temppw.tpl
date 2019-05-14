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
		<td class="thead" colspan="8">{$lang['temppw']}</td>
	</tr>
	<tr>
		<td class="thead" align="center">Nickname</td>
		<td class="thead" align="center">Uid</td>
		<td class="thead" align="center">Desc</td>
		<td class="thead" align="center">Passwort</td>
		<td class="thead" align="center">Start</td>
		<td class="thead" align="center">Ende</td>
		<td class="thead" align="center">Channel</td>
		<td class="thead" align="center">Option</td>
	</tr>
	{if !empty($temppwlist)}
	{foreach key=id item=temppw from=$temppwlist}
	<tr>
		<td class="green1" align="center">{$temppw.nickname}</td>
		<td class="green1" align="center">{$temppw.uid}</td>
		<td class="green1" align="center">{$temppw.desc}</td>
		<td class="green1" align="center">{$temppw.pw_clear}</td>
		<td class="green1" align="center">{$temppw.start}</td>
		<td class="green1" align="center">{$temppw.end}</td>
		<td class="green1" align="center">{$temppw.tcid}</td>
		<td class="green1" align="center">
		<form method="post" action="index.php?site=temppw&amp;sid={$sid}">
		<input name="pw" value="{$temppw.pw_clear}" type="hidden">
		<input class="delete" name="temppwdel" value="" title="L&ouml;schen" type="submit">
		</form>
		</td>
	</tr>
	{/foreach}
	{/if}
</table>
<br />
<form method="post" action="index.php?site=temppw&amp;sid={$sid}">
<table style="width:30%" class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="2">{$lang['create']} {$lang['temppw']}</td>
	</tr>
	<tr>
		<td class="green1">{$lang['password']}</td>
		<td class="green1"><input type="text" name="password" value="" /></td>
	</tr>
	<tr>
		<td class="green2">{$lang['duration']}</td>
		<td class="green2"><input type="text" name="duration" value="" /></td>
	</tr>
	<tr>
		<td class="green1">{$lang['description']}</td>
		<td class="green1"><input type="text" name="description" value="" /></td>
	</tr>
	<tr>
		<td class="green2">{$lang['channel']}</td>
		<td class="green2">
		<select name="tcid">
		{foreach key=id item=channel from=$channellist}
		<option value="{$channel.cid}">{$channel.channel_name}</option>
		{/foreach}
		</select>
	</tr>
	<tr>
		<td class="green1">{$lang['option']}</td>
		<td class="green1"><input type="submit" name="create" value="{$lang['create']}" /></td>
	</tr>
</table>
</form>
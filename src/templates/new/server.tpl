{if $hoststatus === false AND $serverhost === true}
<table>
	<tr>
		<td class="error">{$lang['nohoster']}</td>
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
<form method="post" action="index.php?site=server">
<table class="border" style="width:100%;" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="7">{$lang['msgtoall']}</td>
	</tr>
	<tr>
		<td class="green1"><textarea style="width:830px" type="text" name="msgtoall" size="100"></textarea></td>
		<td class="green1"><input style="width:60px" class="button" type="submit" name="sendmsg" value="{$lang['send']}" /></td>
	</tr>
</table>
</form>
<br />
<form method="post" name="saction" action="index.php?site=server">
<table class="border" style="width:100%;" cellpadding="1" cellspacing="0">
	<tr>
		<td colspan="8" class="thead">{$lang['server']}</td>
	</tr>

	{if !empty($serverlist)}

	<tr>
		<td colspan="8">{$serverstats}</td>
	</tr>
	{/if}
	<tr>
		<td class="thead"><a class="headlink" href="index.php?site=server&amp;sortby=id&amp;sorttype={if $sortby == 'virtualserver_id' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['id']}</a></td>
		<td class="thead"><a class="headlink" href="index.php?site=server&amp;sortby=name&amp;sorttype={if $sortby == 'virtualserver_name' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['name']}</a></td>
		<td class="thead"><a class="headlink" href="index.php?site=server&amp;sortby=port&amp;sorttype={if $sortby == 'virtualserver_port' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['port']}</a></td>
		<td class="thead"><a class="headlink" href="index.php?site=server&amp;sortby=status&amp;sorttype={if $sortby == 'virtualserver_status' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['status']}</a></td>
		<td class="thead"><a class="headlink" href="index.php?site=server&amp;sortby=uptime&amp;sorttype={if $sortby == 'virtualserver_uptime' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['runtime']}</a></td>
		<td class="thead"><a class="headlink" href="index.php?site=server&amp;sortby=clients&amp;sorttype={if $sortby == 'virtualserver_clientsonline' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['clients']}</a></td>
		<td class="thead">{$lang['autostart']}</td>
		<td class="thead">{$lang['options']}</td>
	</tr>
	{if !empty($serverlist)}
	<tr>
		<td class="thead" colspan="7" align="right"></td>
		<td class="thead"><input type="submit" name="massaction" value="{$lang['action']}" onclick="return confirm(confirmAction())" /></td>
	</tr>
		{foreach key=key item=value from=$serverlist}
			{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
			<tr>
				<td class="{$td_col} center">{$value['virtualserver_id']}</td>
				<td class="{$td_col} center"><a href="index.php?site=serverview&amp;sid={$value['virtualserver_id']}">{$value['virtualserver_name']}</a></td>
				<td class="{$td_col} center">{$value['virtualserver_port']}</td>
				<td class="{$td_col} center">
				{if $value['virtualserver_status'] == "online"}
				<span class="online">{$lang['online']}</span>
				{elseif $value['virtualserver_status'] == "online virtual"}
				<span class="onvirtual">{$lang['onlinevirtual']}</span>
				{elseif $value['virtualserver_status'] == "offline"}
				<span class="offline">{$lang['offline']}</span>
				{/if}
				</td>
				<td class="{$td_col} center">{$value['virtualserver_uptime']}</td>
				<td class="{$td_col} center">{$value['virtualserver_clientsonline']} / {$value['virtualserver_maxclients']}</td>
				<td class="{$td_col} center"><input type="checkbox" name="caction[{$value['virtualserver_id']}][auto]" value="1" {if $value['virtualserver_autostart'] == 1}checked="checked"{/if}/></td>
				<td class="{$td_col} center">
				<select id="caction{$value['virtualserver_id']}" name="caction[{$value['virtualserver_id']}][action]" onchange="confirmArray('{$value['virtualserver_id']}', '{$value['virtualserver_name']|addslashes}', '{$value['virtualserver_port']}', '');">
					<option value="">{$lang['select']}</option>
					<option value="start">{$lang['start']}</option>
					<option value="stop">{$lang['stop']}</option>
					<option value="del">{$lang['delete']}</option>
				</select>
				</td>
			</tr>
			{assign var=change_col value="`$change_col+1`"}
		{/foreach}
	<tr>
		<td class="thead" colspan="7" align="right"></td>
		<td class="thead"><input type="submit" name="massaction" value="{$lang['action']}" onclick="return confirm(confirmAction())" /></td>
	</tr>
	{else}
	<tr><td class='green1' colspan='8'>{$lang['noserver']}</td></tr>
	{/if}
</table>
</form>
{/if}
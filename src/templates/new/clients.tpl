{if isset($permoverview['b_virtualserver_client_list']) AND empty($permoverview['b_virtualserver_client_list']) OR isset($permoverview['b_virtualserver_client_dblist']) AND empty($permoverview['b_virtualserver_client_dblist'])}
	<table class="border" style="width:50%;" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead">{$lang['error']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['nopermissions']}</td>
		</tr>
	</table>
{else}
<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="8">{$lang['searchfor']}{$lang['client']}</td>
	</tr>
	<tr>
		<td class="green1" colspan="8">
		<form method="post" action="index.php?site=clients&amp;sid={$sid}">
		<select name="searchby">
		<option value="uniqueid">{$lang['uniqueid']}</option>
		<option value="cldbid">{$lang['cldbid']}</option>
		<option value="name">{$lang['name']}</option>
		</select>
		<input type="text" name="search" value="" />
		<input type="submit" name="sendsearch" value="{$lang['search']}" />
		</form>
		</td>
	</tr>
	<tr>
		<td class="thead" colspan="8">
		{$lang['clients']}<br />
		{if $pages!=0}
			{while $print_pages <= $pages}
				{if $print_pages == 1}
					<a class="paging" href="index.php?site=clients&amp;sid={$sid}&amp;getstart=0{if isset($smarty.get.sortby)}&amp;sortby={$smarty.get.sortby}{/if}{if isset($smarty.get.sorttype)}&amp;sorttype={$smarty.get.sorttype}{/if}">{$print_pages}</a>	
				{else}
					-<a class="paging" href="index.php?site=clients&amp;sid={$sid}&amp;getstart={$countstarted}{if isset($smarty.get.sortby)}&amp;sortby={$smarty.get.sortby}{/if}{if isset($smarty.get.sorttype)}&amp;sorttype={$smarty.get.sorttype}{/if}">{$print_pages}</a>
				{/if}
				{assign var=countstarted value="`$countstarted+$duration`"}
				{assign var=print_pages value="`$print_pages+1`"}
			{/while}
		{/if}
		</td>
	</tr>
	<tr>
		<td class="thead">
		<a class="headlink" href="index.php?site=clients&amp;sid={$sid}&amp;sortby=cldbid&amp;sorttype={if $sortby == 'cldbid' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['dbid']}</a>
		</td>
		<td class="thead">
		<a class="headlink" href="index.php?site=clients&amp;sid={$sid}&amp;sortby=unique&amp;sorttype={if $sortby == 'client_unique_identifier' AND $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['uniqueid']}</a>
		</td>
		<td class="thead">
		<a class="headlink" href="index.php?site=clients&amp;sid={$sid}&amp;sortby=name&amp;sorttype={if $sortby == 'client_nickname' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['nickname']}</a>
		</td>
		<td class="thead">
		<a class="headlink" href="index.php?site=clients&amp;sid={$sid}&amp;sortby=created&amp;sorttype={if $sortby == 'client_created' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['created']}</a>
		</td>
		<td class="thead">
		<a class="headlink" href="index.php?site=clients&amp;sid={$sid}&amp;sortby=lastcon&amp;sorttype={if $sortby == 'client_lastconnected' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['lastonline']}</a>
		</td>
		<td class="thead">
		<a class="headlink" href="index.php?site=clients&amp;sid={$sid}&amp;sortby=status&amp;sorttype={if $sortby == 'clid' AND $sorttype == $smarty.const.SORT_ASC}desc{else}asc{/if}">{$lang['status']}</a>
		</td>
		<td class="thead">{$lang['option']}</td>
	</tr>
	{while $showclients <= $duration AND isset($clientdblist[$getstart])}
		{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
		<tr>
			<td class="{$td_col} center">
			{$clientdblist[$getstart]['cldbid']}
			</td>
			<td class="{$td_col} center">{$clientdblist[{$getstart}]['client_unique_identifier']}</td>
			<td class="{$td_col} center">{$clientdblist[{$getstart}]['client_nickname']}</td>
			<td class="{$td_col} center">{$clientdblist[{$getstart}]['client_created']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
			<td class="{$td_col} center">{$clientdblist[{$getstart}]['client_lastconnected']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
			<td class="{$td_col} center">
			{if isset($clientdblist[{$getstart}]['clid'])}
				<span class="online">{$lang['online']}</span>
			{else}
				<span class="offline">{$lang['offline']}</span>
			{/if}
			</td>
			<td class="{$td_col} center">
			<form method="post" action="index.php?site=cleditperm&amp;sid={$sid}&amp;cldbid={$clientdblist[{$getstart}]['cldbid']}">
			<input type="submit" class="eperms" name="editperms" value="" title="{$lang['editperms']}" />
			</form>
			{if !isset($permoverview['b_client_delete_dbproperties']) OR $permoverview['b_client_delete_dbproperties'] == 1}
				<form method="post" action="index.php?site=clients&amp;sid={$sid}">
				<input type="hidden" name="cldbid" value="{$clientdblist[{$getstart}]['cldbid']}" />
				<input type="submit" class="delete" name="clientdel" value="" title="{$lang['delete']}" onclick="return confirm('{$lang['deletemsgclient']}')" />
				</form>
			{/if}
			</td>
		</tr>
		
		{assign var=change_col value="`$change_col+1`"}
		{assign var=showclients value="`$showclients+1`"}
		{assign var=getstart value="`$getstart+1`"}
	{/while}
</table>
{/if}
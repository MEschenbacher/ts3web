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
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td style="font-size:12px" colspan="3">{$lang['servbackdesc']}</td>
	</tr>
	<tr>
		<td class="warning" style="font-size:12px" colspan="3">{$lang['snapwarning']}</td>
	</tr>
	<tr>
		<td class="thead" colspan="3">{$lang['serverbackups']}</td>
	</tr>
	<tr>
		<td class="thead">{$lang['created']}</td>
		<td class="thead">{$lang['server']}</td>
		<td class="thead">{$lang['options']}</td>
	</tr>
	{if isset($files[0]) AND !empty($files[0]) OR isset($folder[2]) AND !empty($folder[2])}
		{if !isset($smarty.post.backupdate)}
			{foreach key=key item=value from=$folder.2}
				{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
				<tr>
					<td class="{$td_col} center">{$value}</td>
					<td colspan="2" class="{$td_col} center">
					<form method="post" action="index.php?site=serverbackup&amp;sid={$sid}">
					<input type="hidden" name="backupdate" value="{$value}" />
					<input type="submit" name="chose" value="Ausw&auml;hlen" />
					</form>
					<form method="post" action="index.php?site=serverbackup&amp;sid={$sid}">
					<input type="hidden" name="backupdate" value="{$value}" />
					<input class="delete" type="submit" name="deleteall" value="" title="{$lang['delete']}" />
					</form>
					</td>
				</tr>
				{assign var=change_col value="`$change_col+1`"}
			{/foreach}
		{else}
			{if	isset($files[0])}
			{foreach key=key item=value from=$files.0}
				{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
				<tr>
					<td class="{$td_col} center">{$value['timestamp']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
					<td class="{$td_col} center">{$value['server']}</td>
					<td class="{$td_col} center">
					<form method="post" action="index.php?site=serverbackup&amp;sid={$sid}">
					<input type="hidden" name="backupid" value="{$value['timestamp']}" />
					<input type="hidden" name="fileport" value="{$value['server']}" />
					<input type="hidden" name="backupdate" value="{$smarty.post.backupdate}" />
					<input class="start" type="submit" name="deploy" value="" title="{$lang['deploy']}" />
					</form>
					<form method="post" action="index.php?site=serverbackup&amp;sid={$sid}">
					<input type="hidden" name="backupid" value="{$value['timestamp']}" />
					<input type="hidden" name="fileport" value="{$value['server']}" />
					<input type="hidden" name="backupdate" value="{$smarty.post.backupdate}" />
					<input class="delete" type="submit" name="delete" value="" title="{$lang['delete']}" />
					</form>
					</td>
				</tr>
				{assign var=change_col value="`$change_col+1`"}
			{/foreach}	
			{else}
				<tr>
					<td colspan="3" class="green1 center">No Backups found!</td>
				</tr>
			{/if}
		{/if}
	{/if}
</table>
<br />	
{if $hoststatus == true} 
	<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead" colspan="3">{$lang['host']} {$lang['serverbackups']}</td>
		</tr>
		<tr>
			<td class="thead">{$lang['created']}</td>
			<td class="thead">{$lang['server']}</td>
			<td class="thead">{$lang['options']}</td>
		</tr>
		{if isset($files[1]) AND !empty($files[1]) OR isset($folder[1]) AND !empty($folder[1])}
			{if !isset($smarty.post.backupdate)}
				{foreach key=key item=value from=$folder[1]}
					{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
					<tr>
						<td class="{$td_col} center">{$value}</td>
						<td colspan="2" class="{$td_col} center">
						<form method="post" action="index.php?site=serverbackup&amp;sid={$sid}">
						<input type="hidden" name="backupdate" value="{$value}" />
						<input type="submit" name="chose" value="Ausw&auml;hlen" />
						</form>
						<form method="post" action="index.php?site=serverbackup&amp;sid={$sid}">
						<input type="hidden" name="hostbackup" value="1" />
						<input type="hidden" name="backupdate" value="{$value}" />
						<input class="delete" type="submit" name="deleteall" value="" title="{$lang['delete']}" />
						</form>
						</td>
					</tr>
					{assign var=change_col value="`$change_col+1`"}
				{/foreach}
			{else}
				{if	isset($files[1])}
				{foreach key=key item=value from=$files[1]}
					{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
					<tr>
						<td class="{$td_col} center">{$value['timestamp']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
						<td class="{$td_col} center">{$value['server']}</td>
						<td class="{$td_col} center">
						<form method="post" action="index.php?site=serverbackup&amp;sid={$sid}">
						<input type="hidden" name="hostbackup" value="1" />
						<input type="hidden" name="backupdate" value="{$smarty.post.backupdate}" />
						<input type="hidden" name="backupid" value="{$value['timestamp']}" />
						<input type="hidden" name="fileport" value="{$value['server']}" />
						<input class="start" type="submit" name="deploy" value="" title="{$lang['deploy']}" />
						</form>
						<form method="post" action="index.php?site=serverbackup&amp;sid={$sid}">
						<input type="hidden" name="hostbackup" value="1" />
						<input type="hidden" name="backupdate" value="{$smarty.post.backupdate}" />
						<input type="hidden" name="backupid" value="{$value['timestamp']}" />
						<input type="hidden" name="fileport" value="{$value['server']}" />
						<input class="delete" type="submit" name="delete" value="" title="{$lang['delete']}" />
						</form>
						</td>
					</tr>
					{assign var=change_col value="`$change_col+1`"}
				{/foreach}
				{else}
					<tr>
						<td colspan="3" class="green1 center">No Backups found!</td>
					</tr>
				{/if}
			{/if}
		{/if}
	</table>
{/if}
<br />
<table class="border" cellpadding="1" cellspacing="0">
<tr>
	<td class="thead" colspan="2">{$lang['createserverbackup']}</td>
</tr>
<tr>
	<td class="green1 center">
	<form method="post" action="index.php?site=serverbackup&amp;sid={$sid}">
	<input class="button" type="submit" name="create" value="{$lang['create']}" />
	</form>
	</td>
{if $hoststatus==true}
	<td class="green1 center">
	<form method="post" action="index.php?site=serverbackup&amp;sid={$sid}">
	<input type="hidden" name="hostbackup" value="1" />
	<input class="button" type="submit" name="create" value="{$lang['host']} {$lang['create']}" />
	</form>
	</td>
{/if}
</tr>
</table>
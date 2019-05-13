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
<table class="border" style="width:100%">
		<tr>
			<td colspan="5" class="thead">{if !empty($smarty.get.cid)}{$lang['channel']} ({$smarty.get.cid} {$chaninfo['channel_name']}){else}{$lang['filelist']}{/if}</td>
		</tr>
		<tr>
			<td style="width:25%" class="thead">{$lang['name']}</td>
			<td style="width:10%" class="thead">{$lang['size']}</td>
			<td style="width:25%" class="thead">{$lang['date']}</td>
			<td style="width:25%" class="thead">{$lang['channel']}</td>
			<td style="width:10%" class="thead">{$lang['delete']}</td>
		</tr>
		{if $smarty.get.path != "/" AND !empty($smarty.get.path)}
			<tr>
				<td class="green1" colspan="3"><a href="index.php?site=filelist&amp;sid={$smarty.get.sid}&amp;cid={$cid}&amp;path={$newpath}">..</a></td>
			</tr>
		{/if}
		{if !empty($getallfiles)}
			{foreach key=key item=value from=$getallfiles}	
				{if $key !== 'totalsize'}
				<tr>
					<td class="green1">{if $value['type'] == 0} <img src='gfx/images/folder.png' alt="" /> <a href="index.php?site=filelist&amp;sid={$smarty.get.sid}&amp;path={if $smarty.get.path != "/"}{$smarty.get.path}{/if}/{$value['name']}&amp;cid={if isset($value['cid'])}{$value['cid']}{else}{$smarty.get.cid}{/if}">{$value['name']}</a>{else}<img src='gfx/images/file.png' alt="" /> <a href="site/filetransfer.php?sid={$smarty.get.sid}&amp;cid={if isset($value['cid'])}{$value['cid']}{else}{$smarty.get.cid}{/if}&amp;path={if $smarty.get.path != "/"}{$smarty.get.path}{/if}&amp;name={$value['name']}&amp;getfile=1" target="_blank">{$value['name']}</a>{/if}</td>
					<td class="green1">{$value['size']} Mb</td>
					<td class="green1">{$value['datetime']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
					<td class="green1">{$value['cname']}</td>
					<td class="green1"><a href="index.php?site=filelist&amp;sid={$sid}&amp;cid={if isset($value['cid'])}{$value['cid']}{else}{$smarty.get.cid}{/if}&amp;path={if empty($smarty.get.path)}/{else}{$smarty.get.path}{/if}&amp;name={$value['name']}&amp;deletefile=1">{$lang['delete']}</a></td>
				</tr>
				{elseif $key === 'totalsize'}
				<tr>
					<td class="green1">{$lang['totalsize']}</td>
					<td class="green1" colspan="4">{$value} Mb</td>
				</tr>
				{/if}
			{/foreach}
		{else}
			<tr>
				<td colspan="4">
				Keine Dateien gefunden!
				</td>
			</tr>
		{/if}
	</table>
	<br /><br />
	<form enctype="multipart/form-data" method="post" action="index.php?site=filelist&amp;sid={$smarty.get.sid}&amp;cid={$smarty.get.cid}&amp;cpw={$smarty.get.cpw}&amp;path={$smarty.get.path}">
	<table align="center" class="border" style="width:50%">
		<tr>
			<td colspan="2" class="thead">{$lang['upload']}</td>
		</tr>
		{if empty($smarty.get.cid)}
			<tr>
				<td>{$lang['channel']}</td>
				<td>
				<select name="cid">
				{foreach key=key item=value from=$channellist}
						<option value="{$value['cid']}">{$value['channel_name']}</option>
				{/foreach}
				</select>
				</td>
			</tr>
		{/if}
		<tr>
			<td class="green1">{$lang['upload']}:</td>
			<td class="green1" colspan="2">
			<input type="hidden" name="max_file_size" value="8388603" />
			<input name="thefile" type="file" />
			</td>
		</tr>
		<tr>
			<td class="green2"  style="width:75px">{$lang['option']}</td>
			<td class="green2"  align="left"><input type="submit" name="upload" value="{$lang['upload']}" /></td>
		</tr>
	</table>
	</form>
	<br /><br />
	<form method="post" action="index.php?site=filelist&amp;sid={$smarty.get.sid}&amp;cid={$smarty.get.cid}&amp;cpw={$smarty.get.cpw}&amp;path={$smarty.get.path}">
	<table align="center" class="border" style="width:50%">
		<tr>
			<td colspan="2" class="thead">{$lang['createfolder']}</td>
		</tr>
		{if empty($smarty.get.cid)}
			<tr>
				<td>{$lang['channel']}</td>
				<td>
				<select name="cid">
				{foreach key=key item=value from=$channellist}
						<option value="{$value['cid']}">{$value['channel_name']}</option>
				{/foreach}
				</select>
				</td>
			</tr>
		{/if}
		<tr>
			<td class="green1">{$lang['name']}:</td>
			<td class="green1" colspan="2"><input type="text" name="fname" value="" /></td>
		</tr>
		<tr>
			<td class="green2"  style="width:75px">{$lang['option']}</td>
			<td class="green2"  align="left"><input type="submit" name="createdir" value="{$lang['create']}" /></td>
		</tr>
	</table>
	</form>
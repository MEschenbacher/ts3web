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
<form enctype="multipart/form-data" action="index.php?site=fileupload&amp;sid={$sid}" method="post">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="2">{$lang['iconupload']}</td>
	</tr>
	<tr>
		<td class="green1" colspan="2">{$lang['iconupinfo']}</td>
	</tr>
	<tr>
		<td class="green2" colspan="2">
		<input type="hidden" name="max_file_size" value="81920" />
		{$lang['iconupload']}: <input name="thefile" type="file" />
		
		</td>
	</tr>
	<tr>
		<td class="green1"  style="width:75px">{$lang['option']}</td>
		<td class="green1"  align="left"><input type="submit" name="upload" value="{$lang['iconupload']}" /></td>
	</tr>
</table>
</form>
<br />
<form method="post" action="index.php?site=fileupload&amp;sid={$sid}">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead">{$lang['icon']}</td>
		<td class="thead">{$lang['name']}</td>
		<td class="thead">{$lang['id']}</td>
		<td class="thead">Ma&szlig;e</td>
		<td class="thead">Type</td>
		<td class="thead">{$lang['delete']} {$lang['selectall']}<input type="checkbox" name="checkall" value="0" onclick="check(2)" /></td>
	</tr>
	{foreach key=key item=value from=$allicons}
	<tr>
		<td><img style="border:0"src="site/showfile.php?name=icon_{$value.name}&amp;port={$port}" alt="" /></td>
		<td>{$key}</td>
		<td>{$value.id}</td>
		<td>{$value.info.0}*{$value.info.1}</td>
		<td>
		{if $value.info.2 == 1}
		.gif
		{elseif $value.info.2 == 2}
		.jpg
		{elseif $value.info.2 == 3}
		.png
		{/if}
		</td>
		<td><input type="checkbox" id="list{$value['virtualserver_id']}" name="delicons[]" value="/{$key}" /></td>
	</tr>
	{/foreach}
	<tr>
		<td colspan="6"><input type="submit" name="delaction" value="{$lang['delete']}" /></td>
	</tr>
</table>
</form>
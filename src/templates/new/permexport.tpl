{if !empty($error)}
<table>
	{if !empty($error)}
	<tr>
		<td class="error">{$error}</td>
	</tr>
	{/if}
</table>
{/if}
<form method="post" action="index.php?site=permexport&amp;sid={$sid}">
<table  class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td colspan="2" style="font-size:12px">{$lang['permexdesc']}</td>
	</tr>
	<tr>
		<td class="thead" colspan="2">{$lang['permexport']}</td>
	</tr>
	<tr>
		<td class="green1">{$lang['sourcetype']}</td>
		<td class="green1">
		<select name="sourcemode">
		<option value="1">{$lang['servergroup']}</option>
		<option value="2">{$lang['channelgroup']}</option>
		<option value="3">{$lang['channel']}</option>
		<option value="4">{$lang['client']}</option>
		</select> 
		</td>
	</tr>
	<tr>
		<td class="green2">{$lang['sourceid']}</td>
		<td class="green2"><input type="text" name="sourceid" value="" /></td>
	</tr>
	<tr>
		<td class="green1">{$lang['targettype']}</td>
		<td class="green1">
		<select name="targetmode">
		<option value="1">{$lang['servergroup']}</option>
		<option value="2">{$lang['channelgroup']}</option>
		<option value="3">{$lang['channel']}</option>
		<option value="4">{$lang['client']}</option>
		</select> 
		</td>
	</tr>
	<tr>
		<td class="green2">{$lang['targetid']}</td>
		<td class="green2"><input type="text" name="targetid" value="" /></td>
	</tr>
	<tr>
		<td class="green1">{$lang['option']}</td>
		<td class="green1">
		<input class="button" type="submit" name="showcommands" value="{$lang['view']}" />
		</td>
	</tr>
	{if isset($smarty.post.showcommands) AND empty($error)}
		<tr>
			<td class="green2 center" colspan="2">
			<textarea name="showfield" cols="50" rows="10" readonly="readonly">{$permexport}</textarea>
			</td>
		</tr>
	{/if}
</table>
</form>
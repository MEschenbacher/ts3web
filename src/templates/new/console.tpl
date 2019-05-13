<form method="post" action="index.php?site=console&amp;sid={$sid}">
<table class="border" cellpadding="0" cellspacing="0">
	<tr>
		<td class="thead">{$lang['queryconsole']}</td>
	</tr>
	<tr>
		<td>{$lang['inputbox']}</td>
	</tr>
	<tr>
		<td>
			<textarea name="command" cols="50" rows="10"></textarea>	
		</td>
	</tr>
	<tr>
		<td><input class="button" type="submit" name="execute" value="{$lang['execute']}" /><br /><br /></td>
	</tr>
	<tr>
		<td>{$lang['outputbox']}</td>
	</tr>
	<tr>
		<td>
			<textarea name="output" cols="80" rows="20" readonly="readonly">{$showOutput}</textarea>	
		</td>
	</tr>
</table>
</form>
{if !empty($error)}
<table>
	<tr>
		<td class="error">{$error}</td>
	</tr>
</table>
{/if}
<table cellpadding="0" cellspacing="0">
{if $hoststatus === false}	
	<tr>
		<td class="logintop" colspan="2"></td>
	</tr>
	<tr>
		<td class="loginpuff loginhead" colspan="2">{$lang['logintowi']}</td>
	</tr>
	<tr>
		<td class="loginpuff" align="center">
		<form method="post" action="index.php?site=hostlogin">
		<table style="padding:10px;" cellpadding="1" cellspacing="0">
			<tr>
				<td class="login">{$lang['username']}:</td>
				<td><input type="text" name="loginHostUser" value="" /></td>
			</tr>
			<tr>
				<td class="login">{$lang['password']}:</td>
				<td><input type="password" name="loginHostPw" /></td>
			</tr>
			<tr>
				<td class="login">{$lang['option']}:</td>
				<td><input class="button" type="submit" name="sendloginhost" value="{$lang['login']}"/></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center"><a href="index.php?site=login">{$lang['normallogin']}</a></td>
			</tr>
		</table>
		</form>
		</td>
	</tr>
	{elseif $hoststatus === true AND $loginstatus === false}
	<tr>
		<td class="logintop" colspan="2"></td>
	</tr>
	<tr>
		<td class="loginpuff loginhead" colspan="2">{$lang['logintoqry']}</td>
	</tr>
	<tr>
		<td class="loginpuff" align="center">
		<form method="post" action="index.php?site=hostlogin">
		<table style="padding:10px;" cellpadding="1" cellspacing="0">
			<tr>
				<td class="login">{$lang['server']}</td>
				<td>
				{if count($server)==1}
					{foreach key=skey item=sdata from=$instances}
					<input type="hidden" name="skey" value="{$skey}" />	{$sdata['alias']} 
					{/foreach}
				{else}
					<select name="skey">
					{foreach key=skey item=sdata from=$instances}
						<option value="{$skey}">{$sdata['alias']}</option>	
					{/foreach}
					</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="login">{$lang['username']}:</td>
				<td class="login"><input type="text" name="loginUser" value="serveradmin" /></td>
			</tr>
			<tr>
				<td class="login">{$lang['password']}:</td>
				<td class="login"><input type="password" name="loginPw" /></td>
			</tr>
			<tr>
				<td class="login">{$lang['option']}:</td>
				<td><input class="button" type="submit" name="sendlogin" value="{$lang['login']}"/></td>
			</tr>
		</table>
		</form>
		</td>
	</tr>
	{/if}
	<tr>
		<td class="loginbottom">&nbsp;</td>
	</tr>
</table>
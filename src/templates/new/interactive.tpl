<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
*Copyright (C) 2012-2013  Psychokiller
*
*This program is free software; you can redistribute it and/or modify it under the terms of 
*the GNU General Public License as published by the Free Software Foundation; either 
*version 3 of the License, or any later version.
*
*This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
*without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
*See the GNU General Public License for more details.
*
*You should have received a copy of the GNU General Public License along with this program; if not, see http://www.gnu.org/licenses/. 
-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../templates/{$tmpl}/gfx/style.css" type="text/css" media="screen" />
<title>Webinterface - Interactive</title>
</head>
<body>
{if !isset($smarty.get.clid)}
	<form method="post" name="f2" action="interactive.php?sid={$smarty.get.sid}">
		<table class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td class="maincat" colspan="2">{$lang['massaction']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['select']}:</td>
				<td class="green1">
				<select name="action" onchange="this.form.submit()">
					<option value="">{$lang['select']}</option>
					<option value="kick">{$lang['kick']}</option>
					<option value="ban">{$lang['ban']}</option>
					<option value="move">{$lang['move']}</option>
				</select>
				</td>
			</tr>
		</table>
	</form>
	<br />
	{if $smarty.post.action == 'move'}
	<script type="text/javascript">
	//<![CDATA[
	window.resizeTo(350,550);
	//]]>
	</script>
	<form method="post" name="f1" target="opener" action="../index.php?site=serverview&amp;sid={$smarty.get.sid}">
		<table class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td class="maincat" colspan="2">{$lang['massmover']}</td>
			</tr>
			<tr>
				<td colspan="2" class="green1">{$lang['moveallclients']}: <input type="checkbox" name="moveall" value="1" /></td>
			</tr>
			<tr>
				<td colspan="2" class="green2">{$lang['moveclientsbysgroup']}:</td>
			</tr>
				{foreach key=key item=value from=$servergrouplist}
				{if $value['type']!=0}
				<tr><td class="green2">{$value['name']}</td><td class="green2"><input type="checkbox" name="movebysgroup[]" value="{$value['sgid']}" /></td></tr>
				{/if}
				{/foreach}
			<tr>
				<td colspan="2" class="green1">{$lang['moveclientsbycgroup']}:</td>
			</tr>
				{foreach key=key item=value from=$channelgrouplist}
				{if $value['type']!=0}
				<tr><td class="green1">{$value['name']}</td><td class="green1"><input type="checkbox" name="movebycgroup[]" value="{$value['cgid']}" /></td></tr>
				{/if}
				{/foreach}
			<tr>
				<td class="green2">{$lang['movefrom']}:</td>
				<td class="green2">
				<select name="movebycid[]" size="3" multiple="multiple">
				{foreach key=key item=value from=$channellist}
					<option value="{$value['cid']}">{$value['channel_name']}</option>
				{/foreach}
				</select>
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['moveto']}:</td>
				<td class="green1">
				<select name="cid">
				{foreach key=key item=value from=$channellist}
					<option value="{$value['cid']}">{$value['channel_name']}</option>
				{/foreach}
				</select>
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['option']}:</td>
				<td class="green2">
				<input class="button" type="submit" name="sendmassmove" value="{$lang['move']}" onclick="self.close()" />
				</td>
			</tr>
		</table>
	</form>
	<br />
	{/if}
	{if $smarty.post.action == 'kick'}
	<script type="text/javascript">
	//<![CDATA[
	window.resizeTo(350,550);
	//]]>
	</script>
	<form method="post" name="f1" target="opener" action="../index.php?site=serverview&amp;sid={$smarty.get.sid}">
		<table class="border" cellpadding="1" cellspacing="0">
			<table class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td class="maincat" colspan="2">{$lang['masskicker']}</td>
			</tr>
			<tr>
				<td colspan="2"  class="green1">{$lang['kickallclients']}: <input type="checkbox" name="kickall" value="1" /></td>
			</tr>
			<tr>
				<td colspan="2" class="green2">{$lang['kickclientsbysgroup']}:</td>
			</tr>
				{foreach key=key item=value from=$servergrouplist}
				{if $value['type']!=0}
				<tr><td class="green2">{$value['name']}</td><td class="green2"><input type="checkbox" name="kickbysgroup[]" value="{$value['sgid']}" /></td></tr>
				{/if}
				{/foreach}
			<tr>
				<td colspan="2" class="green1">{$lang['kickclientsbycgroup']}:</td>
			</tr>
				{foreach key=key item=value from=$channelgrouplist}
				{if $value['type']!=0}
				<tr><td class="green1">{$value['name']}</td><td class="green1"><input type="checkbox" name="kickbycgroup[]" value="{$value['cgid']}" /></td></tr>
				{/if}
				{/foreach}
			<tr>
				<td class="green2">{$lang['kickfrom']}:</td>
				<td class="green2">
				<select name="kickbycid[]" size="3" multiple="multiple">
				{foreach key=key item=value from=$channellist}
					<option value="{$value['cid']}">{$value['channel_name']}</option>
				{/foreach}
				</select>
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['kickmsg']}:</td>
				<td class="green1"><input type="text" name="kickmsg" value="" /></td>
			</tr>
			<tr>
				<td class="green2">{$lang['option']}:</td>
				<td class="green2">
				<input class="button" type="submit" name="sendmasskick" value="{$lang['kick']}" onclick="self.close()" />
				</td>
			</tr>
		</table>
	</form>
	<br />
	{/if}
	{if $smarty.post.action == 'ban'}
	<script type="text/javascript">
	//<![CDATA[
	window.resizeTo(350,550);
	//]]>
	</script>
	<form method="post" name="f1" target="opener" action="../index.php?site=serverview&amp;sid={$smarty.get.sid}">
		<table class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td class="maincat" colspan="2">{$lang['massban']}</td>
			</tr>
			<tr>
				<td colspan="2" class="green1">{$lang['banallclients']}: <input type="checkbox" name="banall" value="1" /></td>
			</tr>
			<tr>
				<td colspan="2" class="green2">{$lang['banclientsbysgroup']}:</td>
			</tr>
				{foreach key=key item=value from=$servergrouplist}
				{if $value['type']!=0}
				<tr><td class="green2">{$value['name']}</td><td class="green2"><input type="checkbox" name="banbysgroup[]" value="{$value['sgid']}" /></td></tr>
				{/if}
				{/foreach}
			<tr>
				<td colspan="2" class="green1">{$lang['banclientsbycgroup']}:</td>
			</tr>
				{foreach key=key item=value from=$channelgrouplist}
				{if $value['type']!=0}
				<tr><td class="green1">{$value['name']}</td><td class="green1"><input type="checkbox" name="banbycgroup[]" value="{$value['cgid']}" /></td></tr>
				{/if}
				{/foreach}
			<tr>
				<td class="green2">{$lang['banfrom']}:</td>
				<td class="green2">
				<select name="banbycid[]" size="3" multiple="multiple">
				{foreach key=key item=value from=$channellist}
					<option value="{$value['cid']}">{$value['channel_name']}</option>
				{/foreach}
				</select>
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['banmsg']}:</td>
				<td class="green1"><input type="text" name="banmsg" value=""></td>
			</tr>
			<tr>
				<td class="green2">{$lang['bantime']}:</td>
				<td class="green2"><input type="text" name="bantime" value="">{$lang['seconds']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['option']}:</td>
				<td class="green1">
				<input class="button" type="submit" name="sendmassban" value="{$lang['ban']}" onclick="self.close()" />
			</td>
		</tr>
		</table>
	</form>
	<br />
	{/if}
{else}
	<form method="post" name="f2" action="interactive.php?sid={$smarty.get.sid}&amp;clid={$smarty.get.clid}&amp;nick={$smarty.get.nick}">
		<table class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td class="maincat" colspan="2">{$smarty.get.nick}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['select']}:</td>
				<td class="green1">
				<select name="action" onchange="this.form.submit()">
					<option value="">{$lang['select']}</option>
					<option value="kick">{$lang['kick']}</option>
					<option value="ban">{$lang['ban']}</option>
					<option value="poke">{$lang['poke']}</option>
					<option value="move">{$lang['move']}</option>
				</select>
				</td>
			</tr>
		</table>
		</form>
		<br />
	{if $smarty.post.action == 'kick'}
	<form method="post" name="f1" target="opener" action="../index.php?site=serverview&amp;sid={$smarty.get.sid}" onsubmit="window.close()">
	<table class="border" cellpadding="1" cellspacing="0">
		<tr>
			<td class="maincat" colspan="2">{$lang['kick']} {$smarty.get.nick}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['kickmsg']}:</td>
			<td class="green1"><input type="text" name="kickmsg" value="" /></td>
		</tr>
		<tr>
			<td class="green2">{$lang['option']}:</td>
			<td class="green2">
			<input type="hidden" name="clid" value="{$smarty.get.clid}" />
			<input class="button" type="submit" name="sendkick" value="{$lang['kick']}" onclick="self.close()">
			</td>
		</tr>
	</table>
	</form>
	{/if}

	{if $smarty.post.action == 'ban'}
	<form method="post" name="f1" target="opener" action="../index.php?site=serverview&amp;sid={$smarty.get.sid}">
	<table class="border" cellpadding="1" cellspacing="0">
		<tr>
			<td class="maincat" colspan="2">{$lang['ban']} {$smarty.get.nick}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['banmsg']}:</td>
			<td class="green1">
			<input type="text" name="banmsg" value=""></td>
		</tr>
		<tr>
			<td class="green2">{$lang['bantime']}:</td>
			<td class="green2">
			<input type="text" name="bantime" value="">{$lang['seconds']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['option']}:</td>
			<td class="green1">
			<input type="hidden" name="clid" value="{$smarty.get.clid}" />
			<input class="button" type="submit" name="sendban" value="{$lang['ban']}" onclick="self.close()">
			</td>
		</tr>
	</table>
	</form>
	{/if}

	{if $smarty.post.action == 'poke'}
	<form method="post" name="f1" target="opener" action="../index.php?site=serverview&amp;sid={$smarty.get.sid}">
	<table class="border" cellpadding="1" cellspacing="0">
		<tr>
			<td class="maincat" colspan="2">{$lang['poke']} {$smarty.get.nick}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['pokemsg']}:</td>
			<td class="green1">
			<input type="text" name="pokemsg" value=""></td>
		<tr>
			<td class="green2">{$lang['option']}:</td>
			<td class="green2">
			<input type="hidden" name="clid" value="{$smarty.get.clid}" />
			<input class="button" type="submit" name="sendpoke" value="{$lang['poke']}" onclick="self.close()">
			</td>
		</tr>
	</table>
	</form>
	{/if}
	{if $smarty.post.action=='move'}
	<form method="post" name="f1" target="opener" action="../index.php?site=serverview&amp;sid={$smarty.get.sid}">
	<table class="border" cellpadding="1" cellspacing="0">
		<tr>
			<td class="maincat" colspan="2">{$lang['move']} {$_GET['nick']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['move']}:</td>
			<td class="green1">
			<select name="cid">
			{foreach key=key item=value from=$channellist}
				<option value="{$value['cid']}">{$value['channel_name']}</option>";
			{/foreach}
			</select>
			</td>
		<tr>
			<td class="green2">{$lang['option']}:</td>
			<td class="green2">
			<input type="hidden" name="clid" value="{$smarty.get.clid}" />
			<input class="button" type="submit" name="sendmove" value="{$lang['move']}" onclick="self.close()">
			</td>
		</tr>
	</table>
	</form>
	{/if}
{/if}
</body>
</html>
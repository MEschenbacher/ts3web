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
<title>Webinterface - Filebrowser</title>
</head>
<body onload="window.resizeTo(500,600)">
	{if !empty($error) OR !empty($noerror)}
	<table align="center">
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
			<td colspan="4" class="thead">{$lang['channel']} ({$smarty.get.cid} {$chaninfo['channel_name']})</td>
		</tr>
		<tr>
			<td style="width:25%" class="thead">{$lang['name']}</td>
			<td style="width:10%" class="thead">{$lang['size']}</td>
			<td style="width:25%" class="thead">{$lang['date']}</td>
			<td style="width:10%" class="thead">{$lang['delete']}</td>
		</tr>
	{if !empty($flist)}
		{if $smarty.get.path != "/" AND !empty($smarty.get.path)}

			<tr>
				<td class="green1" colspan="4"><a href="filebrowser.php?sid={$smarty.get.sid}&amp;cid={$smarty.get.cid}&amp;path={$newpath}">..</a></td>
			</tr>
		{/if}
		{foreach key=key item=value from=$flist}
			<tr>
				<td class="green1">{if $value['type'] == 0} <img src='../gfx/images/folder.png' alt="" /> <a href="filebrowser.php?&amp;sid={$smarty.get.sid}&amp;path={if $smarty.get.path != "/"}{$smarty.get.path}{/if}/{$value['name']}&amp;cid={if isset($value['cid'])}{$value['cid']}{else}{$smarty.get.cid}{/if}">{$value['name']}</a>{else}<img src='../gfx/images/file.png' alt="" /> <a href="filetransfer.php?sid={$smarty.get.sid}&amp;cid={if isset($value['cid'])}{$value['cid']}{else}{$smarty.get.cid}{/if}&amp;path={if $smarty.get.path != "/"}{$smarty.get.path}{/if}&amp;name={$value['name']}&amp;getfile=1" target="_blank">{$value['name']}</a>{/if}</td>
				<td class="green1">{$value['size']} Mb</td>
				<td class="green1">{$value['datetime']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
				<td class="green1"><a href="filebrowser.php?sid={$smarty.get.sid}&amp;cid={if isset($value['cid'])}{$value['cid']}{else}{$smarty.get.cid}{/if}&amp;path={$smarty.get.path}&amp;name={$value['name']}&amp;deletefile=1">{$lang['delete']}</a></td>
			</tr>	
		{/foreach}
	{else}
		{if $smarty.get.path != "/" AND !empty($smarty.get.path)}
			<tr>
				<td class="green1" colspan="4"><a href="filebrowser.php?sid={$smarty.get.sid}&amp;cid={$smarty.get.cid}&amp;path={$newpath}">..</a></td>
			</tr>
		{/if}
		<tr>
			<td colspan="4">
			Keine Dateien gefunden!
			</td>
		</tr>
	{/if}
	</table>
	<br /><br />

<form enctype="multipart/form-data" method="post" action="filebrowser.php?sid={$smarty.get.sid}&amp;cid={$smarty.get.cid}&amp;cpw={$smarty.get.cpw}&amp;path={$smarty.get.path}">
<table align="center" class="border" style="width:50%">
	<tr>
		<td colspan="2" class="thead">{$lang['upload']}</td>
	</tr>
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
<form method="post" action="filebrowser.php?sid={$smarty.get.sid}&amp;cid={$smarty.get.cid}&amp;cpw={$smarty.get.pw}&amp;path={$smarty.get.path}">
<table align="center" class="border" style="width:50%">
	<tr>
		<td colspan="2" class="thead">{$lang['createfolder']}</td>
	</tr>
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
</body>
</html>
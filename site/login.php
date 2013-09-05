<?php 
/*
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
*You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. 
*/
if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 

$error='';

if($serverstatus===false)	
	{
	$debuglog=$ts3->getDebugLog();
	foreach($debuglog AS $value)
		{
		$error .= $value."<br />";
		}
	session_destroy();
	}
elseif($loginstatus===true AND $hoststatus===false AND isset($_POST['sendlogin']))
	{
	header("Location: index.php?site=serverview&sid=".$_SESSION['loginsid']);

    exit;
	}
elseif($loginstatus===true AND $hoststatus===true AND isset($_POST['sendlogin']))
	{
	header("Location: index.php?site=server");

    exit;
	}
elseif($loginstatus===false AND isset($_POST['sendlogin']))
	{
	$debuglog=$ts3->getDebugLog();
	foreach($debuglog AS $value)
		{
		$error .= $value."<br />";
		}
	session_destroy();
	}
elseif($loginstatus===true AND !isset($_POST['sendlogin']))
	{
	$error .= $lang['alreadylogin']."<br />";
	}

if($show_motd==true)
	{
	$motd=implode("", file('motd.txt'));
	$smarty->assign("motd", $motd);
	}
	
if(!empty($error))
	{
	$smarty->assign("error", $error);
	}
	
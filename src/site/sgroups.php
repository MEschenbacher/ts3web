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
if($sid===false OR empty($sid)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {

$error='';
$noerror='';

if(isset($_POST['sendname']))
	{
	if(!empty($_POST['name']))
		{
		$sgroup_rename=$ts3->serverGroupRename($sgid, $_POST['name']);
		
		if($sgroup_rename['success']!==false)
			{
			$noerror .= $lang['groupnameeditok']."<br />";
			}
			else
			{
			for($i=0; $i+1==count($sgroup_rename['errors']); $i++)
				{
				$error .= $sgroup_rename['errors'][$i]."<br />";
				}
			}
		}
		else
		{
		$error .= $lang['groupnameempty']."<br />";
		}
	}
if(isset($_POST['delgroup']))
	{
	$sgroup_delete=$ts3->serverGroupDelete($sgid);
	if($sgroup_delete['success']!==false)
		{
		$noerror .= $lang['groupremoveok']."<br />";
		}
		else
		{
		for($i=0; $i+1==count($sgroup_delete['errors']); $i++)
			{
			$error .= $sgroup_delete['errors'][$i]."<br />";
			}
		}
	}


$servergroups=$ts3->getElement('data', $ts3->serverGroupList());
if(!empty($servergroups))
	{
	foreach($servergroups AS $key => $value)
		{
		$servergroups[$key]=secure($servergroups[$key]);
		if ($hoststatus === false AND $value['type'] == '2' OR $hoststatus === false AND $value['type'] == '0')
			{
			unset($servergroups[$key]);
			}
		}
	}
}

$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("servergroups", $servergroups);
?>
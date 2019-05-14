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
		$cgroup_rename=$ts3->channelGroupRename($cgid, $_POST['name']);
		if($cgroup_rename['success']!==false)
			{
			$noerror .= $lang['groupnameeditok']."<br />";
			}
			else
			{
			for($i=0; $i+1==count($cgroup_rename['errors']); $i++)
				{
				$error .= $cgroup_rename['errors'][$i]."<br />";
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
	$cgroup_delete=$ts3->channelGroupDelete($cgid);
	if($cgroup_delete['success']!==false)
		{
		$noerror .= $lang['groupremoveok']."<br />";
		}
		else
		{
			for($i=0; $i+1==count($cgroup_delete['errors']); $i++)
				{
				$error .= $cgroup_delete['errors'][$i]."<br />";
				}
		}
	}

$channelgroups=$ts3->getElement('data', $ts3->channelGroupList());

if(!empty($channelgroups))
	{
	foreach($channelgroups AS $key => $value)
		{
		$channelgroups[$key]=secure($channelgroups[$key]);
		if ($hoststatus===false AND $value['type']=='0')
			{
			unset($channelgroups[$key]);
			}
		}
	}

$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("channelgroups", $channelgroups);
}
?>
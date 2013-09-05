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
$noerror='';

if(isset($_POST['addgroup']))
	{
	if(!empty($_POST['name']))
		{
		if(!empty($_POST['copyfrom']))
			{
			empty($_POST['type']) ? $type=0:$type=$_POST['type'];
			$creategroup=$ts3->serverGroupCopy($_POST['copyfrom'], $_POST['overwrite'], $_POST['name'], $type);
			if($creategroup['success']!==false)
				{
				$noerror .= $lang['groupcreatedok']."<br />";
				}
				else
				{
				for($i=0; $i+1==count($creategroup['errors']); $i++)
					{
					$error .= $creategroup['errors'][$i]."<br />";
					}
				}
			}
			else
			{
			empty($_POST['type']) ? $type=0:$type=$_POST['type'];
			$creategroup=$ts3->serverGroupAdd($_POST['name'], $type);
			if($creategroup['success']!==false)
				{
				$noerror .= $lang['groupcreatedok']."<br />";
				}
				else
				{
				for($i=0; $i+1==count($creategroup['errors']); $i++)
					{
					$error .= $creategroup['errors'][$i]."<br />";
					}
				}
			}
		}
		else
		{
		$error .= $lang['groupnameempty']."<br />";
		}
	}

$servergroups=$ts3->getElement('data', $ts3->serverGroupList());
if(!empty($servergroups))
	{
	foreach($servergroups AS $key => $value)
		{
		if ($hoststatus===false AND $value['type']=='2' OR $hoststatus===false AND $value['type']=='0')
			{
			unset($servergroups[$key]);
			}
		}
	}

$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("servergroups", $servergroups);

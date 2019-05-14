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
$error = '';
$noerror = '';
 
if(isset($_POST['editinstance']))
	{
	$instance_edit=$ts3->instanceEdit($_POST['newsettings']);
		
	if($instance_edit['success']!==false)
		{
		$noerror = $lang['servereditok'];
		}
		else
		{
		$error .= $lang['editincomplete']."<br />";
		for($i=0; $i+1==count($instance_edit['errors']); $i++)
			{
			$error .= $instance_edit['errors'][$i]."<br />";
			}
		}
	}

if(isset($_POST['editshowlist']))
	{
	foreach($_POST['list'] AS $key=>$value)
		{
		$ts3->selectServer($key, 'serverId');
		foreach($value AS $key2=>$value2);
			{
			$websetting['virtualserver_weblist_enabled']=$value2;
			$server_edit=$ts3->serverEdit($websetting);
			if($server_edit['success']===false)
				{
				for($i=0; $i+1==count($instance_edit['errors']); $i++)
					{
					$error .= $server_edit['errors'][$i]."<br />";
					}
				}
			}
		}
	if(empty($error))
		{
		$noerror = $lang['weblisteditok'];
		}
	}
	
$instanceinfo=$ts3->getElement('data', $ts3->instanceInfo());
$instanceinfo['serverinstance_max_download_total_bandwidth'] == '18446744073709551615' ? $instanceinfo['serverinstance_max_download_total_bandwidth'] = -1:'';
$instanceinfo['serverinstance_max_upload_total_bandwidth'] == '18446744073709551615' ? $instanceinfo['serverinstance_max_upload_total_bandwidth'] = -1:'';

$serverlist=$ts3->getElement('data', $ts3->serverList());
if(!empty($serverlist))
	{
	foreach($serverlist AS $key=>$value)
		{
		$ts3->selectServer($value['virtualserver_port']);
		$serverinfo=$ts3->getElement('data', $ts3->serverInfo());
		$serverlist[$key]['virtualserver_weblist_enabled']=$serverinfo['virtualserver_weblist_enabled'];
		$serverlist[$key]=secure($serverlist[$key]);
		}
	}

$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("instanceinfo", $instanceinfo);
$smarty->assign("serverlist", $serverlist);
?>
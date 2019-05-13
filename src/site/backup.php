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
$files='';

if(isset($_POST['hostbackup']))
		{
		$path="site/backups/channel/hostbackups/";
		}
		else
		{
		$path="site/backups/channel/";
		}

if(isset($_POST['create']))
	{
	$filename="channel_".time()."_".$_SESSION['server_ip']."-".$whoami['virtualserver_port'].".txt";
	$channellist=$ts3->channelList("-topic -flags -voice -limits");
	foreach($channellist['data'] AS $key=>$value)
		{
		$channelinfo=$ts3->getElement('data', $ts3->channelInfo($value['cid']));
		unset($channelinfo['channel_password']);
		unset($channelinfo['channel_filepath']);
		foreach($channelinfo AS $key2=>$value2)
			{
			if(!isset($channellist['data'][$key][$key2]))
				{
				$channellist['data'][$key][$key2]=$value2;
				}
			}
		}
	if($channellist['success']!==false)
		{
		if(channel_backup_create($path.$filename, $channellist['data'])===true)
			{
			$noerror .= $lang['chanbackupcreate'];
			}
			else
			{
			$error .= $lang['chanbackupcreateerror'];
			}
		}
		else
		{
		$error .= $lang['errorchannellist']."<br />".$channellist['errors'][0];
		}
	}

if(isset($_POST['deploy']))
	{
	$filename="channel_".$_POST['backupid']."_".$_POST['fileport'].".txt";
	$channellist=$ts3->channelList("-topic -flags -voice -limits");
	$backup=channel_backup_deploy($path.$filename);
	if($backup===false)
		{
		$error .= $lang['chanbackupdeployerror'];
		}
		else
		{
		if(channel_backup_deploy_action($channellist['data'], 0, $backup, 0)===false)
			{
			$error .= $lang['chanbackupdeployerror'];
			}
			else
			{
			$noerror .= $lang['chanbackupdeploy'];
			}
		}
	}

if(isset($_POST['delete']))
	{
	if(@!unlink($path."channel_".$_POST['backupid']."_".$_POST['fileport'].".txt"))
		{
		$error .= $lang['chanbackupdelerror'];
		}
		else
		{
		$noerror .= $lang['chanbackupdel'];
		}
	}
	
$handler=opendir("site/backups/channel/");
while($datei=readdir($handler))
	{
	if($datei!='.' AND $datei!='..' AND $datei!='hostbackups')
		{
		$datei=str_replace('.txt', '', $datei);
		$datei_info=explode('_', $datei);
		$files[0][]=array("timestamp"=>$datei_info[1], "server"=>$datei_info[2]);
		}
	}	

$handler=opendir("site/backups/channel/hostbackups/");
while($datei=readdir($handler))
	{
	if($datei!='.' AND $datei!='..')
		{
		$datei=str_replace('.txt', '', $datei);
		$datei_info=explode('_', $datei);
		$files[1][]=array("timestamp"=>$datei_info[1], "server"=>$datei_info[2]);
		}
	}
}

$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("files", $files);
?>
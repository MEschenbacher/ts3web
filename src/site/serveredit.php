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
$err_msg='';
$noerror='';
if(isset($_POST['editserver']))
	{
	if(!empty($_POST['newsettings']))
		{
		if($_POST['newsettings']['virtualserver_icon_id']<0)
			{
			$_POST['newsettings']['virtualserver_icon_id']=sprintf('%u', $serverinfo['virtualserver_icon_id'] & 0xffffffff);
			}
		if(!isset($_POST['newsettings']['virtualserver_log_client']) or empty($_POST['newsettings']['virtualserver_log_client']))
			{
			$_POST['newsettings']['virtualserver_log_client']=0;
			}
		if(!isset($_POST['newsettings']['virtualserver_log_query']) or empty($_POST['newsettings']['virtualserver_log_query']))
			{
			$_POST['newsettings']['virtualserver_log_query']=0;
			}
		if(!isset($_POST['newsettings']['virtualserver_log_channel']) or empty($_POST['newsettings']['virtualserver_log_channel']))
			{
			$_POST['newsettings']['virtualserver_log_channel']=0;
			}
		if(!isset($_POST['newsettings']['virtualserver_log_permissions']) or empty($_POST['newsettings']['virtualserver_log_permissions']))
			{
			$_POST['newsettings']['virtualserver_log_permissions']=0;
			}
		if(!isset($_POST['newsettings']['virtualserver_log_server']) or empty($_POST['newsettings']['virtualserver_log_server']))
			{
			$_POST['newsettings']['virtualserver_log_server']=0;
			}
		if(!isset($_POST['newsettings']['virtualserver_log_filetransfer']) or empty($_POST['newsettings']['virtualserver_log_filetransfer']))
			{
			$_POST['newsettings']['virtualserver_log_filetransfer']=0;
			}
		foreach($_POST['newsettings'] AS $key=>$value)
			{
			$server_edit=$ts3->serverEdit(array($key=>$value));
			
			if($server_edit['success']===false)
				{
				for($i=0; $i+1==count($server_edit['errors']); $i++)
					{
					$err_msg .= $server_edit['errors'][$i]."<br />";
					}
				}
			}
		if(empty($err_msg))
			{
			$noerror .= $lang['servereditok'];
			}
			else
			{
			$error .= $lang['editincomplete']."<br />".$err_msg;
			}
		}
	}
if(isset($_POST['editpw']))
	{
	$server_edit=$ts3->serverEdit($_POST['newsettings']);
	if($server_edit['success']!==false)
		{
		$noerror .=$lang['passwordsetok'];
		}
		else
		{
		for($i=0; $i+1==count($server_edit['errors']); $i++)
		{
		$error .= $server_edit['errors'][$i]."<br />";
		}
		}
	}

$serverinfo=$ts3->getElement('data', $ts3->serverInfo());
$servergroups=$ts3->getElement('data', $ts3->serverGroupList());
$channelgroups=$ts3->getElement('data', $ts3->channelGroupList());

//Bearbeitung der Ausgabe!
if(!empty($serverinfo))
	{
	$serverinfo=secure($serverinfo);
	$conv_time=$ts3->convertSecondsToArrayTime($serverinfo['virtualserver_uptime']);
	$serverinfo['virtualserver_uptime']=$conv_time['days'].$lang['days']." ".$conv_time['hours'].$lang['hours']." ".$conv_time['minutes'].$lang['minutes']." ".$conv_time['seconds'].$lang['seconds'];
	
	if($serverinfo['virtualserver_icon_id']<0)
		{
		$serverinfo['virtualserver_icon_id']=sprintf('%u', $serverinfo['virtualserver_icon_id'] & 0xffffffff);
		}
	if($serverinfo['virtualserver_max_upload_total_bandwidth']==18446744073709551615)
		{
		$serverinfo['virtualserver_max_upload_total_bandwidth']=-1;
		}
	if($serverinfo['virtualserver_upload_quota']==18446744073709551615)
		{
		$serverinfo['virtualserver_upload_quota']=-1;
		}
	if($serverinfo['virtualserver_max_download_total_bandwidth']==18446744073709551615)
		{
		$serverinfo['virtualserver_max_download_total_bandwidth']=-1;
		}
	if($serverinfo['virtualserver_download_quota']==18446744073709551615)
		{
		$serverinfo['virtualserver_download_quota']=-1;
		}
	$serverinfo['virtualserver_welcomemessage']=str_replace('\r\n', "\r\n", $serverinfo['virtualserver_welcomemessage']);
	$serverinfo['virtualserver_hostmessage']=str_replace('\r\n', "\r\n", $serverinfo['virtualserver_hostmessage']);
	}
	
if(!empty($servergroups))
	{
	foreach($servergroups AS $key=>$value)
		{
		$servergroups[$key]=secure($servergroups[$key]);
		}
	}
	
if(!empty($channelgroups))
	{
	foreach($channelgroups AS $key=>$value)
		{
		$channelgroups[$key]=secure($channelgroups[$key]);
		}
	}
	

$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("serverinfo", $serverinfo);
$smarty->assign("servergroups", $servergroups);
$smarty->assign("channelgroups", $channelgroups);

} ?>
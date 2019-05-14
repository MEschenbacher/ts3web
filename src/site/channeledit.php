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

$newsettings=array();
if(isset($_POST['editchannelname']))
	{
	$channel_edit=$ts3->channelEdit($cid, $_POST['newsettings']);
	
	if($channel_edit['success']!==false)
		{
		$noerror .= $lang['channelnameeditok']."<br />";
		}
		else
		{
		for($i=0; $i+1==count($channel_edit['errors']); $i++)
			{
			$error .= $channel_edit['errors'][$i]."<br />";
			}
		}
	}
if(isset($_POST['editchannel']))
	{
	if($_POST['chantyp']=='0')
		{
		$_POST['newsettings']['channel_flag_permanent']=0;
		$_POST['newsettings']['channel_flag_semi_permanent']=0;
		}
	if($_POST['chantyp']=='1')
		{
		$_POST['newsettings']['channel_flag_permanent']=0;
		$_POST['newsettings']['channel_flag_semi_permanent']=1;
		}
	elseif($_POST['chantyp']=='2')
		{
		$_POST['newsettings']['channel_flag_permanent']=1;
		$_POST['newsettings']['channel_flag_semi_permanent']=0;
		}
	elseif($_POST['chantyp']=='3')
		{
		$_POST['newsettings']['channel_flag_permanent']=1;
		$_POST['newsettings']['channel_flag_semi_permanent']=0;
		$_POST['newsettings']['channel_flag_default']=1;
		}
	
	$channel_edit=$ts3->channelEdit($cid, $_POST['newsettings']);
	
	if($channel_edit['success']!==false)
		{
		$noerror .= $lang['channeleditok']."<br />";
		}
		else
		{
		for($i=0; $i+1==count($channel_edit['errors']); $i++)
			{
			$error .= $channel_edit['errors'][$i]."<br />";
			}
		}
	}
if(isset($_POST['editpw']))
	{
	
	$channel_edit=$ts3->channelEdit($cid, $_POST['newsettings']);
	
	if($channel_edit['success']!==false)
			{
			$noerror .= $lang['passwordsetok']."<br />";
			}
			else
			{
			for($i=0; $i+1==count($channel_edit['errors']); $i++)
				{
				$error .= $channel_edit['errors'][$i]."<br />";
				}
			}
	}
if(isset($_POST['movechan']))
	{
	$channel_move=$ts3->channelMove($cid, $_POST['move']);
	
	if($channel_move['success']!==false)
		{
		$noerror .= $lang['channelmoveok']."<br />";
		}
		else
		{
		for($i=0; $i+1==count($channel_move['errors']); $i++)
			{
			$error .= $channel_move['errors'][$i]."<br />";
			}
		}
	}
	
$channellist=$ts3->getElement('data', $ts3->channellist());
$channelinfo=$ts3->getElement('data', $ts3->channelInfo($cid));

if(!empty($channellist))
	{
	foreach($channellist AS $key=>$value)
		{
		$channellist[$key]=secure($channellist[$key]);
		}
	}

if(!empty($channelinfo))
	{
	$channelinfo=secure($channelinfo);
	}
	
$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("channellist", $channellist);
$smarty->assign("channelinfo", $channelinfo);
}
?>
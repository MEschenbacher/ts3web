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

$settings=array();
if(isset($_POST['createchannel']))
	{
	if($_POST['chantyp']=='1')
		{
		$_POST['settings']['channel_flag_permanent']=0;
		$_POST['settings']['channel_flag_semi_permanent']=1;
		}
	elseif($_POST['chantyp']=='2')
		{
		$_POST['settings']['channel_flag_permanent']=1;
		$_POST['settings']['channel_flag_semi_permanent']=0;
		}
	elseif($_POST['chantyp']=='3')
		{
		$_POST['settings']['channel_flag_permanent']=1;
		$_POST['settings']['channel_flag_semi_permanent']=0;
		$_POST['settings']['channel_flag_default']=1;
		}
	$channel_create=$ts3->channelCreate($_POST['settings']);
	if($channel_create['success']!==false)
		{
		$noerror .= $lang['channelid'].": ".$channel_create['data']['cid']."<br />";
		$noerror .= $lang['channelcreatedok'];
		}
		else
		{
		for($i=0; $i+1==count($channel_create['errors']); $i++)
			{
			$error .= $channel_create['errors'][$i]."<br />";
			}
		}
	}
	
$channellist=$ts3->getElement('data', $ts3->channellist());

if(!empty($channellist))
	{
	foreach($channellist AS $key=>$value)
		{
		$channellist[$key]=secure($channellist[$key]);
		}
	}

$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);	
$smarty->assign("channellist", $channellist);
} ?>
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
if(isset($_POST['delete']))
	{
	$force=isset($_POST['force']) ? 1:0;
	$channel_delete=$ts3->channelDelete($_POST['cid'], $force);
	if($channel_delete['success']!==false)
		{
		$noerror .= $lang['channeldelok']."<br />";
		}
		else
		{
		for($i=0; $i+1==count($channel_delete['errors']); $i++)
			{
			$error .= $channel_delete['errors'][$i]."<br />";
			}
		}
	}
	
$channellist=$ts3->getElement('data', $ts3->channelList("-topic -flags -voice -limits -icon"));

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
}
?>
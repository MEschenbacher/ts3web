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
if(isset($_POST['addclient']))
	{
	$setclient_cgroup=$ts3->setClientChannelGroup($cgid, $_POST['cid'], $_POST['cldbid']);
	if($setclient_cgroup['success']!==false)
		{
		$noerror .= $lang['clientaddok'];
		}
		else
		{
			for($i=0; $i+1==count($setclient_cgroup['errors']); $i++)
				{
				$error .= $setclient_cgroup['errors'][$i]."<br />";
				}
		}
	}

if(isset($_POST['switchgroup']))
	{
	$setclient_cgroup=$ts3->setClientChannelGroup($_POST['cgid'], $_POST['cid'], $_POST['cldbid']);
	if($setclient_cgroup['success']!==false)
		{
		$noerror .= $lang['clientaddok'];
		}
		else
		{
			for($i=0; $i+1==count($setclient_cgroup['errors']); $i++)
				{
				$error .= $setclient_cgroup['errors'][$i]."<br />";
				}
		}
	}
$channelgroups=$ts3->getElement('data', $ts3->channelGroupList());

$groupclients=$ts3->getElement('data', $ts3->channelGroupClientList('', '', $cgid));

$channellist=$ts3->getElement('data', $ts3->channelList());

$start_while=0;
$duration_while=100;
while($clientdblist=$ts3->getElement('data', $ts3->clientDbList($start_while, $duration_while)))
	{

	if(!empty($groupclients))
		{
		foreach($groupclients AS $key => $value)
			{
			foreach($clientdblist AS $key2=>$value2)
				{
				if($value['cldbid']==$value2['cldbid'])
					{
					$groupclients[$key]['client_unique_identifier']=$value2['client_unique_identifier'];
					$groupclients[$key]['client_nickname']=secure($value2['client_nickname']);
					$groupclients[$key]['client_created']=$value2['client_created'];
					$groupclients[$key]['client_lastconnected']=$value2['client_lastconnected'];
					}
				}
				
			foreach($channellist AS $key3 => $value3)
				{
				if($value['cid'] == $value3['cid'])
					{
					$groupclients[$key]['channel_name']=$value3['channel_name'];
					}
				}
			}
		}
	$start_while=$start_while+$duration_while;
	}
if(isset($_POST['searchby']) AND $_POST['searchby']=='cldbid' AND  !empty($_POST['search']))
	{
	if(!empty($groupclients))
		{
		foreach ($groupclients AS $key => $value)
			{
			if($_POST['search']!=$value['cldbid'])
				{
				unset($groupclients[$key]);
				}
			}
		}
	}
elseif(isset($_POST['searchby']) AND $_POST['searchby']=='name' AND !empty($_POST['search']))
	{
	if(!empty($groupclients))
		{
		foreach ($groupclients AS $key => $value)
			{
			if(strpos(strtolower($value['client_nickname']),strtolower($_POST['search']))===false)
				{
				unset($groupclients[$key]);
				}
			}
		}
	}	

foreach($channelgroups AS $key=>$value)
	{
	$channelgroups[$key]=secure($channelgroups[$key]);
	if($cgid==$value['cgid'])
		{
		$cgroupid=$value['cgid'];
		$cgroupname=secure($value['name']);
		}
	}
}

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
$smarty->assign("groupclients", $groupclients);
$smarty->assign("channelgroups", $channelgroups);
$smarty->assign("cgroupid", $cgroupid);
$smarty->assign("cgroupname", $cgroupname);
?>
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

if(isset($_POST['kickclient']))
	{
	$sgroup_del_client=$ts3->serverGroupDeleteClient($sgid, $_POST['cldbid']);
	if($sgroup_del_client['success']!==false)
		{
		$noerror .= $lang['clientremoveok']."<br />";
		}
		else
		{
		for($i=0; $i+1==count($sgroup_del_client['errors']); $i++)
			{
			$error .= $sgroup_del_client['errors'][$i]."<br />";
			}
		}
	}
if(isset($_POST['addclient']))
	{
	$sgroup_add_client=$ts3->serverGroupAddClient($sgid, $_POST['cldbid']);
	if($sgroup_add_client['success']!==false)
		{
		$noerror .= $lang['clientaddok']."<br />";
		}
		else
		{
		for($i=0; $i+1==count($sgroup_add_client['errors']); $i++)
			{
			$error .= $sgroup_add_client['errors'][$i]."<br />";
			}
		}
	}
$servergroups=$ts3->getElement('data', $ts3->serverGroupList());

$groupclients=$ts3->getElement('data', $ts3->serverGroupClientList($sgid, true));
foreach($servergroups AS $value)
	{
	if($sgid==$value['sgid'])
		{
		$sgroupid=$value['sgid'];
		$sgroupname=$value['name'];
		}
	}
$start_while=0;
$duration_while=100;
if(!isset($groupclients[0]['']) AND !empty($groupclients))
	{
	while($clientdblist=$ts3->getElement('data', $ts3->clientDbList($start_while, $duration_while)))
		{
		foreach($groupclients AS $key=>$value)
			{
			foreach($clientdblist AS $value2)	
				{
				if($value['cldbid']==$value2['cldbid'])
					{
					$groupclients[$key]['client_unique_identifier']=$value2['client_unique_identifier'];
					$groupclients[$key]['client_nickname']=secure($value2['client_nickname']);
					$groupclients[$key]['client_created']=$value2['client_created'];
					$groupclients[$key]['client_lastconnected']=$value2['client_lastconnected'];
					}
				}

			}
		$start_while=$start_while+$duration_while;
		}
	}
	elseif(isset($groupclients[0]['']))
		{
		unset ($groupclients);
		}

if(isset($_POST['searchby']) AND $_POST['searchby']=='cldbid' AND  !empty($_POST['search']) AND !empty($groupclients))
	{
	foreach ($groupclients AS $key => $value)
		{
		if($_POST['search']!=$value['cldbid'])
			{
			unset($groupclients[$key]);
			}
		}
	}
elseif(isset($_POST['searchby']) AND $_POST['searchby']=='name' AND !empty($_POST['search']) AND !empty($groupclients))
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


$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("sgroupid", $sgroupid);
$smarty->assign("sgroupname", secure($sgroupname));
$smarty->assign("groupclients", $groupclients);
?>
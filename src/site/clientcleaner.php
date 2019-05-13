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
$currentDeleted=0;
$sgrouplist=$ts3->getElement('data', $ts3->serverGroupList());
//$cgrouplist=$ts3->getElement('data', $ts3->channelGroupList());

if(isset($_REQUEST['cleanit']))
	{
	if(isset($_POST['sgroups']))
		{
		$protectedgroups=$_POST['sgroups'];
		}
	elseif(isset($_GET['protectedgroups']) AND !empty($_GET['protectedgroups']))
		{
		$protectedgroups=explode(',', $_GET['protectedgroups']);
		}
	$deleted=isset($_GET['deleted']) ? $_GET['deleted']:0;
	$timetodelete=time()-($_REQUEST['number']*86400);
	$clientdblist=array();
	$start=isset($_GET['start']) ? $_GET['start']:0;

	$getclientdblist=$ts3->getElement('data', $ts3->clientDbList($start, 50));
	if(!empty($getclientdblist))
		{
		$clientdblist=$getclientdblist;
		$start=$start+50;
		
		if(isset($protectedgroups))
		{
		foreach($clientdblist AS $key=>$value)
			{
			$clientdblist[$key]['sgroups']=$ts3->getElement('data', $ts3->serverGroupsByClientID($value['cldbid']));
			}	
		}
		
		foreach($clientdblist AS $key=>$value)
			{
			$protected=true;
			if($value['client_lastconnected']<=$timetodelete)
				{
				$protected=false;
				if(isset($protectedgroups))
					{
					foreach($value['sgroups'] AS $key2=>$value2)
						{
						if(in_array($value2['sgid'], $protectedgroups))
							{
							$protected=true;
							}
						}
					}
				if($protected===false)
					{
					if($ts3->getElement('success', $ts3->clientDbDelete($value['cldbid'])))
						{
						$currentDeleted++;
						$deleted++;
						}
					}
				}
			}	
			if(isset($protectedgroups))
				{
				$protectedgroups=implode(',', $protectedgroups);
				}
			$start=$start-$currentDeleted;
			echo "<img src=\"../gfx/images/away.png\" onLoad=\"document.location.href='index.php?site=clientcleaner&amp;sid=".$_GET['sid']."&amp;start=".$start."&amp;deleted=".$deleted."&amp;protectedgroups=".$protectedgroups."&amp;number=".$_REQUEST['number']."&amp;cleanit=1'\">";
		}
	}

if(!empty($deleted))
	{
	$deleted=sprintf($lang['countdelclients'], $deleted);
	$smarty->assign('deleted', $deleted);
	}
$smarty->assign('sgrouplist', $sgrouplist);



?>
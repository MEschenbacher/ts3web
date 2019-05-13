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

$sortby="cldbid";
$sorttype=SORT_ASC;

if(empty($duration))
	{
	$duration=25;
	}
	
if(isset($_GET['start']))
	{
	$start=$_GET['start'];
	}
	else
	{
	$start=0;
	}
if(($start-$duration)<0)
	{
	$start=0;
	}
	
if(isset($_GET['sortby']))
	{
	if($_GET['sortby']=="cldbid")
		{
		$sortby="cldbid";
		}
		elseif($_GET['sortby']=="status")	
		{
		$sortby="clid";
		}
		elseif($_GET['sortby']=="name")
		{
		$sortby="client_nickname";
		}
		elseif($_GET['sortby']=="unique")
		{
		$sortby="client_unique_identifier";
		}
		elseif($_GET['sortby']=="created")
		{
		$sortby="client_created";
		}
		elseif($_GET['sortby']=="lastcon")
		{
		$sortby="client_lastconnected";
		}
		else
		{
		$sortby="cldbid";
		}
	}

if(isset($_GET['sorttype']))
	{
	if($_GET['sorttype']=="asc")
		{
		$sorttype=SORT_ASC;
		}
	elseif($_GET['sorttype']=="desc")
		{
		$sorttype=SORT_DESC;
		}
	}

if(isset($_POST['clientdel']))
	{
	$client_delete=$ts3->clientDbDelete($_POST['cldbid']);
	if($client_delete['succes']!==false)
		{
		echo "<tr><td colspan=\"4\" class=\"green1\">".$lang['clientdeletedok']."</td></tr>";
		}
		else
		{
		echo "<tr><td colspan=\"4\" class=\"green1\">";
		for($i=0; $i+1==count($client_delete['errors']); $i++)
			{
			echo $client_delete['errors'][$i]."<br />";
			}
		echo "</td></tr>";
		}
	}

$clientdblist=array();
while($getclientdblist=$ts3->getElement('data', $ts3->clientDbList($start, $duration)))
	{
	$clientdblist=array_merge($clientdblist, $getclientdblist);
	$start=$start+$duration;
	}


$clientlist=$ts3->getElement('data', $ts3->clientList());
$countclients=count($clientdblist);

$pages=$countclients/$duration;
if(floor($pages)!=0)
	{
	$pages=ceil($pages);
	}
	

if(isset($_POST['searchby']) AND $_POST['searchby']=='cldbid' AND  !empty($_POST['search']))
	{
	foreach ($clientdblist AS $key => $value)
		{
		if($_POST['search']!=$value['cldbid'])
			{
			unset($clientdblist[$key]);
			}
		}
	}
elseif(isset($_POST['searchby']) AND $_POST['searchby']=='name' AND !empty($_POST['search']))
	{

	foreach ($clientdblist AS $key => $value)
		{
		if(strpos(strtolower($value['client_nickname']),strtolower($_POST['search']))===false)
			{
			unset($clientdblist[$key]);
			}
		}
	}
	
if(!empty($clientdblist))
	{
	
	foreach($clientdblist AS $key => $value)
		{
		if(!empty($clientlist))
			{
			foreach($clientlist AS $key2 => $value2)
				{
				if($value['cldbid'] == $value2['client_database_id'])
					{
					$clientdblist[$key]['clid']=$value2['clid'];
					$clientdblist[$key]['cid']=$value2['cid'];
					}
				}
			}
		}
	}

$countstarted=0;
$print_pages=1;
if(!isset($_GET['getstart']))
		{
		$getstart=0;
		}
		else
		{
		$getstart=$_GET['getstart'];
		}
		
if(isset($_POST['searchby']) AND $_POST['searchby']=='cldbid' AND  !empty($_POST['search']) AND !empty($clientdblist))
	{
	foreach ($clientdblist AS $key => $value)
		{
		if($_POST['search']!=$value['cldbid'])
			{
			unset($clientdblist[$key]);
			}
		}
	}
elseif(isset($_POST['searchby']) AND $_POST['searchby']=='name' AND !empty($_POST['search']) AND !empty($clientdblist))
	{
	foreach ($clientdblist AS $key => $value)
		{
		if(strpos(strtolower($value['client_nickname']),strtolower($_POST['search']))===false)
			{
			unset($clientdblist[$key]);
			}
		}
	}
elseif(isset($_POST['searchby']) AND $_POST['searchby']=='uniqueid' AND !empty($_POST['search']) AND !empty($clientdblist))
	{
	foreach ($clientdblist AS $key => $value)
		{
		if($value['client_unique_identifier']!=$_POST['search'])
			{
			unset($clientdblist[$key]);
			}
		}
	}
$showclients=1;
if(!empty($clientdblist))
	{
	foreach($clientdblist AS $key=>$value)
		{
		$clientdblist[$key]=secure($clientdblist[$key]);
		
		$sort[]=$value[$sortby];
		}

	array_multisort($sort, $sorttype, $clientdblist);
	}
}

$smarty->assign("sortby", $sortby);
$smarty->assign("sorttype", $sorttype);
$smarty->assign("duration", $duration);
$smarty->assign("pages", $pages);
$smarty->assign("getstart", $getstart);
$smarty->assign("countstarted", $countstarted);
$smarty->assign("showclients", $showclients);
$smarty->assign("print_pages", $print_pages);
$smarty->assign("clientdblist", $clientdblist);
?>
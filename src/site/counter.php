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

$i=0;
$start_while=0;
$duration_while=1;
$count_online=0;
$count_today=0;
$count_week=0;
$count_month=0;
$perc_online=0;
$perc_today=0;
$perc_week=0;
$perc_month=0;
$totalclients='';

if(date("w")==0)
	{
	$dayofweek=6;
	}
	else
	{
	$dayofweek=date("w")-1;
	}
$thisday=mktime(0,0,0,date("n"),date("d"),date("Y"));
$thisweek=mktime(0,0,0,date("n"),date("j")-$dayofweek,date("Y"));
$thismonth=mktime(0,0,0,date("n"),1,date("Y"));

$clientlist=$ts3->getElement('data', $ts3->clientList());

while($clientdblist=$ts3->getElement('data', $ts3->clientDbList($start_while, $duration_while)))
	{
	foreach($clientdblist AS $key=>$value)
		{
		if(!empty($clientlist))
			{
			foreach($clientlist AS $key2=>$value2)
				{
				if($value['cldbid']==$value2['client_database_id'])
					{
					$clientstatuslist[$i]['online']=1;
					}
				}
			}
		$clientstatuslist[$i]['cldbid']=$value['cldbid'];
		$clientstatuslist[$i]['client_lastconnected']=$value['client_lastconnected'];
		$i++;	
		}
	$start_while=$start_while+$duration_while;
	}
$totalclients=count($clientstatuslist);



if(!empty($clientstatuslist))
	{
	foreach($clientstatuslist AS $key => $value)
		{
		if(isset($value['online']))
			{
			$count_online++;
			}
		if($value['client_lastconnected']>=$thisday)
			{
			$count_today++;
			}
		if($value['client_lastconnected']>=$thisweek)
			{
			$count_week++;
			}
		if($value['client_lastconnected']>=$thismonth)
			{
			$count_month++;
			}
		}
	if(!empty($count_online))
		{
		$perc_online=round(100*$count_online/$totalclients);
		}
	if(!empty($count_today))
		{
		$perc_today=round(100*$count_today/$totalclients);
		}
	if(!empty($count_week))
		{
		$perc_week=round(100*$count_week/$totalclients);
		}
	if(!empty($count_month))
		{
		$perc_month=round(100*$count_month/$totalclients);
		}
	}
	
$smarty->assign("count_online", $count_online);
$smarty->assign("count_today", $count_today);
$smarty->assign("count_week", $count_week);
$smarty->assign("count_month", $count_month);
$smarty->assign("perc_online", $perc_online);
$smarty->assign("perc_today", $perc_today);
$smarty->assign("perc_week", $perc_week);
$smarty->assign("perc_month", $perc_month);
$smarty->assign("totalclients", $totalclients);

?>
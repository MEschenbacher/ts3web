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
$banlist=$ts3->getElement('data', $ts3->banList());

$banexport='';
if(!empty($banlist))
	{
	foreach($banlist AS $value)
		{
		if(isset($value['ip']) AND !empty($value['ip']))
			{
			$bantype="ip=".$value['ip'];
			}
		elseif(isset($value['name']) AND !empty($value['name']))
			{
			$bantype="name=".$value['name'];
			}
		elseif(isset($value['uid']) AND !empty($value['uid']))
			{
			$bantype="uid=".$value['uid'];
			}
			
		if(!isset($value['duration']))
			{
			$banlength=0;
			}
			else
			{
			$banlength=$value['duration'];
			}
			
		$banexport.="banadd ".$bantype." time=".$banlength." banreason=".str_replace(' ', '\s', $value['reason'])."\n";
	
		}
	} 
	
$smarty->assign("banexport", secure($banexport));
}
?>
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
if($fastswitch==true AND $hoststatus==true AND $loginstatus!==false AND !empty($sid) OR $fastswitch==true AND $loginstatus!==false AND !empty($sid))
	{
	$serverlist=$ts3->getElement('data', $ts3->serverList());
	if(!empty($serverlist))
		{
		foreach($serverlist AS $key=>$value)
			{
			$serverlist[$key]=secure($serverlist[$key]);
			}
		}
	$smarty->assign("fastswitch", true);
	$smarty->assign("serverlist", $serverlist);
	} 
?>
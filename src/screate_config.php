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


$screate_tmp['name']="";							// Server Name
$screate_tmp['port']="";							// Server Port
$screate_tmp['minclientversion']="";				// Min. Client Version
$screate_tmp['welcomemsg']="";						// Welcome Message
$screate_tmp['maxclients']="";						// Max clients
$screate_tmp['reservedslots']="";					// Reserved slots
$screate_tmp['showonweblist']="";					// Show on weblist no=0 yes=1
$screate_tmp['password']="";						// Server Password
$screate_tmp['securitylvl']="";						// Security level
$screate_tmp['forcesilence']="";					// Min. number of clients in the channel to force for silence:

$screate_tmp['hostmsg']="";							// Host message
$screate_tmp['hostmsgshow']="";						// Host message show 0=No message 1=Show message in Log 2=Show modal message 3=Modal message and exit
$screate_tmp['hosturl']="";							// Host Url
$screate_tmp['hostbannerurl']="";					// Hostbanner Url
$screate_tmp['hostbannerint']="";					// Hostbanner Interval
$screate_tmp['hostbuttongfx']="";					// Host button gfx url
$screate_tmp['hostbuttontip']="";					// Host button tooltip
$screate_tmp['hostbuttonurl']="";					// Host button url

$screate_tmp['autobancount']="";					// Autoban count
$screate_tmp['autobantime']="";						// Autoban time
$screate_tmp['removetime']="";						// Remove time

$screate_tmp['pointstickreduce']="";				// Points tick reduce
$screate_tmp['pointsneededblockcmd']="";			// Points needed warning
$screate_tmp['pointsneededblockip']="";				// Points needed kick

$screate_tmp['uploadbandwidthlimit']="";			// Upload Bandwidth Limit  unlimited = -1
$screate_tmp['uploadquota']="";						// Upload Quota  unlimited = -1
$screate_tmp['downloadbandwidthlimit']="";			// Download Bandwidth Limit:  unlimited = -1
$screate_tmp['downloadquota']="";					// Download Quota  unlimited = -1

$screate_tmp['virtualserver_log_client']="";		// Log Clients no=0 yes=1
$screate_tmp['virtualserver_log_query']="";			// Log Query no=0 yes=1
$screate_tmp['virtualserver_log_channel']="";		// Log Channel no=0 yes=1
$screate_tmp['virtualserver_log_permissions']="";	// Log Permissions no=0 yes=1
$screate_tmp['virtualserver_log_server']="";		// Log Server no=0 yes=1
$screate_tmp['virtualserver_log_filetransfer']="";	// Log Filetransfer no=0 yes=1

?>
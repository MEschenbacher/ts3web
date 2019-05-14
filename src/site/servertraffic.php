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
if(!isset($sid))
	{
	$hostinfo=$ts3->getElement('data', $ts3->hostInfo());
	if(!empty($hostinfo))
		{
		$hostinfo['connection_bytes_received_total']=conv_traffic($hostinfo['connection_bytes_received_total']);
		$hostinfo['connection_bytes_sent_total']=conv_traffic($hostinfo['connection_bytes_sent_total']);
		$hostinfo['connection_bandwidth_received_last_second_total']=conv_traffic($hostinfo['connection_bandwidth_received_last_second_total']);
		$hostinfo['connection_bandwidth_sent_last_second_total']=conv_traffic($hostinfo['connection_bandwidth_sent_last_second_total']);
		$hostinfo['connection_bandwidth_received_last_minute_total']=conv_traffic($hostinfo['connection_bandwidth_received_last_minute_total']);
		$hostinfo['connection_bandwidth_sent_last_minute_total']=conv_traffic($hostinfo['connection_bandwidth_sent_last_minute_total']);
		$hostinfo['connection_filetransfer_bandwidth_received']=conv_traffic($hostinfo['connection_filetransfer_bandwidth_received']);
		$hostinfo['connection_filetransfer_bandwidth_sent']=conv_traffic($hostinfo['connection_filetransfer_bandwidth_sent']);
		}
	$smarty->assign("hostinfo", $hostinfo);
	} 
	else
	{
	$serverinfo=$ts3->getElement('data', $ts3->serverInfo());
	if(!empty($serverinfo))
		{
		$serverinfo['connection_bytes_received_total']=conv_traffic($serverinfo['connection_bytes_received_total']);
		$serverinfo['connection_bytes_sent_total']=conv_traffic($serverinfo['connection_bytes_sent_total']);
		$serverinfo['connection_bandwidth_received_last_second_total']=conv_traffic($serverinfo['connection_bandwidth_received_last_second_total']);
		$serverinfo['connection_bandwidth_sent_last_second_total']=conv_traffic($serverinfo['connection_bandwidth_sent_last_second_total']);
		$serverinfo['connection_bandwidth_received_last_minute_total']=conv_traffic($serverinfo['connection_bandwidth_received_last_minute_total']);
		$serverinfo['connection_bandwidth_sent_last_minute_total']=conv_traffic($serverinfo['connection_bandwidth_sent_last_minute_total']);
		$serverinfo['connection_filetransfer_bandwidth_received']=conv_traffic($serverinfo['connection_filetransfer_bandwidth_received']);
		$serverinfo['connection_filetransfer_bandwidth_sent']=conv_traffic($serverinfo['connection_filetransfer_bandwidth_sent']);
		}
	$smarty->assign("serverinfo", $serverinfo);
	}
?>
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
if(isset($_POST['give']))
	{
	session_start();
	require_once('../ts3admin.class.php');
	$sqlstring='';
	$ts3=new ts3admin($_SESSION['server_ip'], $_SESSION['server_tport']);
	$ts3->connect();
	$ts3->login($_SESSION['loginuser'], unserialize(base64_decode($_SESSION['loginpw'])));
	$ts3->selectServer($_POST['sid'], 'serverId');

	$start=0;
	$duration=1000;
	while($clients=$ts3->getElement('data', $ts3->clientDbList($start, $duration)))
		{
		foreach($clients AS $client)
			{
			if($client['client_unique_identifier']!="ServerQuery")
				{
				$sqlstring.="INSERT INTO \"clients\" (server_id, client_unique_id, client_nickname) VALUES (".$_POST['sid'].",'".$client['client_unique_identifier']."','".$client['client_nickname']."');\n";
				}
			}
		$start=$start + $duration;
		}
	header('Content-Disposition: attachment; filename="clientbackup.sql"');
	header('Content-Type: x-type/subtype');
	echo $sqlstring;
	}
?>
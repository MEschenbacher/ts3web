<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
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
*You should have received a copy of the GNU General Public License along with this program; if not, see http://www.gnu.org/licenses/. 
-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="de">
<head>
<title>Teamspeak 3 - Webinterface</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="templates/{$tmpl}/gfx/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="templates/{$tmpl}/gfx/tsview.css" type="text/css" media="screen" />
<script type="text/javascript">
//<![CDATA[
function Klappen(Id) 
	{
	
	if(Id == 0)
		{
		var i = 1;
		var jetec_Minus="gfx/images/minus.png", jetec_Plus="gfx/images/plus.png";
		
		if(document.getElementById('Pic0').name == 'plus')
			{
			document.getElementById('Pic0').src = jetec_Minus;
			document.getElementById('Pic0').name = 'minus';
			var openAll = 1;
			}
			else
			{
			document.getElementById('Pic0').src = jetec_Plus;
			document.getElementById('Pic0').name = 'plus';
			var openAll = 0;
			}
		while(i<100)
			{
			if(document.getElementById('Pic'+i)!=null)
				{
				var KlappText = document.getElementById('Lay'+i);
				var KlappBild = document.getElementById('Pic'+i);
				if (openAll == 1) 
					{
					KlappText.style.display = 'block';
					KlappBild.src = jetec_Minus;
					} 
					else 
					{
					KlappText.style.display = 'none';
					KlappBild.src = jetec_Plus;
					}
				i++;
				}
				else
				{
				break;
				}
			}
		}
	var KlappText = document.getElementById('Lay'+Id);
	var KlappBild = document.getElementById('Pic'+Id);
	var jetec_Minus="gfx/images/minus.png", jetec_Plus="gfx/images/plus.png";
	if (KlappText.style.display == 'none') 
		{
		KlappText.style.display = 'block';
		KlappBild.src = jetec_Minus;
		} 
		else 
		{
		KlappText.style.display = 'none';
		KlappBild.src = jetec_Plus;
		}
	}
	
function oeffnefenster (url) {
 fenster = window.open(url, "fenster1", "width=350,height=150,status=no,scrollbars=yes,resizable=no");
 fenster.opener.name="opener";
 fenster.focus();
}

function hide_select(selectId)
	{
	if(selectId==0)
		{
		document.getElementById("groups").style.display = "";
		document.getElementById("servergroups").style.display = "";
		document.getElementById("channelgroups").style.display = "none";
		document.getElementById("channel").style.display = "none";
		}
	  else if (selectId==1)
		{
		document.getElementById("groups").style.display = "";
		document.getElementById("servergroups").style.display = "none";
		document.getElementById("channelgroups").style.display = "";
		document.getElementById("channel").style.display = "";
		}
		else
		{
		document.getElementById("groups").style.display = "none";
		document.getElementById("servergroups").style.display = "none";
		document.getElementById("channelgroups").style.display = "none";
		document.getElementById("channel").style.display = "none";
		}
	}

var checkflag = "false";

function check(form) 
	{
	if (checkflag == "false") 
		{
		for (i = 0; i < document.forms[form].elements.length; i++) 
			{
			if(document.forms[form].elements[i].name != 'checkall')
				{
				document.forms[form].elements[i].checked = true;
				}
			}
		checkflag = "true";
		return checkflag; 
		}
		else 
		{
		for (i = 0; i < document.forms[form].elements.length; i++) 
			{
				document.forms[form].elements[i].checked = false;
			}
		checkflag = "false";
		return checkflag; 
		}
	}
var conf_arr = new Array();
function confirmArray(sid, name, port, action)
	{
	conf_arr[sid]=new Object();
	conf_arr[sid]['name']=name;
	conf_arr[sid]['port']=port;
	if(document.getElementById("caction"+sid).options.selectedIndex == 0)
		{
		conf_arr[sid]['action']='';
		}
		else if(document.getElementById("caction"+sid).options.selectedIndex == 1)
		{
		conf_arr[sid]['action']='start';
		}
		else if(document.getElementById("caction"+sid).options.selectedIndex == 2)
		{
		conf_arr[sid]['action']='stop';
		}
		else if(document.getElementById("caction"+sid).options.selectedIndex == 3)
		{
		conf_arr[sid]['action']='del';
		}
	}
	
function confirmAction()
	{
	var text="Möchtest du folgende Aktion wirklich ausführen?\n\n";
	for(var i in conf_arr)
		{
		if(conf_arr[i]['action'] == 'start')
			{
			text = text+"***Starten*** "+conf_arr[i]['name']+" "+conf_arr[i]['port']+"\n";
			}
			else if(conf_arr[i]['action'] == 'stop')
			{
			text = text+"***Stoppen*** "+conf_arr[i]['name']+" "+conf_arr[i]['port']+"\n";
			}
			else if(conf_arr[i]['action'] == 'del')
			{
			text = text+"***Löschen*** "+conf_arr[i]['name']+" "+conf_arr[i]['port']+"\n";
			}
		}
	return text;
	}
//]]>
</script>
</head>
<body>
<table align="center" class="border" style="width:1000px; background-color:#FFFFFF;" cellpadding="1" cellspacing="0">
	<tr>
		<td colspan="2">{include file="{$tmpl}/head.tpl"}</td>
	</tr>
	{include file="{$tmpl}/showupdate.tpl"}
	<tr valign="top">	
		{include file="{$tmpl}/mainbar.tpl"}
		<td align="center">
		{include file="{$tmpl}/{$site}.tpl"}
		</td>
	</tr>
	<tr>
		<td colspan="2" class="footer">
		{$footer}
		powered by <a href='http://www.ts-rent.de'>www.TS-Rent.de</a><br />This interface contains images from <a href='http://www.teamspeak.com'>www.teamspeak.com</a>.<br />
       <a href='http://www.psychoscripts.de/donate.php'><img alt="" border="0" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donate_SM.gif" width="86" height="21"></a>
		</td>
	</tr>
</table>
<script language="JavaScript" type="text/javascript" src="gfx/js/wz_tooltip.js"></script>
</body>
</html>
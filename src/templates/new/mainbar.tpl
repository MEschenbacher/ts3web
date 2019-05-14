{if $loginstatus === true AND $site !==login}
<td style="width:100px" >
<table style="width:100px" class="border" cellpadding="1" cellspacing="0">
	<tr><td style="width:100px" class="maincat">{$lang['server']}</td></tr>
	{if $hoststatus === true}
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=server">{$lang['serverlist']}</a></td></tr>
	{/if}
	{if !isset($sid) AND $hoststatus === true}
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=createserver">{$lang['createserver']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=servertraffic">{$lang['instancetraffic']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=instanceedit">{$lang['instanceedit']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=logview">{$lang['logview']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=iserverbackup">{$lang['instancebackup']}</a></td></tr>
		{/if}
	{if isset($sid)}
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=serverview&amp;sid={$sid}">{$lang['serverview']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=servertraffic&amp;sid={$sid}">{$lang['virtualtraffic']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=serveredit&amp;sid={$sid}">{$lang['serveredit']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=temppw&amp;sid={$sid}">{$lang['temppw']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=fileupload&amp;sid={$sid}">{$lang['iconupload']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=logview&amp;sid={$sid}">{$lang['logview']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=filelist&amp;sid={$sid}">{$lang['filelist']}</a></td></tr>				
		<tr><td class="green1"><a class="mainbarlink" href="javascript:oeffnefenster('site/interactive.php?sid={$sid}&amp;action=action');">{$lang['massaction']}</a></td></tr>
		<tr><td class="maincat">{$lang['channel']}</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=channel&amp;sid={$sid}">{$lang['channellist']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=createchannel&amp;sid={$sid}">{$lang['createchannel']}</a></td></tr>
		{if isset($cid)}
			<tr><td class="green1"><a class="mainbarlink" href="index.php?site=channelview&amp;sid={$sid}&amp;cid={$cid}">{$lang['channelview']}</a></td></tr>
			<tr><td class="green2"><a class="mainbarlink" href="index.php?site=channeledit&amp;sid={$sid}&amp;cid={$cid}">{$lang['channeledit']}</a></td></tr>
		{/if}
		<tr><td class="maincat">{$lang['clients']}</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=counter&amp;sid={$sid}">{$lang['clientcounter']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=clients&amp;sid={$sid}">{$lang['clientlist']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=complainlist&amp;sid={$sid}">{$lang['complainlist']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=chanclienteditperm&amp;sid={$sid}">{$lang['chanclientperms']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=clientcleaner&amp;sid={$sid}">{$lang['clientcleaner']}</a></td></tr>		
		
		<tr><td class="maincat">{$lang['bans']}</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=banlist&amp;sid={$sid}">{$lang['banlist']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=banadd&amp;sid={$sid}">{$lang['addban']}</a></td></tr>
		
		<tr><td class="maincat">{$lang['groups']}</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=sgroups&amp;sid={$sid}">{$lang['servergroups']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=sgroupadd&amp;sid={$sid}">{$lang['addservergroup']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=cgroups&amp;sid={$sid}">{$lang['channelgroups']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=cgroupadd&amp;sid={$sid}">{$lang['addchannelgroup']}</a></td></tr>
		
		<tr><td class="maincat">{$lang['token']}</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=token&amp;sid={$sid}">{$lang['token']}</a></td></tr>
		
		<tr><td class="maincat">{$lang['backup']}</td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=backup&amp;sid={$sid}">{$lang['chanbackups']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=serverbackup&amp;sid={$sid}">{$lang['serverbackups']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=permexport&amp;sid={$sid}">{$lang['permexport']}</a></td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=clientsexport&amp;sid={$sid}">{$lang['clientsexport']}</a></td></tr>
		<tr><td class="green2"><a class="mainbarlink" href="index.php?site=bansexport&amp;sid={$sid}">{$lang['bansexport']}</a></td></tr>
		
		<tr><td class="maincat">{$lang['console']}</td></tr>
		<tr><td class="green1"><a class="mainbarlink" href="index.php?site=console&amp;sid={$sid}">{$lang['queryconsole']}</a></td></tr>
		{/if}
</table>
</td>
{/if}
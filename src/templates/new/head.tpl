<table border="0" style="width:1000px; height:150px" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td class="header">
		<table style="width:100%; height:150px;" cellpadding="0" cellspacing="0">
			<tr valign="top">
				<td style="width:500px"></td>
				<td>
				<table align="right" style="width:100%; height:150px;" cellpadding="0" cellspacing="0">
					<tr valign="top">
						<td style="text-align:right; height:120px">
						{if $loginstatus === true}
							{$smarty.session.loginuser} <a href="index.php?site=logout">{$lang['logout']}</a>
						{/if}
						</td>
					</tr>
					<tr>
						<td style="text-align:right; height:30px">
						{if $fastswitch == true AND $hoststatus === true}
							<form method="get" action="index.php?site=serverview">
							{if strpos($site, 'edit') == false OR $site == serveredit}
							<input type="hidden" name="site" value="{$site}" />
							{else}
							<input type="hidden" name="site" value="serverview" />
							{/if}
							<select name="sid" onchange="submit()">
							{foreach key=key item=server from=$serverlist}
								{if $sid == $server['virtualserver_id']}
								<option selected="selected" value="{$server['virtualserver_id']}">{$server['virtualserver_name']}-{$server['virtualserver_port']}</option>
								{else}
								<option value="{$server['virtualserver_id']}">{$server['virtualserver_name']}-{$server['virtualserver_port']}</option>
								{/if}
							{/foreach}
							</select>
							</form>
						{/if}
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
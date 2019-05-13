{if isset($permoverview['b_virtualserver_client_list']) AND empty($permoverview['b_virtualserver_client_list']) OR isset($permoverview['b_virtualserver_client_dblist']) AND empty($permoverview['b_virtualserver_client_dblist'])}
	<table class="border" style="width:50%;" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead">{$lang['error']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['nopermissions']}</td>
		</tr>
	</table>
{else}
<table style="width:50%" align="center" class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td style="width:100%" class="thead" colspan="2">{$lang['clientcounter']}</td>
	</tr>
	<tr>
		<td style="width:50%" class="green1">{$lang['total']}</td>
		<td style="width:50%" class="green1">{$totalclients} {$lang['clients']}</td>
	</tr>
	<tr>
		<td class="green2">{$lang['online']}</td>
		<td class="green2">
		<img src="templates/default/gfx/images/stats.png"  height="10" width="{$perc_online}" alt="" />
		{$count_online} {$lang['clients']} | {$perc_online}%
		</td>
	</tr>
	<tr>
		<td class="green1">{$lang['today']}</td>
		<td class="green1">
		<img src="templates/default/gfx/images/stats.png"  height="10" width="{$perc_today}" alt="" />
		{$count_today} {$lang['clients']} | {$perc_today}%
		</td>
	</tr>
	<tr>
		<td class="green2">{$lang['thisweek']}</td>
		<td class="green2">
		<img src="templates/default/gfx/images/stats.png"  height="10" width="{$perc_week}" alt="" />
		{$count_week} {$lang['clients']} | {$perc_week}%
		</td>
	</tr>
	<tr>
		<td class="green1">{$lang['thismonth']}</td>
		<td class="green1">
		<img src="templates/default/gfx/images/stats.png"  height="10" width="{$perc_month}" alt="" />
		{$count_month} {$lang['clients']} | {$perc_month}%
		</td>
	</tr>
</table>
{/if}
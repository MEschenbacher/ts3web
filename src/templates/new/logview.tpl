{if isset($permoverview['b_virtualserver_log_view']) AND empty($permoverview['b_virtualserver_log_view'])}
	<table class="border" style="width:50%;" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead">{$lang['error']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['nopermissions']}</td>
		</tr>
	</table>
{else}
<br />
<table class="border" style="width:90%" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<form method="post" action="index.php?site=logview&amp;sid={$sid}">
			<input type="hidden" name="begin_pos" value="{$begin_pos}"/>
			<input type="submit" name="showmore" value="{$lang['showmoreentrys']}" />
			</form>
		</td>
	</tr>
	<tr>
		<td style="width:20%" class="thead">{$lang['date']}</td>
		<td style="width:5%" class="thead">{$lang['level']}</td>
		<td style="width:10%" class="thead">{$lang['type']}</td>
		<td style="width:10%" class="thead">{$lang['serverid']}</td>
		<td style="width:55%" class="thead">{$lang['message']}</td>
	</tr>

{if !empty($serverlog)}
	{foreach key=key item=value from=$serverlog}
		{if empty($smarty.post.type.error) AND empty($smarty.post.type.warning) AND empty($smarty.post.type.debug) AND empty($smarty.post.type.info) OR $smarty.post.type.error == $value['level'] OR $smarty.post.type.warning == $value['level'] OR $smarty.post.type.debug == $value['level'] OR $smarty.post.type.info == $value['level']}
			{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
			<tr>
				<td class="{$td_col}">{$value[0]}</td>
				<td class="{$td_col}">{$value[1]}</td>
				<td class="{$td_col}">{$value[2]}</td>
				<td class="{$td_col}">{$value[3]}</td>
				<td class="{$td_col}">{$value[4]}</td>
			</tr>
		
			{assign var=change_col value="`$change_col+1`"}
		{/if}
	{/foreach}
{/if}
	<tr>
		<td>
			<form method="post" action="index.php?site=logview&amp;sid={$sid}">
			<input type="hidden" name="begin_pos" value="{$begin_pos}"/>
			<input type="submit" name="showmore" value="{$lang['showmoreentrys']}" />
			</form>
		</td>
	</tr>
</table>
{/if}
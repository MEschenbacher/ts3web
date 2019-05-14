{if isset($permoverview['b_client_complain_list']) AND empty($permoverview['b_client_complain_list'])}
	<table class="border" style="width:50%;" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead">{$lang['error']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['nopermissions']}</td>
		</tr>
	</table>
{else}
<table style="width:892px" class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="4">{$lang['complainlist']}</td>
	</tr>
	<tr>
		<td class="thead" style="width:223px">{$lang['targetnick']}</td>
		<td class="thead" style="width:223px">{$lang['sourcenick']}</td>
		<td class="thead" style="width:223px">{$lang['reason']}</td>
		<td class="thead" style="width:223px">{$lang['option']}</td>
	</tr>
		{assign var=i value="1"}
		{foreach key=key item=value from=$newcomplainlist}
			{foreach key=key2 item=value2 from=$value}
				<tr>
					<td class="green1"><a href="javascript:Klappen('{$i}')"><img src="gfx/images/plus.png" id="Pic{$i}" border="0" alt="aus/ein-klappen" /></a> {$key2}</td>
					<td class="green1">&nbsp;</td>
					<td class="green1">{sprintf($lang['countcomplain'], count($value2))}</td>
					<td class="green1">
					{if !isset($permoverview['b_client_complain_delete']) OR $permoverview['b_client_complain_delete'] == 1}
						<form method="post" action="index.php?site=complainlist&amp;sid={$sid}">
						<input type="hidden" name="tcldbid" value="{$key}" />
						<input class="delete" type="submit" name="delall" value="" title="{$lang['delall']}" />
						</form>
					{/if}
					</td>
				</tr>
				<tr>
					<td class="green1" colspan="4">
				<table id="Lay{$i}" style="width:892px;display:none;border-collapse:collapse;border:0" cellpadding="0" cellspacing="0">
					{foreach key=key3 item=value3 from=$value2}
							<tr>
								<td class="green1" style="width:223px;border:0">&nbsp;{date("d.m.Y - H:i", $value3['timestamp'])}</td>
								<td class="green1" style="width:223px;border:0">{secure($value3['fname'])}</td>
								<td class="green1" style="width:223px;border:0">{secure($value3['message'])}</td>
								<td class="green1" style="width:223px;border:0">
								{if !isset($permoverview['b_client_complain_delete']) OR $permoverview['b_client_complain_delete'] == 1}
									<form method="post" action="index.php?site=complainlist&amp;sid={$sid}">
									<input type="hidden" name="tcldbid" value="{$key}" />
									<input type="hidden" name="fcldbid" value="{$key3}" />
									<input class="delete" type="submit" name="delete" value="" title="{$lang['delete']}" />
									</form>
								{/if}
								</td>
							</tr>
					{/foreach}
				</table>
					</td>
				</tr>
			{/foreach}
			{assign var=i value="`$i+1`"}
		{/foreach}
</table>
{/if}
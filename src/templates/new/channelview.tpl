{if isset($permoverview['b_channel_info_view']) AND empty($permoverview['b_channel_info_view'])}
	<table class="border" style="width:50%;" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead">{$lang['error']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['nopermissions']}</td>
		</tr>
	</table>
{else}
	<table class="border" cellpadding="1" cellspacing="0">
		<tr>
			<td colspan="2" class="thead">{$lang['channelinfo']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['name']}:</td>
			<td class="green1">{$channelinfo['channel_name']}</td>
		</tr>
		<tr>
			<td class="green2">{$lang['topic']}:</td>
			<td class="green2">{if isset($channelinfo['channel_topic'])}{$channelinfo['channel_topic']}{/if}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['description']}:</td>
			<td class="green1">{if isset($channelinfo['channel_description'])}{$channelinfo['channel_description']}{/if}</td>
		</tr>
		<tr>
			<td class="green2">{$lang['passwordset']}:</td>
			<td class="green2">
			{if $channelinfo['channel_flag_password'] == '1'}
				{$lang['yes']}
			{else}
				{$lang['no']}
			{/if}
			</td>
		</tr>
		<tr>
			<td class="green1">{$lang['default']}:</td>
			<td class="green1"> 
			{if $channelinfo['channel_flag_default'] == '1'}
				{$lang['yes']}
			{else}
				{$lang['no']}
			{/if}
			</td>
		</tr>
		<tr>
			<td class="green2">{$lang['maxclients']}:</td>
			<td class="green2">
			{if $channelinfo['channel_maxclients'] == '-1'}
				{$lang['unlimited']}
			{else}
				{$channelinfo['channel_maxclients']}
			{/if}
			</td>
		</tr>
		<tr>
			<td class="green1">{$lang['maxfamilyclients']}:</td>
			<td class="green1">
			{if $channelinfo['channel_flag_maxfamilyclients_inherited'] == '1'}
				{$lang['inherited']}
			{elseif $channelinfo['channel_flag_maxfamilyclients_unlimited'] == '1'}
				{$lang['unlimited']}
			{else}
				{$channelinfo['channel_maxfamilyclients']}
			{/if}
			</td>
		</tr>
		<tr>
			<td class="green2">{$lang['codec']}:</td>
			<td class="green2">
			{if $channelinfo['channel_codec'] == '0'}
				{$lang['codec0']}
			{elseif $channelinfo['channel_codec'] == '1'}
				{$lang['codec1']}
			{elseif $channelinfo['channel_codec']=='2'}
				{$lang['codec2']}
			{elseif $channelinfo['channel_codec']=='3'}
				{$lang['codec3']}
			{elseif $channelinfo['channel_codec']=='4'}
				{$lang['codec4']}
			{elseif $channelinfo['channel_codec']=='5'}
				{$lang['codec5']}
			{/if}
			</td>
		</tr>
		<tr>
			<td class="green1">{$lang['codecquality']}:</td>
			<td class="green1">{$channelinfo['channel_codec_quality']}</td>
		</tr>
		<tr>
			<td class="green2">{$lang['codecunencrypted']}</td>
			<td class="green2">
			{if $channelinfo['channel_codec_is_unencrypted']=='1'}
			{$lang['yes']}
			{elseif $channelinfo['channel_codec_is_unencrypted']=='0'}
			{$lang['no']}
			{/if}
			</td>
		</tr>
		<tr>
			<td class="green1">{$lang['neededtalkpower']}:</td>
			<td class="green1">{$channelinfo['channel_needed_talk_power']}</td>
		</tr>
		<tr>
			<td class="green2">{$lang['forcedsilence']}:</td>
			<td class="green2">
			{if $channelinfo['channel_forced_silence'] == '1'}
				{$lang['yes']}
			{else}
				{$lang['no']}
			{/if}
			</td>
		</tr>
		<tr>
			<td class="green1">{$lang['iconid']}</td>
			<td class="green1">{$channelinfo['channel_icon_id']}</td>
		</tr>
		<tr>
			<td class="green2">{$lang['phoneticname']}</td>
			<td class="green2">{if isset($channelinfo['channel_name_phonetic'])}{$channelinfo['channel_name_phonetic']}{/if}</td>
		</tr>
	</table>
{/if}
({$inc_header|smarty:nodefaults})

<h2>({$item_str}) 日次ページビュー集計</h2>
<div class="contents">
({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})


<table class="basicType2">
<tbody>
({foreach from=$access_analysis_day item=item})
<tr>
<th>
({$item.thedate})日
</th>
<td>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_page')})&ymd=({$ym})-({$item.thedate})&month_flag=0&ktai_flag=({$ktai_flag})">({$item.count})</a>
</td>
</tr>
({/foreach})
</tbody>
</table>
({$inc_footer|smarty:nodefaults})

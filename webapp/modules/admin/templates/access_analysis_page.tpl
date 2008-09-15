({$inc_header|smarty:nodefaults})

<h2>({$item_str}) ({if $month_flag})({$ymd|date_format:"%Y年%m月分"})({else})({$ymd|date_format:"%Y年%m月%d日分"})({/if})　ページ毎の集計</h2>
<div class="contents">

<table class="basicType2">
<thead>
<tr>
<th>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_page')})&ktai_flag=({$ktai_flag})&ymd=({$ymd})&month_flag=({$month_flag})&orderby1=({$orderby1})">ページ</a></th>
<th><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_page')})&ktai_flag=({$ktai_flag})&ymd=({$ymd})&month_flag=({$month_flag})&orderby2=({$orderby2})">アクセス数</a></th>
<th>アクセスされた<br>メンバー<br>(target_c_member_id)</th>
<th>アクセスされた<br>コミュニティ<br>(target_c_commu_id)</th>
<th>アクセスされた<br>トピック<br>(target_c_topic_id)</th>
<th>アクセスされた<br>日記<br>(target_c_diary_id)</th>
<th>アクセスした<br>メンバー<br>(c_member_id)</th>
</tr>
</thead>
<tbody>
({foreach from=$access_analysis_month_page item=item})
<tr>
<th>({$item.page_name})</th>
<td>({$item.count})</td>
({if $item.is_target_c_member_id == 1})
<td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_member')})&ktai_flag=({$ktai_flag})&ymd=({$ymd})&month_flag=({$month_flag})&page_name=({$item.page_name})">詳細</a></td>
({else})
<td><br></td>
({/if})

({if $item.is_target_c_commu_id == 1})
<td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_commu')})&ktai_flag=({$ktai_flag})&ymd=({$ymd})&month_flag=({$month_flag})&page_name=({$item.page_name})">詳細</a></td>
({else})
<td><br></td>
({/if})

({if $item.is_target_c_topic_id == 1})
<td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_topic')})&ktai_flag=({$ktai_flag})&ymd=({$ymd})&month_flag=({$month_flag})&page_name=({$item.page_name})">詳細</a></td>
({else})
<td><br></td>
({/if})

({if $item.is_target_c_diary_id == 1})
<td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_diary')})&ktai_flag=({$ktai_flag})&ymd=({$ymd})&month_flag=({$month_flag})&page_name=({$item.page_name})">詳細</a></td>
({else})
<td><br></td>
({/if})

({if $item.is_c_member_id == 1})
<td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_member')})&ktai_flag=({$ktai_flag})&ymd=({$ymd})&month_flag=({$month_flag})&page_name=({$item.page_name})">詳細</a></td>
</tr>
({else})
<td><br></td>
({/if})
({/foreach})

<tr>
<th>合計</th>
<td>({$sum})</td>
<td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_member')})&ktai_flag=({$ktai_flag})&ymd=({$ymd})&month_flag=({$month_flag})&page_name=all">詳細</a></td>
<td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_commu')})&ktai_flag=({$ktai_flag})&ymd=({$ymd})&month_flag=({$month_flag})&page_name=all">詳細</a></td>
<td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_topic')})&ktai_flag=({$ktai_flag})&ymd=({$ymd})&month_flag=({$month_flag})&page_name=all">詳細</a></td>
<td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_diary')})&ktai_flag=({$ktai_flag})&ymd=({$ymd})&month_flag=({$month_flag})&page_name=all">詳細</a></td>
<td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_member')})&ktai_flag=({$ktai_flag})&ymd=({$ymd})&month_flag=({$month_flag})&page_name=all">詳細</a></td>
</tr>
</tbody>
</table>

({$inc_footer|smarty:nodefaults})

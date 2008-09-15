({$inc_header|smarty:nodefaults})

<h2>({$item_str})ページ月次集計</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})

<h3 class="item">アクセスメンバー数（ＰＣ＋携帯の７日以内のログインメンバー数）：({$active_num}) 人</h3>

<ul>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_diary')})&amp;ktai_flag=({if $item_str=='PC版'})0({else})1({/if})&amp;ymd=({$nowtime})&amp;month_flag=1&amp;page_name=all&amp;orderby2=-2">今月最もアクセスのあった日記を表示する</a>
</li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_member')})&amp;ktai_flag=({if $item_str=='PC版'})0({else})1({/if})&amp;ymd=({$nowtime})&amp;month_flag=1&amp;page_name=all&orderby2=-2">今月最もアクセスのあったメンバーを表示する</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_commu')})&amp;ktai_flag=({if $item_str=='PC版'})0({else})1({/if})&amp;ymd=({$nowtime})&amp;month_flag=1&amp;page_name=all&orderby2=-2">今月最もアクセスのあったコミュニティを表示する</a></li>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_target_topic')})&amp;ktai_flag=({if $item_str=='PC版'})0({else})1({/if})&amp;ymd=({$nowtime})&amp;month_flag=1&amp;page_name=all&orderby2=-2">今月最もアクセスのあったトピックを表示する</a></li>
</ul>

<ul>
<li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_member')})&amp;ktai_flag=({if $item_str=='PC版'})0({else})1({/if})&amp;ymd=({$nowtime})&amp;month_flag=1&amp;page_name=all&orderby2=-2">今月最もアクセスをしたメンバーを表示する</a></li>
</ul>

<h3 class="item">月次別アクセスメンバー数</h3>

<table class="basicType2">
<tbody>
({foreach from=$access_analysis_month item=item})
<tr>
<th>
({$item.ym|date_format:"%Y年%m月"})
</th>
<td>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_page')})&amp;ymd=({$item.ym})&amp;month_flag=1&amp;ktai_flag=({$ktai_flag})">
({$item.count})
</a>
</td>
<td>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_day')})&amp;ymd=({$item.ym})&amp;ktai_flag=({$ktai_flag})">日次集計</a>
</td>
</tr>
({/foreach})
</tbody>
</table>

({$inc_footer|smarty:nodefaults})

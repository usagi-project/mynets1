({$inc_ktai_header|smarty:nodefaults})

<div align="center"><font color="blue">Myｽｹｼﾞｭｰﾙ&em_memo;</font></div>
<div align="center"><font color="green">({$today.year})/({$today.month})/({$today.day})(({$today.week}))の予定</font></div>
<hr>
({if $schedule})
({foreach from=$schedule item=item})
<a href="({t_url m=ktai a=page_h_schedule})&amp;schedule_id=({$item.c_schedule_id})&amp;({$tail})">({$item.start_time|string_format:"%.5s"})</a> &em_ticket;({$item.title})<br>
({/foreach})
<hr>
({/if})
({if $event})
({foreach from=$event item=item})
<img src="({if $item.is_join})({t_img_url_skin filename=icon_event_R})({else})({t_img_url_skin filename=icon_event_B})({/if})" class="icon"><a href="({t_url m=ktai a=page_c_bbs})&amp;target_c_commu_topic_id=({$item.c_commu_topic_id})&amp;({$tail})">({$item.name|t_truncate:20:".."|t_body:'name'})</a><br>
({/foreach})
<hr>
({/if})
({if $birth})
({foreach from=$birth item=item_birth})
<img src="({t_img_url_skin filename=icon_birthday})" class="icon"><a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$item_birth.c_member_id})&amp;({$tail})">({$item_birth.nickname|t_body:'name'})さん</a><br>
({/foreach})
<hr>
({/if})
<div align="center">
&em_4square;<a href="({t_url m=ktai a=page_h_calendar_day})&amp;year=({$yesterday.year})&amp;month=({$yesterday.month})&amp;day=({$yesterday.day})&amp;({$tail})" accesskey="4">前 日</a>|&em_6square;<a href="({t_url m=ktai a=page_h_calendar_day})&amp;year=({$tomorrow.year})&amp;month=({$tomorrow.month})&amp;day=({$tomorrow.day})&amp;({$tail})" accesskey="6">翌 日</a></div>
<hr>
&em_5square;<a href="({t_url m=ktai a=page_h_calendar_day})&amp;({$tail})" accesskey="5">今日の予定</a><br>&em_7square;<a href="?m=ktai&amp;a=page_h_calendar_week&amp;year=({$today.year})&amp;month=({$today.month})&amp;day=({$today.day})&amp;({$tail})" accesskey="7">週表示</a><br>
&em_8square;<a href="?m=ktai&amp;a=page_h_calendar_month&amp;year=({$today.year})&amp;month=({$today.month})&amp;day=({$today.day})&amp;({$tail})" accesskey="8">月表示</a><br>
<hr>
&em_pen;<a href="?m=ktai&amp;a=page_h_schedule_add&amp;year=({$today.year})&amp;month=({$today.month})&amp;day=({$today.day})&amp;({$tail})">予定の追加</a><br>
&em_search;<a href="?m=ktai&amp;a=page_h_schedule_show_month&amp;year=({$today.year})&amp;month=({$today.month})&amp;day=({$today.day})&amp;({$tail})">予定一覧の表示</a><br>
<hr>
({$inc_ktai_footer|smarty:nodefaults})

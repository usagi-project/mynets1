({$inc_ktai_header|smarty:nodefaults})

<center>({$year})年({$month})月の予定一覧</center><br>
&em_4square;<a href="?m=ktai&amp;a=page_h_schedule_show_month&amp;year=({$lastmonth.year})&amp;month=({$lastmonth.month})&amp;day=({$lastmonth.day})&amp;({$tail})" accesskey="4">前月の予定一覧</a><br>
&em_6square;<a href="?m=ktai&amp;a=page_h_schedule_show_month&amp;year=({$nextmonth.year})&amp;month=({$nextmonth.month})&amp;day=({$nextmonth.day})&amp;({$tail})" accesskey="6">翌月の予定一覧</a><br>
<br>
({if $monthly_schedule})
<hr>
<br>
({foreach from=$monthly_schedule item=item})
({$item.month})月({$item.day})日(({$item.week}))<br>
({if $item.schedule})
({foreach from=$item.schedule item=item})
<a href="?m=ktai&amp;a=page_h_schedule&amp;schedule_id=({$item.c_schedule_id})&amp;({$tail})">({$item.start_time|string_format:"%.5s"}) ({$item.title})</a><br>
({/foreach})
({/if})
<br>
({/foreach})
<hr>
<br>
({/if})
<hr>
&em_5square;<a href="({t_url m=ktai a=page_h_calendar_day})&amp;({$tail})" accesskey="5">今日の予定</a><br>
&em_7square;<a href="?m=ktai&amp;a=page_h_calendar_week&amp;year=({$today.year})&amp;month=({$today.month})&amp;day=({$today.day})&amp;({$tail})" accesskey="7">週表示</a>
<br>
<hr>
&em_5square;<a href="({t_url m=ktai a=page_h_calendar_day})&amp;({$tail})" accesskey="5">今日の予定</a><br>
({$inc_ktai_footer|smarty:nodefaults})

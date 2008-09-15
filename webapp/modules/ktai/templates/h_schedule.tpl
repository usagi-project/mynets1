({$inc_ktai_header|smarty:nodefaults})
<div align="center">&em_sun;<font color="blue">予定</font></div>
({if $schedule})
<font color="green">概要:</font>({$schedule.title})<br>
<font color="green">日付:</font>({$schedule.start_date|replace:"-":"/"})<br>
<font color="green">詳細:</font>({$schedule.body})<br>
({if $schedule.start_date eq $schedule.end_date})
<font color="green">時間:</font>({$schedule.start_time|string_format:"%.5s"}) 〜 ({$schedule.end_time|string_format:"%.5s"})<br>
({else})
<font color="green">時間:</font>({$schedule.start_date|replace:"-":"/"}) : ({$schedule.start_time|string_format:"%.5s"}) 〜<br>({$schedule.end_date|replace:"-":"/"}) : ({$schedule.end_time|string_format:"%.5s"})<br>
({/if})
<hr>
({/if})
<div align="right">
&em_5square;<a href="({t_url m=ktai a=page_h_calendar_day})&amp;({$tail})" accesskey="5">今日の予定</a><br>
&em_pen;<a href="({t_url m=ktai a=page_h_schedule_edit})&amp;schedule_id=({$schedule.c_schedule_id})&amp;({$tail})">編集</a><br>
&em_wrench;<a href="({t_url m=ktai a=page_h_schedule_delete_confirm})&amp;schedule_id=({$schedule.c_schedule_id})&amp;({$tail})">削除</a></div>
<hr>
({$inc_ktai_footer|smarty:nodefaults})

({$inc_ktai_header|smarty:nodefaults})

<center>予定の削除</center><br>

<form action="./" method="post">
<input type="hidden" name="m" value="ktai">
<input type="hidden" name="a" value="do_h_schedule_delete">
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="year" value="({$year})">
<input type="hidden" name="month" value="({$month})">
<input type="hidden" name="day" value="({$day})">
<input type="hidden" name="schedule_id" value="({$schedule_id})">
({if $schedule})
◆({$schedule.title})<br>
日付:({$schedule.start_date|replace:"-":"/"})<br>
詳細:({$schedule.body})<br>
({/if})
<br>
<center><font color="red">本当に消去しますか？</font></center>
<center><input type="submit" name="delete" value="はい"><input type="submit" name="cancel" value="いいえ"></center>
</form>

<br>
<hr>
&em_5square;<a href="({t_url m=ktai a=page_h_calendar_day})&amp;({$tail})" accesskey="5">今日の予定</a><br>
({$inc_ktai_footer|smarty:nodefaults})

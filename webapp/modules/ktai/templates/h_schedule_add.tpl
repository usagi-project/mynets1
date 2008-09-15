({$inc_ktai_header|smarty:nodefaults})

<div align="center"><font color="blue">予定の追加</font></div>
<hr color="green">
({ext_include file="inc_alert_box_ktai.tpl"})({* エラーメッセージコンテナ *})

<form action="./" method="post">
<input type="hidden" name="m" value="ktai">
<input type="hidden" name="a" value="do_h_schedule_add">
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="year" value="({$year})">
<input type="hidden" name="month" value="({$month})">
<input type="hidden" name="day" value="({$day})">
<font color="green">タイトル:</font>
<input type="text" tabindex="1" name="title" id="title" class="text">
<font color="green">年月日:(YYYYMMDD)</font><br>
<input type="text" value="({$start_date|replace:"-":""})" istyle="4" size="8" maxlength="8" name="start_date" id="start_date" class="text"><br>
<font color="green">開始時間:(hh:mm)</font><br>
<select name="start_hour">
({foreach from=$hour_list item=item})
<option({if $item eq $start_hour}) selected({/if}) value="({$item})">({$item})</option>
({/foreach})
</select><font color="green">時</font>
<select name="start_minute">
({foreach from=$minute_list item=item})
<option({if $item eq "00"}) selected({/if}) value="({$item})">({$item})</option>
({/foreach})
</select><font color="green">分</font><br>
<font color="green">終了時間:(hh:mm)</font><br>
<select name="end_hour">
({foreach from=$hour_list item=item})
<option({if $item eq $end_hour}) selected({/if}) value="({$item})">({$item})</option>
({/foreach})
</select><font color="green">時</font>
<select name="end_minute">
({foreach from=$minute_list item=item})
<option({if $item eq "00"}) selected({/if}) value="({$item})">({$item})</option>
({/foreach})
</select><font color="green">分</font><br>
<font color="green">詳細:</font><br>
<textarea name="body" id="body" rows="4" class="text">({$schedule.body})</textarea>
<div align="center"><input type="submit" value=" 追 加 す る"></div>
</form>
<hr>
&em_5square;<a href="?m=ktai&amp;a=page_h_calendar_day&amp;({$tail})" accesskey="5">今日の予定</a><br>
&em_7square;<a href="?m=ktai&amp;a=page_h_calendar_week&amp;year=({$today.year})&amp;month=({$today.month})&amp;day=({$today.day})&amp;({$tail})" accesskey="7">週表示</a><br>
&em_8square;<a href="?m=ktai&amp;a=page_h_calendar_month&amp;year=({$today.year})&amp;month=({$today.month})&amp;day=({$today.day})&amp;({$tail})" accesskey="8">月表示</a><br>
<hr>
({$inc_ktai_footer|smarty:nodefaults})

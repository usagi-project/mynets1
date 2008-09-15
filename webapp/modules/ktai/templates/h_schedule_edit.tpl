({$inc_ktai_header|smarty:nodefaults})

<div align="center">予定の編集</div>

({ext_include file="inc_alert_box_ktai.tpl"})({* エラーメッセージコンテナ *})

<form action="./" method="post">
<input type="hidden" name="m" value="ktai">
<input type="hidden" name="a" value="do_h_schedule_edit">
<input type="hidden" name="schedule_id" value="({$schedule_id})">
<input type="hidden" name="ksid" value="({$PHPSESSID})">
タイトル:
<input type="text" value="({$schedule.title})" tabindex="1" name="title" id="title" class="text">
年月日:(YYYYMMDD)<br>
<input type="text" value="({$schedule.start_date|replace:"-":""})" istyle="4" size="8" maxlength="8" name="start_date" id="start_date" class="text"><br>
開始時間:(hh:mm)<br>
<select name="start_hour">
({foreach from=$hour_list item=item})
<option({if $item eq $start_hour}) selected({/if}) value="({$item})">({$item})
({/foreach})
</select>時
<select name="start_minute">
({foreach from=$minute_list item=item})
<option({if $item eq $start_minute}) selected({/if}) value="({$item})">({$item})
({/foreach})
</select>分<br>
終了時間:(hh:mm)<br>
<select name="end_hour">
({foreach from=$hour_list item=item})
<option({if $item eq $end_hour}) selected({/if}) value="({$item})">({$item})
({/foreach})
</select>時
<select name="end_minute">
({foreach from=$minute_list item=item})
<option({if $item eq $end_minute}) selected({/if}) value="({$item})">({$item})
({/foreach})
</select>分<br>
詳細:<br>
<textarea name="body" id="body" rows="4">({$schedule.body})</textarea>
<center><input type="submit" value="編集"></center>
</form>

<br>
<hr>
&em_5square;<a href="({t_url m=ktai a=page_h_calendar_day})&amp;({$tail})" accesskey="5">今日の予定</a><br>
({$inc_ktai_footer|smarty:nodefaults})

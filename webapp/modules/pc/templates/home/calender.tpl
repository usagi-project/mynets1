({frame id="calender" class="border_07 bg_00"})
  ({frame id="calender-inner" class="border_07 bg_00"})

<div id="calender-inner2">
予定 <input type="text" name="title" value="" size="24">
<select name="start_date">
({foreach from=$calendar item=item})
<option value="({$item.year})-({$item.month})-({$item.day})"({if $item.now}) selected="selected"({/if})>({$item.month})/({$item.day})(({$item.dayofweek}))</option>
({/foreach})
</select>
<input type="submit" class="submit" value="追加">
&nbsp;
<a href="({t_url m=pc a=page_h_home})&amp;w=({$w-1})" title="前の週"><font size="4">&lt;</font></a>
<a href="({t_url m=pc a=page_h_home})" title="今週">■</a>
<a href="({t_url m=pc a=page_h_home})&amp;w=({$w+1})" title="次の週"><font size="4">&gt;</font></a>
</div>

<table border="0" cellspacing="0" cellpadding="0" style="width:416px;">
<tr>
({foreach from=$calendar item=item name=calendar})
<td style="width:({if $smarty.foreach.calendar.last})64({else})60({/if})px;({if !$smarty.foreach.calendar.last})border-right:none;({/if})" align="left" valign="top" class="border_01 bg_0({if $item.now})9({else})2({/if})({if $item.dayofweek == "日"}) c_02({elseif $item.dayofweek == "土"}) c_03({/if}) padding_s">
({if $item.now})<span class="b_b">({/if})

({if $smarty.foreach.calendar.first || $item.day == 1})
({$item.month})/({/if})

({$item.day})<br>
(({$item.dayofweek}))<br>

({if $item.now})</span>({/if})

<div>
({* 誕生日 *})
({foreach from=$item.birth item=item_birth})
<img src="({t_img_url_skin filename=icon_birthday})" class="icon"><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item_birth.c_member_id})">i
({$item_birth.nickname|t_body:'name'})さん</a><br>
({/foreach})

({* イベント *})
({foreach from=$item.event item=item_event})
<img src="({if $item_event.is_join})({t_img_url_skin filename=icon_event_R})({else})({t_img_url_skin filename=icon_event_B})({/if})" class="icon"><a href="({t_url m=pc a=page_c_event_detail})&amp;target_c_commu_topic_id=({$item_event.c_commu_topic_id})">({$item_event.name|t_truncate:20:".."|t_body:'name'})</a><br>
({/foreach})

({* スケジュール *})
({foreach from=$item.schedule item=item_schedule})
<img src="({t_img_url_skin filename=icon_pen})" class="icon"><a href="({t_url m=pc a=page_h_schedule})&amp;target_c_schedule_id=({$item_schedule.c_schedule_id})">({$item_schedule.title|t_body:'title'})</a><br>
({/foreach})
</div>

</td>
({/foreach})
</tr>
</table>
<div class="iconArrow2">
<img src="./skin/dummy.gif" class="icon arrow_1">
<a href="({t_url m=pc a=page_h_calendar})">月別カレンダー</a></div>
({/frame})
({/frame})

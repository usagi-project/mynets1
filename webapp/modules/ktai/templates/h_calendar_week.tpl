({$inc_ktai_header|smarty:nodefaults})

<div align="center">&em_book;<font color="blue">週間予定</font></div>
<div align="center"><font color="green">({$weekdays.0.year})/({$weekdays.0.month})/({$weekdays.0.day})〜({$weekdays.6.month})/({$weekdays.6.day})</font></div><hr>
<div align="center">&em_4square;<a href="({t_url m=ktai a=page_h_calendar_week})&amp;year=({$lastweek.year})&amp;month=({$lastweek.month})&amp;day=({$lastweek.day})&amp;({$tail})" accesskey="4">前 週</a>|&em_6square;<a href="({t_url m=ktai a=page_h_calendar_week})&amp;year=({$nextweek.year})&amp;month=({$nextweek.month})&amp;day=({$nextweek.day})&amp;({$tail})" accesskey="6">翌 週</a></div>
({if $weekdays})
<hr>
({foreach from=$weekdays item=item})
<a href="({t_url m=ktai a=page_h_calendar_day})&amp;year=({$item.year})&amp;month=({$item.month})&amp;day=({$item.day})&amp;({$tail})">･({$item.month})/({$item.day})(({if $item.week=="Sun"})<font color="red">({elseif $item.week=="Sat"})<font color="green">({else})<font color="blue">({/if})({$item.week})</font>)({if $item.count}) -&em_ticket;({$item.count})({/if}) ({if $item.event}) -<img src="({t_img_url_skin filename=icon_event_R})" class="icon">({$item.event})({/if})</a><br>
({/foreach})
<hr>
({/if})
&em_5square;<a href="({t_url m=ktai a=page_h_calendar_day})&amp;({$tail})" accesskey="5">今日の予定</a><br>&em_8square;<a href="({t_url m=ktai a=page_h_calendar_month})&amp;year=({$weekdays.0.year})&amp;month=({$weekdays.0.month})&amp;day=({$weekdays.0.day})&amp;({$tail})" accesskey="8">月表示</a>
<hr>
({$inc_ktai_footer|smarty:nodefaults})

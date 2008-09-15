({$inc_ktai_header|smarty:nodefaults})

<div align="center">&em_book;<font color="blue">月間予定</font></div>
<div align="center"><font color="green">({$monthdays.0.year})年({$monthdays.0.month})月の予定</font></div>
<div align="center">&em_4square;<a href="({t_url m=ktai a=page_h_calendar_month})&amp;year=({$lastmonth.year})&amp;month=({$lastmonth.month})&amp;day=({$lastmonth.day})&amp;({$tail})" accesskey="4">前 月</a>|
&em_6square;<a href="({t_url m=ktai a=page_h_calendar_month})&amp;year=({$nextmonth.year})&amp;month=({$nextmonth.month})&amp;day=({$nextmonth.day})&amp;({$tail})" accesskey="6">翌 月</a></div>
({if $monthdays})
<hr>
<font size="1"><div align="right"><a href="#10">▼</a></div></font>
({foreach from=$monthdays item=item})
({if $item.count gt 0 || $item.event gt 0})
<a href="({t_url m=ktai a=page_h_calendar_day})&amp;year=({$item.year})&amp;month=({$item.month})&amp;day=({$item.day})&amp;({$tail})">･({*$item.month*})({$item.day})(({if $item.week=="Sun"})<font color="red">({elseif $item.week=="Sat"})<font color="green">({else})<font color="blue">({/if})({$item.week})</font>)({if $item.count}) - &em_ticket;({$item.count})件({/if})({if $item.event}) - <img src="({t_img_url_skin filename=icon_event_R})" class="icon">({$item.event})件({/if})</a><br>
({else})
･({*$item.month*})({$item.day})(({if $item.week=="Sun"})<font color="red">({elseif $item.week=="Sat"})<font color="green">({else})<font color="blue">({/if})({$item.week})</font>)<br>
({/if})
({if $item.day==10})<font size="1"><div align="right"><a name="10"></a><a href="#20">▼</a></div></font>
({elseif $item.day==20})<font size="1"><div align="right"><a name="20"></a><a href="#last">▼</a></div></font>
({/if})
({/foreach})
<a name="last"></a>
<hr>
({/if})
<div align="center">
&em_4square;<a href="({t_url m=ktai a=page_h_calendar_month})&amp;year=({$lastmonth.year})&amp;month=({$lastmonth.month})&amp;day=({$lastmonth.day})&amp;({$tail})" accesskey="4">前 月</a>|
&em_6square;<a href="({t_url m=ktai a=page_h_calendar_month})&amp;year=({$nextmonth.year})&amp;month=({$nextmonth.month})&amp;day=({$nextmonth.day})&amp;({$tail})" accesskey="6">翌 月</a></div>
<br>
&em_5square;<a href="({t_url m=ktai a=page_h_calendar_day})&amp;({$tail})" accesskey="5">今日の予定</a><br>
&em_7square;<a href="({t_url m=ktai a=page_h_calendar_week})&amp;year=({$kyou.0.year})&amp;month=({$kyou.0.month})&amp;day=({$kyou.0.day})&amp;({$tail})" accesskey="7">週表示</a><br>
<hr>

({$inc_ktai_footer|smarty:nodefaults})

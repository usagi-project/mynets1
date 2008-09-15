({$inc_ktai_header|smarty:nodefaults})
({if $login_msg})
<font color="red">({$login_msg})</font>
<hr>
<ul>
  <li>本日のﾄﾋﾟｯｸ投稿数:({$today_topic})</li>
  <li>昨日のﾄﾋﾟｯｸ投稿数:({$yesterday_topic})</li>
  <li>今月のﾄﾋﾟｯｸ投稿数:({$tomonth_topic})</li>
  <li>先月のﾄﾋﾟｯｸ投稿数:({$premonth_topic})</li>
  <li>ﾄｰﾀﾙﾄﾋﾟｯｸ投稿数:({$total_topic})</li>
</ul>
<ul>
  <li>本日のｲﾍﾞﾝﾄ投稿数:({$today_event})</li>
  <li>昨日のｲﾍﾞﾝﾄ投稿数:({$yesterday_event})</li>
  <li>今月のｲﾍﾞﾝﾄ投稿数:({$tomonth_event})</li>
  <li>先月のｲﾍﾞﾝﾄ投稿数:({$premonth_event})</li>
  <li>ﾄｰﾀﾙｲﾍﾞﾝﾄ投稿数:({$total_event})</li>
</ul>

<p align="center"><a href="({t_url m=ktai a=page_h_admin_menu})&amp;({$tail})">携帯管理ﾒﾆｭｰへ</a></p>
({else})
<font color="red">管理者じゃないのでログインできません。</font>
({/if})
({$inc_ktai_footer|smarty:nodefaults})

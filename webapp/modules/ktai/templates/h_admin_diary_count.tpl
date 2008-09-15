({$inc_ktai_header|smarty:nodefaults})
({if $login_msg})
<font color="red">({$login_msg})</font>
<hr>
<ul>
  <li>本日の日記投稿数:({$today_diary})</li>
  <li>昨日の日記投稿数:({$yesterday_diary})</li>
  <li>今月の日記投稿数:({$tomonth_diary})</li>
  <li>先月の日記投稿数:({$premonth_diary})</li>
  <li>ﾄｰﾀﾙ日記投稿数:({$total_diary})</li>
</ul>
<ul>
  <li>本日のコメント投稿数:({$today_comment})</li>
  <li>昨日のコメント投稿数:({$yesterday_comment})</li>
  <li>今月のコメント投稿数:({$tomonth_comment})</li>
  <li>先月のコメント投稿数:({$premonth_comment})</li>
  <li>ﾄｰﾀﾙコメント投稿数:({$total_comment})</li>
</ul>

<p align="center"><a href="({t_url m=ktai a=page_h_admin_menu})&amp;({$tail})">携帯管理ﾒﾆｭｰへ</a></p>
({else})
<font color="red">管理者じゃないのでログインできません。</font>
({/if})
({$inc_ktai_footer|smarty:nodefaults})

({$inc_ktai_header|smarty:nodefaults})
({if $login_msg})
<font color="red">({$login_msg})</font>
<hr>
<ul>
  <li>本日の退会数:({$today_user})</li>
  <li>昨日の退会数:({$yesterday_user})</li>
  <li>今月の退会数:({$tomonth_user})</li>
  <li>先月の退会数:({$premonth_user})</li>
  <li>ﾄｰﾀﾙ退会会員数:({$total_user})</li>
</ul>
<font size="1" color="red">※ﾄｰﾀﾙ退会数はDBに保存されている退会データのみを参照しています。</font>
<p align="center"><a href="({t_url m=ktai a=page_h_admin_menu})&amp;({$tail})">携帯管理ﾒﾆｭｰへ</a></p>
({else})
<font color="red">管理者じゃないのでログインできません。</font>
({/if})
({$inc_ktai_footer|smarty:nodefaults})

({$inc_ktai_header|smarty:nodefaults})
({if $login_msg})
<font color="red">({$login_msg})</font>
<hr>
<ul>
  <li>本日のPCｱｸｾｽ:({$today_access})</li>
  <li>昨日のPCｱｸｾｽ:({$yesterday_access})</li>
  <li>今月のPCｱｸｾｽ:({$tomonth_access})</li>
  <li>先月のPCｱｸｾｽ:({$premonth_access})</li>
  <li>ﾄｰﾀﾙPCｱｸｾｽ:({$total_access})</li>
</ul>
<ul>
  <li>本日のMobileｱｸｾｽ:({$today_access_mb})</li>
  <li>昨日のMobileｱｸｾｽ:({$yesterday_access_mb})</li>
  <li>今月のMobileｱｸｾｽ:({$tomonth_access_mb})</li>
  <li>先月のMobileｱｸｾｽ:({$premonth_access_mb})</li>
  <li>ﾄｰﾀﾙMobileｱｸｾｽ:({$total_access_mb})</li>
</ul>
<p align="center">ﾄｰﾀﾙ訪問:</p>
<p align="center"><a href="({t_url m=ktai a=page_h_admin_menu})&amp;({$tail})">携帯管理ﾒﾆｭｰへ</a></p>
({else})
<font color="red">管理者じゃないのでログインできません。</font>
({/if})
({$inc_ktai_footer|smarty:nodefaults})

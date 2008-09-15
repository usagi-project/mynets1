({$inc_ktai_header|smarty:nodefaults})
({if $login_msg})
<font color="red">({$login_msg})</font>
<hr>
<ul>
  <li><a href="({t_url m=ktai a=page_h_admin_regist_user})&amp;({$tail})">新規登録者確認</a></li>
  <li><a href="({t_url m=ktai a=page_h_admin_delete_user})&amp;({$tail})">退会者確認</a></li>
  <li><a href="({t_url m=ktai a=page_h_admin_diary_count})&amp;({$tail})">日記投稿確認</a></li>
  <li><a href="({t_url m=ktai a=page_h_admin_topic_count})&amp;({$tail})">トピック投稿確認</a></li>
  <!--<li>ｲﾝﾌｫﾒｰｼｮﾝ登録</li>-->
  <!--<li>ﾕｰｻﾞｰ管理</li>-->
  <!--<li><a href="({t_url m=ktai a=page_h_admin_access_count})&amp;({$tail})">アクセス数</a></li>-->
</ul>
({else})
<font color="red">管理者以外はログインできません。</font>
({/if})
({$inc_ktai_footer|smarty:nodefaults})

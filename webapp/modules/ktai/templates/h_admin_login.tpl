({$inc_ktai_header|smarty:nodefaults})
({if $login_msg})
<font color="red">({$login_msg})</font>
<hr>
<form method="post" action="./">
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="m" value="ktai">
<input type="hidden" name="a" value="do_admin_login">
<label>ｱｶｳﾝﾄ:<input type="text" name="username" value="({$username})" istyle="3"></label><br>
<label>ﾊﾟｽﾜｰﾄﾞ:<input type="password" name="password" value="({$username})" istyle="3"></label><br>
<input type="submit" value="携帯管理画面ﾛｸﾞｲﾝ">
</form>
({else})
<font color="red">管理者じゃないのでログインできません。</font>
({/if})
({$inc_ktai_footer|smarty:nodefaults})

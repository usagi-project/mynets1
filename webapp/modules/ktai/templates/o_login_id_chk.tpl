({$inc_ktai_header|smarty:nodefaults})
<div align="center">({$smarty.const.SNS_NAME})ログイン</div>
({if $mobile_banner})
<center><img src="({$mobile_banner})"></center>
({else})
<hr>
({/if})
<font color="red">端末IDをチェックします。</font><br>
<br>
<form method="post" action="./?m=ktai&amp;a=do_o_easy_login_docomo&amp;guid=ON" utn>
<input type="hidden" name="login_params" value="({$requests.login_params})">
<input type="submit" value="端末IDﾁｪｯｸ"><br>
</form>
<br><br>
<a href="({t_url m=ktai a=page_o_login})">&gt;&gt;通常ログイン画面へ戻る</a><br>
<hr>
ドコモの簡単ID設定は、i-modeIDを利用して簡単ID設定を行います。<br>
以前に端末ID（機種ID）を設定していた人は、上記の端末IDチェックボタンを押すことで、設定内容を変更します。
<hr>
<center>({$smarty.const.SNS_NAME})</center>
</body>
</html>

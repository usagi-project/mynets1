({$inc_ktai_header|smarty:nodefaults})

<center>かんたんログイン設定</center>
<hr>

({if $msg})
<font color="red">({$msg})</font><br>
<br>
({/if})

({if $is_registered})

<font color="orange">かんたんログイン設定済みです。</font><br>
設定を解除するには
({/if})

下のボタンを押してください。
<form method="post" action="./?m=ktai&amp;a=do_h_config_easy_login&amp;guid=ON" utn>
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<br>
({if $is_registered})
<input type="submit" name="delete" value="設定解除"><br>
({else})
<input type="submit" name="update" value="簡単設定"><br>
({/if})
</form>

<br>
※一部機種では携帯の個体識別番号を送信できないためご利用になれません｡<br>
<a href="({t_url m=ktai a=page_o_whatis_easy_login})">&gt;&gt;かんたんﾛｸﾞｲﾝとは</a>

<hr>
<a href="({t_url m=ktai a=page_h_config})&amp;({$tail})">設定変更</a><br>

({$inc_ktai_footer|smarty:nodefaults})
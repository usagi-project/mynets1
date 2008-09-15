({$inc_header|smarty:nodefaults})
<div>
<div id="full">
<p>管理用のアカウント名とパスワードを入力してください。</p>
({if $INSTALL})
<div class="red b fsxxxl">インストール(install)ディレクトリをサーバーから消してください。消すとログインできます。</div>
セキュリティのため、インストールディレクトリは削除しないとログインできないようになっています。<br>
({/if})
({if $CONVERT})
<div class="red b fsxxxl">コンバータの実行を行った後、または、コンバータを実行しない場合、即座にコンバート(convert)ディレクトリを削除してください。</div>
セキュリティのため、コンバートディレクトリは削除しないとログインできないようになっています。
<br>
({/if})
({if $msg})
<p class="b ">({$msg})</p>
({/if})
<br/>
({if !$INSTALL && !$CONVERT})
<form  action="./" method="post">
<table>
<tr>
<th>
<input type="hidden" name="m" value="({$module_name})">
<input type="hidden" name="a" value="do_({$hash_tbl->hash('login','do')})">
<input type="hidden" name="sessid" value="({$PHPSESSID})">
管理者名</th>
<td><input tabindex="1" name="username" id="username" type="text" size="20"></td>
</tr>
<tr>
<th>パスワード</th>
<td><input tabindex="2" name="password" id="password" type="password" size="20"></td>
</tr>
<tr>
<th>&nbsp;</th>
<td><input tabindex="3" name="is_save" id="is_save" type="checkbox" value="1"><label for="is_save">次回から自動的にログイン</label></td>
</tr>
<tr>
<th>&nbsp;</th>
<td><input tabindex="4" type="submit" class="submit" value="ログイン"></td>
</tr>
</table>
</form>
({/if})
({$inc_footer|smarty:nodefaults})
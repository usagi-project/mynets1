({ext_include file="inc_header.tpl"})

<p>必ず下記の設定をおこなってからセットアップを実行してください。</p>
<ul>
<li>setup/sql/MySQL4.X/install/install-mynets1-1-0-create-mysql4X.sql の実行</li>
<li>setup/sql/MySQL4.X/install/install-mynets1-1-0-insert_data.sql の実行</li>
<li>config.php の設定</li>
</ul>
※installディレクトリは新規インストールで実行するファイルの保存ディレクトリです。<br>
コンバート、アップグレードの場合は、それぞれ convert、upgradeディレクトリを参照してください<br>
セットアップディレクトリ内のHTMLを参照してください。<br>
<p>一度、セットアップを実行した後でこのページを表示することはできません。<br>
セットアップをやり直したい場合はデータベースを空にしてからこのページへアクセスしてください。</p>

({if $errors})
<ul class="caution">
({foreach from=$errors item=item})
<li>({$item})</li>
({/foreach})
</ul>
({/if})

({t_form m=setup a=do_setup})

<table>
<tr>
<th colspan="2">SNS名</th>
</tr>
<tr>
<th>SNS名</th>
<td><input type="text" name="SNS_NAME" value="({$requests.SNS_NAME})" size="30"></td>
</tr>

<tr><td colspan="2" style="padding:0;background:#000"><img src="skin/dummy.gif" height="1"></td></tr>

<tr>
<th colspan="2">初期メンバー</th>
</tr>
<tr>
<td colspan="2" style="background-color: #ffc">初期メンバーのログイン情報の設定をします。<br>
プロフィールやその他の設定項目はログイン後に設定してください。</td>
</tr>
<tr>
<th>PCメールアドレス</th>
<td><input type="text" name="pc_address" value="({$requests.pc_address})" size="30"></td>
</tr>
<tr>
<th>パスワード</th>
<td><input type="password" name="password" value="" size="15"></td>
</tr>
<tr>
<th>パスワード(確認)</th>
<td><input type="password" name="password2" value="" size="15"></td>
</tr>

<tr><td colspan="2" style="padding:0;background:#000"><img src="skin/dummy.gif" height="1"></td></tr>

<tr>
<th colspan="2">管理用アカウント</th>
</tr>
<tr>
<td colspan="2" style="background-color: #ffc">管理画面へのログイン用アカウントの設定をします。</td>
</tr>
<tr>
<th>メンバー名</th>
<td><input type="text" name="admin_username" value="({$requests.admin_username})" size="20"></td>
</tr>
<tr>
<th>パスワード</th>
<td><input type="password" name="admin_password" value="" size="15"></td>
</tr>
<tr>
<th>パスワード(確認)</th>
<td><input type="password" name="admin_password2" value="" size="15"></td>
</tr>

<tr><td colspan="2" style="padding:0;background:#000"><img src="skin/dummy.gif" height="1"></td></tr>

<tr>
<th>&nbsp;</th>
<td><input type="submit" value="セットアップ実行"></td>
</tr>
</table>
</form>

({ext_include file="inc_footer.tpl"})
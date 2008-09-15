({$inc_header|smarty:nodefaults})

<h2>メッセージ・メール送信</h2>

<p>条件に合致するメンバーにメッセージもしくはEメールを送信します。タイトルと本文を入力してください。</p>
<p class="caution">※このメッセージは、ID1番のメンバーから送信されます。<br>
※送るメンバーの数によっては大きな負荷がかかる可能性がありますのでご注意ください。</p>

<div id="page_navi">
◆送信先
<ul>
({if $cond_list.s_year||$cond_list.e_year})
生年月日<br>
({$cond_list.s_year})年～({$cond_list.e_year})年<br>
({/if})
({foreach from=$profile_value_list key=key item=item})
({$item.caption}):({$item.value})<br>
({/foreach})
のメンバー
</ul>
</div>

<div style="float:left">
<form action="./" method="post">
<input type="hidden" name="m" value="({$module_name})">
<input type="hidden" name="a" value="do_({$hash_tbl->hash('send_messages_search','do')})">
<input type="hidden" name="sessid" value="({$PHPSESSID})">
({foreach from=$cond_list key=key item=item})
<input type="hidden" name="({$key})" value="({$item})">
({/foreach})
<dl>
<dt>送信種別</dt>
<dd><select name="send_type">
<option value="message"({if $send_type=='message'}) selected="selected"({/if})>メッセージ送信</option>
<option value="mail"({if $send_type=='mail'}) selected="selected"({/if})>Eメール送信</option>
</option>
</select>
</dd>
<dt>タイトル</dt>
<dd><input type="text" name="subject" size="50" value="({$requests.subject})"></dd>
<dt>本文</dt>
<dd><textarea name="body" cols="50" rows="10">({$requests.body})</textarea></dd>
<dd><input type="submit" class="submit" value="メッセージ送信"></dd>
</dl>
</form>
</div>

({$inc_footer|smarty:nodefaults})
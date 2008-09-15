({$inc_ktai_header|smarty:nodefaults})

<center><font color="orange">ﾒｯｾｰｼﾞの内容受信設定</font></center>
<hr color="orange" size="1">
ﾒｯｾｰｼﾞの通知ﾒｰﾙにﾒｯｾｰｼﾞの内容(件名、本文)も受信するか設定します。 <br>
<br>
({t_form m=ktai a=do_h_config_message_contents_receive_update})
<input type="hidden" name="ksid" value="({$PHPSESSID})">

<input type="radio" name="is_receive_contents" value="1"({if $is_receive_contents}) checked="checked"({/if})>
内容も受信<br>
<input type="radio" name="is_receive_contents" value="0"({if !$is_receive_contents}) checked="checked"({/if})>
通知のみ<br>

<input type="submit" value="変更"><br>
</form>

<hr color="orange" size="1">
<a href="({t_url m=ktai a=page_h_config})&amp;({$tail})">設定変更</a><br>

({$inc_ktai_footer|smarty:nodefaults})

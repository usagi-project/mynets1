({$inc_ktai_header|smarty:nodefaults})

<center><font color="orange">メール受信設定</font></center>
<hr>
新着メッセージの通知などを登録携帯メールアドレスにお知らせします。 <br>
<br>
({t_form m=ktai a=do_h_config_mail_receive_update_mail_receive})
<input type="hidden" name="ksid" value="({$PHPSESSID})">

<input type="radio" name="is_receive_ktai_mail" value="1"({if $c_member.is_receive_ktai_mail}) checked="checked"({/if})>
受け取る<br>
<input type="radio" name="is_receive_ktai_mail" value="0"({if !$c_member.is_receive_ktai_mail}) checked="checked"({/if})>
受け取らない<br>
<br>
自分の日記にコメントがついた時にその内容をメールで受信することが出来ます。<br>
<input type="radio" name="is_diary_comment_mail" value="1"({if $c_member.is_diary_comment_mail}) checked="checked"({/if})>
受け取る<br>
<input type="radio" name="is_diary_comment_mail" value="0"({if !$c_member.is_diary_comment_mail}) checked="checked"({/if})>
受け取らない<br>
<br>
<input type="submit" value="変更"><br>
</form>
<hr>
<p align="center">メール受信設定について</p>
<hr>
({if $carrier == 'docomo'})
DoCoMoの携帯:[iMenu]→[料金＆お申込･設定]→[迷惑ﾒｰﾙ対策]→受信/拒否設定で設定・[次へ]→ｽﾃｯﾌﾟ1→ｽﾃｯﾌﾟ2→ｽﾃｯﾌﾟ3で[受信設定]→[ﾄﾞﾒｲﾝ指定]でﾄﾞﾒｲﾝ名[({$adminmail})]を登録。
({elseif $carrier == 'au'})
auの携帯:[Eﾒｰﾙ設定]→[その他の設定]→[ﾒｰﾙﾌｨﾙﾀ]→[ｱﾄﾞﾚｽﾌｨﾙﾀ]→[指定受信設定]でﾄﾞﾒｲﾝ名[({$adminmail})]を登録。
({elseif $carrier == 'softbank'})
･Vodafoneの携帯:[vodafone live!]→[My Vodafone]→[ｵﾘｼﾞﾅﾙﾒｰﾙ設定]→[受信可否設定]でﾄﾞﾒｲﾝ名[({$adminmail})]を登録。
･SoftBankの携帯:[ﾒﾆｭｰﾘｽﾄ]→[My SoftBank]→[各種変更手続き]→[ｵﾘｼﾞﾅﾙﾒｰﾙ設定]→[迷惑メール関連設定]→[1.受信許可・拒否設定]でﾄﾞﾒｲﾝ名[({$adminmail})]を許可ﾘｽﾄに登録（拒否ﾘｽﾄから削除）。
({else})
端末にてSNSからのメールが受信できるように設定しておいてください。
({/if})
<br>
<input type="text" value="({$adminmail})"><br>
ﾄﾞﾒｲﾝをｺﾋﾟｰして設定してください。
<hr>
<a href="({t_url m=ktai a=page_h_config})&amp;({$tail})">設定変更</a><br>

({$inc_ktai_footer|smarty:nodefaults})

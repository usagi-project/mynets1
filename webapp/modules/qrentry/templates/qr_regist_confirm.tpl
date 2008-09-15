({$inc_ktai_header|smarty:nodefaults})

<center>({$smarty.const.SNS_NAME})への登録完了</center>
<hr>
({if $c_member_pre_id})
最後にメールアドレスの登録を行います。<br><br>
<font color="red">※メールアドレスの登録が完了しないとご利用頂くことができません。</font><br><br>

&em_mail;こちらに<a href="mailto:({$mail_address})">メール送信</a>してください。<hr>
<div align="center">&em_book;登録後ﾌﾟﾛﾌｨｰﾙを設定しましょう</div>
({else})
エラーが発生しました。<br>
改めてQRコードを読みなおしてください。<br>
({/if})
</body></html>
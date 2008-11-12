({$inc_ktai_header|smarty:nodefaults})
<div align="center">({$smarty.const.SNS_NAME})ログイン</div>
({if $mobile_banner})
<center><img src="({$mobile_banner})"></center>
({else})
<hr>
({/if})
({if $msg})
<font color="red">({$msg})</font><br>
({/if})
<br>
({*t_form _attr='utn' m=ktai a=do_o_easy_login*})
<form method="post" action="./?m=ktai&amp;a=do_o_easy_login&amp;guid=ON">
<input type="hidden" name="login_params" value="({$requests.login_params})">
({if $ktai_address})
<input type="hidden" name="ktai_address" value="({$ktai_address})">
({/if})
<input type="submit" value="簡単ログイン"><br>
<a href="({t_url m=ktai a=page_o_whatis_easy_login})">&gt;&gt;かんたんﾛｸﾞｲﾝとは??</a>
</form>
<br>
({t_form m=ktai a=do_o_login})
<input type="hidden" name="login_params" value="({$requests.login_params})">
({if $ktai_address})
<input type="hidden" name="ktai_address" value="({$ktai_address})">
({else})
★携帯アドレス<br>
<textarea name="ktai_address" rows="1" istyle="3" mode="alphabet" maxlength="100"></textarea><br>
({/if})
★パスワード<br>
<input name="password" type="text" istyle="3" mode="alphabet" value=""><br>
<input name="submit" value="ログイン" type="submit"><br>
</form>
<font color="red" size="1"><blink>&em_face_goody;ﾌﾞｯｸﾏｰｸしてください&em_book;</blink></font><br>
<hr>
<center>
({if $ktai_address})
<a href="({t_url m=ktai a=page_o_login})">&gt;&gt;携帯アドレスを入力</a><br>
({/if})
&em_face_goody;<a href="({t_url m=ktai a=page_o_password_query})">ﾊﾟｽﾜｰﾄﾞを忘れた方</a>
</center>
<hr>
<center>
<font color="green">みんなの一言</font>
</center>
({foreach from=$other_word item=item})
&em_pen;「<font color="blue">({$item.comment|t_body:'title'})</font>」<br>
<font size="1">
({$item.r_datetime|t_date})&nbsp;({$item.nickname|t_body:'name'})
</font>
<hr width="90%">
({/foreach})
<hr>
&em_pen;<a href="({t_url m=ktai a=page_o_sns_kiyaku})">利用規約</a><br>
&em_memo;<a href="({t_url m=ktai a=page_o_sns_privacy})">ﾌﾟﾗｲﾊﾞｼｰﾎﾟﾘｼｰ</a>
<hr size=1>
({if $IS_CLOSED_SNS})

({$smarty.const.SNS_NAME})は招待制のソーシャルネットワーキングサービスです。<br>
登録には({$smarty.const.SNS_NAME})参加者からの招待が必要です。
({elseif !((($smarty.const.OPENPNE_REGIST_FROM) & ($smarty.const.OPENPNE_REGIST_FROM_KTAI)) >> 1)})
新規登録はPCからおこなってください。
({else})
新規登録するには以下のリンクから、本文を入力せずにメールを送信してください。<br>
<br>
<a href="mailto:({$mailaddress})">◆メールで登録！◆</a><br>
<br>
※かならず利用規約に同意してから登録をおこなってください。<br>
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

({/if})

<a name="bottom"></a><br>
&em_9square;<a href="({t_url m=ktai a=page_help_login})&amp;page=o_login"  accesskey="9">ﾍﾙﾌﾟ</a><br>
<font color="blue">＊</font><a href="#top" accesskey="*">▲</a>
<font color="blue">＃</font><a href="#bottom" accesskey="#">▼</a>
<br>
({strip})
</body>
</html>
({/strip})

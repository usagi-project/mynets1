({php})echo "<?xml version=\"1.0\" encoding=\"Shift_JIS\"?>";({/php})
({if $carrier == 'docomo'})
<!DOCTYPE html PUBLIC "-//i-mode group (ja)//DTD XHTML i-XHTML(Locale/Ver.=ja/1.0) 1.0//EN" "i-xhtml_4ja_10.dtd">
<meta http-equiv="Content-Type" content="application/xhtml+xml" charset="Shift_JIS" />
({elseif $carrier == 'au'})
<!DOCTYPE html PUBLIC "-//OPENWAVE//DTD XHTML 1.0//EN" "http://www.openwave.com/DTD/xhtml-basic.dtd">
<meta http-equiv="Content-Type" content="text/html" charset="Shift_JIS" />
({else})
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-Transitional.dtd">
<meta http-equiv="Content-Type" content="text/html" charset="Shift_JIS" />
({/if})
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja" />
<head>
<title>({$smarty.const.SNS_NAME})今日のひとこと</title>
</head>
<body style="background-color:#FFFFFF;font-size:x-small;color:#474C4C">
<a name="top" id="top"></a>
<!-- ページトップ文言 -->
<div style="text-align:center;background-color:#4670E7">
    <span style="font-size:x-small;color:#FFFFFF">({$smarty.const.SNS_NAME}) 今日のひとこと</span>
</div>
<!-- ページトップ文言 -->

<!-- 本文 -->
<!--ロゴ表示-->
<div style="text-align:center">
    ({if $msg})<span style="color:red"><strong>({$msg})</strong></span>({/if})
</div>
<p>今日の一言を更新します。</p>
<div style="text-align:left">
    <form method="post" action="./?m=ktai&amp;a=page_h_one_word_confirm">
    <input type="text" name="one_word" value="({$my_word})" /><br />
    <input type="submit" value="確認" />
    <input type="hidden" name="ksid" value="({$PHPSESSID})" />
    </form>
</div>
<hr style="border-style:solid;border-color:#ADADAD;width:100%" color="#ADADAD" />
<div style="text-align:center;background-color:#4670E7;color:#ffffff">
    ほかの人のひとこと
</div>
<div>
    ({foreach from=$other_word item=item})
    <a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})&amp;({$tail})">({$item.nickname|t_body:'title'})</a>「({$item.comment})」<span style="text-size:small">･･･({$item.r_datetime|t_date})</span><hr style="border-style:solid; width:80%;" />
    ({/foreach})
    <div style="text-align:right"><a href="({t_url m=ktai a=page_f_one_word_list})&amp;({$tail})">もっと見る</a></div>
</div>
<hr style="border-style:solid;border-color:#ADADAD;width:100%" size="2" color="#ADADAD" />
<p>
<a href="({t_url m=ktai a=page_h_home})&amp;({$tail})" accesskey="0"><span style="font-size:x-small;color:#07429C">ﾏｲﾍﾟｰｼﾞ</span></a>
</p>
    <!-- 本文 -->
</body>
</html>

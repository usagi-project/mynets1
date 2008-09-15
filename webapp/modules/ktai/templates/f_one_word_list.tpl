<head>
<title>({$smarty.const.SNS_NAME})今日のひとこと</title>
</head>
<body style="background-color:#FFFFFF;font-size:x-small;color:#474C4C">
<a name="top" id="top"></a>
<!-- ページトップ文言 -->
<!-- ページトップ文言 -->

<!-- 本文 -->

<div style="text-align:center;background-color:#4670E7;color:#ffffff">
    ほかの人のひとこと
</div>
<div>
    ({foreach from=$other_word item=item})
    <a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})&amp;({$tail})">({$item.nickname|t_body:'title'})</a>「({$item.comment})」<span style="text-size:small">･･･({$item.r_datetime|t_date})</span><hr style="border-style:solid; width:80%;" />
    ({/foreach})
</div>
<div style="text-align:center">
({$page_link|smarty:nodefaults})
</div>
<hr style="border-style:solid;border-color:#ADADAD;width:100%" size="2" color="#ADADAD" />
<p>
<a href="({t_url m=ktai a=page_h_home})&amp;({$tail})" accesskey="0"><span style="font-size:x-small;color:#07429C">ﾏｲﾍﾟｰｼﾞ</span></a>
</p>
    <!-- 本文 -->
</body>
</html>

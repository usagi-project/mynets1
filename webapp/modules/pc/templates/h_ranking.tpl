({$inc_html_header|smarty:nodefaults})
<body>
({ext_include file="inc_extension_pagelayout_top.tpl"})
<table class="mainframe" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="container inc_page_header">
({$inc_page_header|smarty:nodefaults})
</td>
</tr>
<tr>
<td class="container inc_navi">
({$inc_navi|smarty:nodefaults})
</td>
</tr>
<tr>
<td class="container main_content">
<table class="container" border="0" cellspacing="0" cellpadding="0">({*BEGIN:container*})
<tr>
<td style="width:7px;"><img src="./skin/dummy.gif" style="width:7px;" class="dummy"></td>({*<--spacer*})
<td class="left_content_165" align="center" valign="top">
({********************************})
({**ここから：メインコンテンツ（左）**})
({********************************})

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ************************************** -->
<!-- ******ここから：ランキングメニュー****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:165px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:149px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10" align="left">
<!-- *ここから：ランキングメニュー＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:149px;" class="border_01">
<tr>
<td style="width:147px;padding:2px 0px;" class="bg_06" align="center"><span class="b_b c_00">アクセス数No1</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<div align="left" style="padding:3px;" class="bg_02 border_01">

昨日のアクセスが多かったメンバーのランキングです。

<div align="right" style="padding:3px 0px;" class="border_01 bg_03">

<a href="({t_url m=pc a=page_h_ranking})">アクセス数No1</a>

</div>

</div>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:149px;" class="border_01">
<tr>
<td style="width:147px;padding:2px 0px;" class="bg_06" align="center"><span class="b_b c_00">({$WORD_MY_FRIEND})数No1</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<div align="left" style="padding:3px;" class="bg_02 border_01">

登録されている({$WORD_MY_FRIEND})の数が多いメンバーのランキングです。

<div align="right" style="padding:3px 0px;" class="border_01 bg_03">

<a href="({t_url m=pc a=page_h_ranking})&amp;kind=friend">({$WORD_MY_FRIEND})数No1</a>

</div>

</div>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:149px;" class="border_01">
<tr>
<td style="width:147px;padding:2px 0px;" class="bg_06" align="center"><span class="b_b c_00">参加人数No１コミュニティ</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<div align="left" style="padding:3px;" class="bg_02 border_01">

参加者の多いコミュニティのランキングです。

<div align="right" style="padding:3px 0px;" class="border_01 bg_03">

<a href="({t_url m=pc a=page_h_ranking})&amp;kind=com_member">参加人数No１<br>コミュニティを表示</a>

</div>

</div>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:149px;" class="border_01">
<tr>
<td style="width:147px;padding:2px 0px;" class="bg_06" align="center"><span class="b_b c_00">盛り上がり度No１コミュニティ</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<div align="left" style="padding:3px;" class="bg_02 border_01">

昨日の掲示板書き込み数が多かったコミュニティのランキングです。

<div align="right" style="padding:3px 0px;" class="border_01 bg_03">

<a href="({t_url m=pc a=page_h_ranking})&amp;kind=com_comment">盛り上がり度No１<br>コミュニティを表示</a>

</div>

</div>
<!-- ここまで：主内容 -->
({*ここまで：body*})
<!-- *ここまで：ランキングメニュー＞＞内容* -->
</td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：ランキングメニュー****** -->
<!-- ************************************** -->

<img src="./skin/dummy.gif" class="v_spacer_l">

({********************************})
({**ここまで：メインコンテンツ（左）**})
({********************************})
</td>
<td style="width:8px;"><img src="./skin/dummy.gif" style="width:8px;" class="dummy"></td>({*<--spacer*})
<td class="right_content_540" align="center" valign="top">
({********************************})
({**ここから：メインコンテンツ（右）**})
({********************************})

<img src="./skin/dummy.gif" class="v_spacer_l">

({foreach from=$rank_list key=rank item=list name=ranking})
<!-- ********************************** -->
<!-- ******ここから：ランキング一覧****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:540px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:524px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="left">
<!-- *ここから：ランキング一覧＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
({if $smarty.foreach.ranking.first})

<table border="0" cellspacing="0" cellpadding="0" style="width:524px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:486px;padding:2px 0px;" class="bg_06">
<span class="c_00">

<span class="b_b">
({if $kind == "ashiato"})
アクセス数No1メンバー
({elseif $kind == "friend"})
({$WORD_MY_FRIEND})数No1メンバー
({elseif $kind == "com_member"})
参加人数No１コミュニティ
({elseif $kind == "com_comment"})
盛り上がり度No1コミュニティ
({/if})
</span>
は、
({if $kind == "ashiato" || $kind == "friend"})
({$list[0].c_member.nickname|t_body:'name'}) さん
({else})
『({$list[0].c_commu.name|t_body:'title'})』
({/if})
です。

</span>

</td>
</tr>
</table>
({/if})

<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<!-- ここから：主内容＞＞ランキング一覧本体 -->
<div class="border_01 bg_05" align="center">

({if $rank == 1})

<!-- ここから：主内容＞＞ランキング一覧本体＞＞のループ部分(１位) -->
<table border="0" cellspacing="0" cellpadding="0" style="width:522px;margin:0px auto;">
({*********})
<tr>
<td style="width:522px;height:1px;" class="bg_01" colspan="7"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({foreach from=$list item=item})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:130px;min-height:130px;" class="bg_03" align="center" valign="middle" rowspan="({if $kind == "ashiato" || $kind == "friend"})5({else})7({/if})">

<div class="padding_s">

({if $kind == "ashiato" || $kind == "friend"})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
<img src="({t_img_url filename=$item.c_member.image_filename w=120 h=120 noimg=no_image_midium})"></a>
({else})
<a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$item.c_commu_id})">
<img src="({t_img_url filename=$item.c_commu.image_filename w=120 h=120 noimg=no_logo_midium})"></a>
({/if})

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:85px;" class="bg_05" align="left" valign="middle">

<div class="padding_s">

第({$rank})位

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:302px;" class="bg_09" align="left" valign="middle">

<div class="padding_s">

<span class="b_b">
({if $kind == "ashiato" || $kind == "friend"})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">({$item.c_member.nickname|t_body:'name'})</a> さん
({else})
<a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$item.c_commu_id})">({$item.c_commu.name|t_body:'title'})</a>
({/if})
</span>
：
({if $kind == "ashiato"})
({$item.count})アクセス
({elseif $kind == "friend"})
({$item.count})人
({elseif $kind == "com_member"})
({$item.count})人
({elseif $kind == "com_comment"})
<br>書き込み({$item.count})件
({/if})

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:400px;" class="bg_01" align="center" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="left" valign="middle">

<div class="padding_s">

({if $kind == "ashiato" || $kind == "friend"})
誕生日
({else})
カテゴリ
({/if})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

({if $kind == "ashiato" || $kind == "friend"})
({$item.c_member.birth_month})月({$item.c_member.birth_day})日
({else})
({$item.c_commu.c_commu_category.name})
({/if})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" align="center" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({if $kind == "com_member" || $kind == "com_comment"})
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="left" valign="middle">

<div class="padding_s">

管理人

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

({$item.c_commu.c_member_admin.nickname|t_body:'name'})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" align="center" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({/if})
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="left" valign="middle">

<div class="padding_s">

({if $kind == "ashiato" || $kind == "friend"})
自己紹介
({else})
説明文
({/if})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

({if $kind == "ashiato" || $kind == "friend"})
({$item.c_member.profile.self_intro.value|t_truncate:80:"…"|t_body:'title'|default:"&nbsp;"})
({else})
({$item.c_commu.info|t_truncate:80:"…"|t_body:'title'|default:"&nbsp;"})
({/if})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="7"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({/foreach})
</table>
<!-- ここまで：主内容＞＞ランキング一覧本体＞＞のループ部分(１位) -->

({else})

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ここから：主内容＞＞ランキング一覧本体＞＞のループ部分(2位以下) -->
({foreach from=$list item=item})
<div class="border_01 bg_09" style="width:492px;margin:0px auto;" align="center">
<img src="./skin/dummy.gif" class="v_spacer_m">
<table border="0" cellspacing="0" cellpadding="0" style="width:480px;margin:0px auto;">
({*********})
<tr>
<td style="width:480px;height:1px;" class="bg_01" colspan="7"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:100px;" class="bg_03" align="center" valign="middle" rowspan="({if $kind == "ashiato" || $kind == "friend"})6({else})7({/if})">

<div class="padding_s">

({if $kind == "ashiato" || $kind == "friend"})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
<img src="({t_img_url filename=$item.c_member.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
({else})
<a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$item.c_commu_id})">
<img src="({t_img_url filename=$item.c_commu.image_filename w=76 h=76 noimg=no_logo_small})" class="pict"></a>
({/if})

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:85px;" class="bg_05" align="left" valign="middle">

<div class="padding_s">

第({$rank})位

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:291px;" class="bg_09" align="left" valign="middle">

<div class="padding_s">

<span class="b_b">
({if $kind == "ashiato" || $kind == "friend"})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">({$item.c_member.nickname|t_body:'name'})</a> さん
({else})
<a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$item.c_commu_id})">({$item.c_commu.name|t_body:'title'})</a>
({/if})
</span>

：
({if $kind == "ashiato"})
({$item.count})アクセス
({elseif $kind == "friend"})
({$item.count})人
({elseif $kind == "com_member"})
({$item.count})人
({elseif $kind == "com_comment"})
書き込み({$item.count})件
({/if})

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:389px;" class="bg_01" align="center" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="left" valign="middle">

<div class="padding_s">

({if $kind == "ashiato" || $kind == "friend"})
誕生日
({else})
カテゴリ
({/if})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

({if $kind == "ashiato" || $kind == "friend"})
({$item.c_member.birth_month})月({$item.c_member.birth_day})日
({else})
({$item.c_commu.c_commu_category.name})
({/if})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" align="center" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({if $kind == "com_member" || $kind == "com_comment"})
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="left" valign="middle">

<div class="padding_s">

管理人

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

({$item.c_commu.c_member_admin.nickname|t_body:'name'})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" align="center" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({/if})
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="left" valign="middle">

<div class="padding_s">

({if $kind == "ashiato" || $kind == "friend"})
自己紹介
({else})
説明文
({/if})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

({if $kind == "ashiato" || $kind == "friend"})
({$item.c_member.profile.self_intro.value|t_truncate:80:"…"|t_body:'title'|default:"&nbsp;"})
({else})
({$item.c_commu.info|t_truncate:80:"…"|t_body:'title'|default:"&nbsp;"})
({/if})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="7"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<img src="./skin/dummy.gif" class="v_spacer_m">
</div>

<img src="./skin/dummy.gif" class="v_spacer_l">
({/foreach})
<!-- ここまで：主内容＞＞ランキング一覧本体＞＞のループ部分(2位以下) -->

({/if})

</div>
<!-- ここまで：＞＞ランキング一覧本体 -->
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：ランキング一覧＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：ランキング一覧****** -->
<!-- ********************************** -->

<img src="./skin/dummy.gif" class="v_spacer_l">

({/foreach})

({********************************})
({**ここまで：メインコンテンツ（右）**})
({********************************})
</td>
</tr>
</table>({*END:container*})
</td>
</tr>
<tr>
<td class="container inc_page_footer">
({$inc_page_footer|smarty:nodefaults})
</td>
</tr>
</table>
({ext_include file="inc_extension_pagelayout_bottom.tpl"})
</body>
</html>

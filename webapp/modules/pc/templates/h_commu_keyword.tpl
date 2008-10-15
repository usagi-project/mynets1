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
<td class="full_content" align="center">
({***************************})
({**ここから：メインコンテンツ**})
({***************************})
({capture name="keyword_url"})({$keyword|escape:url})({/capture})

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ************************************ -->
<!-- ******ここから：トピック検索****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:650px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="left">
<!-- *ここから：トピック検索＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:600px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">({$target_name})検索</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<div class="border_01 bg_05" align="center">

<img src="./skin/dummy.gif" class="v_spacer_l">

<table border="0" cellspacing="0" cellpadding="0" style="width:562px;margin:0px auto;">
({*********})
<tr>
<td style="width:562px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:560px;" class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">

<!-- ここから：主内容＞＞並び替え・カテゴリ・検索 -->

({t_form _method=get m=pc a=page_h_commu_keyword})
<img src="./skin/dummy.gif" class="v_spacer_l">

キーワード<img src="({t_img_url_skin filename=icon_arrow_2})" class="icon">
<input name="keyword" size="25" value="({$keyword})">&nbsp;&nbsp;
<input type="submit" class="submit" value="AND検索" name="submit">&nbsp;&nbsp;
<input type="submit" class="submit" value="OR検索" name="submit">
&nbsp;&nbsp;
<a href="({t_url m=pc a=page_h_diary_list_all})&amp;keyword=({$smarty.capture.keyword_url|smarty:nodefaults})">日記検索</a>&nbsp;
|&nbsp;
<a href="http://www.google.com/search?hl=ja&amp;lr=lang_ja&amp;q=({$smarty.capture.keyword_url|smarty:nodefaults})" target="_blank">ウェブ検索</a>

</form>

<img src="./skin/dummy.gif" class="v_spacer_l">

<table border="0" cellspacing="0" cellpadding="0" style="width:532px;">
({foreach from=$c_commu_category_parent_list item=item_parent})
<tr>
<td style="width:70px;" valign="top">

<div style="text-align:left;padding:3px;" class="b_b">
({$item_parent.name})
</div>

</td>
<td style="width:1em;" align="center" valign="top">

<div style="text-align:left;padding:3px;">
：
</div>

</td>
<td valign="top">

<div style="text-align:left;padding:3px;">
({foreach name=cccl from=$c_commu_category_list[$item_parent.c_commu_category_parent_id] item=item_cat})
<a href="({t_url m=pc a=page_h_com_find_all})&amp;order=r_datetime&amp;keyword=({$smarty.capture.keyword_url|smarty:nodefaults})&amp;category_id=({$item_cat.c_commu_category_id})">({$item_cat.name})(({$item_cat.count_commu_category}))</a>
({if !$smarty.foreach.cccl.last}) - ({/if})
({/foreach})
</div>

</td>
</tr>
({/foreach})
</table>
<!-- ここまで：主内容＞＞トピック表示 -->

</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>

<img src="./skin/dummy.gif" class="v_spacer_l">

</div>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：トピック検索＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：トピック検索****** -->
<!-- ************************************ -->

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ************************************ -->
<!-- ******ここから：トピック一覧****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:650px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="left">
<!-- *ここから：トピック一覧＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:600px;padding:2px 0px;" class="bg_06"><span class="c_00"><span class="b_b">({$target_name})一覧</span>&nbsp;&nbsp;***&nbsp;

({if $numrows})
    ({$numrows})
({else})
    0
({/if})

件&nbsp;が該当しました。</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<!-- ここから：主内容＞＞トピック一覧件数表示タブ -->
<table border="0" cellspacing="0" cellpadding="0" style="width:634px;">
    <tr>
        <td style="width:634px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td style="width:632px;" class="bg_02" align="right" valign="middle">
        <div style="padding:4px 3px;">
        トータル数[({$numrows|default:0})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br>
        </div>
        </td>
        <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td style="width:634px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
</table>
<!-- ここまで：主内容＞＞トピック一覧件数表示タブ -->
<!-- ここから：主内容＞＞トピック一覧本体 -->
<div class="border_01 bg_05" align="center">

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ここから：主内容＞＞トピック一覧本体＞＞のループ部分 -->
({foreach from=$resultComment item=item})
<div class="border_01 bg_09" style="width:562px;margin:0px auto;" align="center">
<img src="./skin/dummy.gif" class="v_spacer_m">
<table border="0" cellspacing="0" cellpadding="0" style="width:550px;margin:0px auto;">
({*********})
<tr>
<td style="width:550px;height:1px;" class="bg_01" colspan="7"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:90px;" class="bg_03" align="center" valign="middle" rowspan="7">

<div class="padding_s">

<a href="({t_url m=pc a=page_c_topic_detail})&amp;target_c_commu_topic_id=({$item.c_commu_topic_id})">
<img src="({t_img_url filename=$item.commu_image w=76 h=76 noimg=no_logo_small})"></a>

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:85px;" class="bg_05" align="left" valign="middle">

<div class="padding_s">

トピック名

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:371px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

({$item.topic_name|t_truncate:60:"…"|t_body:'title'})
</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:457px;" class="bg_01" align="center" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="left" valign="middle">

<div class="padding_s">

コミュニティ名
</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div class="padding_s">
({$item.commu_name|t_truncate:60:"…"|t_body:'title'})
</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" align="center" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="left" valign="middle" width="80">

<div class="padding_s">

投稿されたコメントの内容

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

({$item.body|t_truncate:280:"…"|t_body:'community'|bbcode2del})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" align="center" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="left" valign="middle">

<div class="padding_s">

投稿日時

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="center" valign="middle">

<table border="0" cellspacing="0" cellpadding="0" style="width:371px;">
<tr>
<td style="width:129px;" class="bg_02" align="left">

<div class="padding_s">

({$item.r_datetime})

</div>

</td>
<td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:221px;" class="bg_03" align="center">

<div class="padding_s">

<a href="({$item.url})"><img src="({t_img_url_skin filename=button_shosai})" class="icon"></a>

</div>

</td>
</tr>
</table>

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
<!-- ここまで：主内容＞＞トピック一覧本体＞＞のループ部分 -->

</div>
<!-- ここまで：＞＞トピック一覧本体 -->
<!-- ここから：主内容＞＞トピック一覧件数表示タブ -->
<table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td style="height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td style="width:632px;" class="bg_02" align="right" valign="middle">
        <div style="padding:4px 3px;">
        トータル数[({$numrows|default:0})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br>
        </div>
        </td>
        <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    <tr>
        <td style="height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
</table>
<!-- ここまで：主内容＞＞トピック一覧件数表示タブ -->
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：トピック一覧＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：トピック一覧****** -->
<!-- ************************************ -->

<img src="./skin/dummy.gif" class="v_spacer_l">

({***************************})
({**ここまで：メインコンテンツ**})
({***************************})
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

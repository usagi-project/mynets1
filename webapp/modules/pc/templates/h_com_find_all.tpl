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
<!-- ******ここから：コミュニティ検索****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:650px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="left">
<!-- *ここから：コミュニティ検索＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:600px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">コミュニティ検索・並び替え</span></td>
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

({t_form _method=get m=pc a=page_h_com_find_all})

並び替え<img src="({t_img_url_skin filename=icon_arrow_2})" class="icon">

<a href="({t_url m=pc a=page_h_com_find_all})&amp;val_order=count&amp;keyword=({$smarty.capture.keyword_url|smarty:nodefaults})&amp;category_id=({$search_val_list.category_id})">メンバー数順</a>
|
<a href="({t_url m=pc a=page_h_com_find_all})&amp;val_order=r_datetime&amp;keyword=({$smarty.capture.keyword_url|smarty:nodefaults})&amp;category_id=({$search_val_list.category_id})">作成日順</a>

<img src="./skin/dummy.gif" class="v_spacer_l">

キーワード<img src="({t_img_url_skin filename=icon_arrow_2})" class="icon">
<input name="keyword" size="15" value="({$keyword})">
&nbsp;カテゴリ<img src="({t_img_url_skin filename=icon_arrow_2})" class="icon">
<select name="category_id">
<option value="0">指定なし</option>
({foreach from=$c_commu_category_list item=parent})
({foreach from=$parent item=item})
<option value="({$item.c_commu_category_id})"({if $item.c_commu_category_id == $search_val_list.category_id}) selected="selected"({/if})>({$item.name})</option>
({/foreach})
({/foreach})
</select>
<input type="submit" class="submit" value=" 検 索 ">

<a href="({t_url m=pc a=page_h_diary_list_all})&amp;keyword=({$smarty.capture.keyword_url|smarty:nodefaults})">日記検索</a>
|
<a href="http://www.google.com/search?hl=ja&amp;lr=lang_ja&amp;q=({$smarty.capture.keyword_url|smarty:nodefaults})" target="_blank">ウェブ検索</a>

</form>

<!-- ここまで：主内容＞＞並び替え・カテゴリ・検索 -->

<div style="text-align:right;padding:3px;">
<img src="./skin/dummy.gif" class="icon arrow_1"><a href="({t_url m=pc a=page_h_com_add})">新規作成</a>&nbsp;(作成の前に、似たコミュニティがないかご確認ください)&nbsp;&nbsp;
</div>

<hr>

<!-- ここから：主内容＞＞コミュニティ表示 -->
カテゴリ<img src="({t_img_url_skin filename=icon_arrow_2})" class="icon">

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
<!-- ここまで：主内容＞＞コミュニティ表示 -->

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
<!-- *ここまで：コミュニティ検索＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：コミュニティ検索****** -->
<!-- ************************************ -->

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ************************************ -->
<!-- ******ここから：トピックコメント横断検索****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:650px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="left">
<!-- *ここから：コミュニティ検索＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:600px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">トピック内全検索</span></td>
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

キーワード<img src="({t_img_url_skin filename=icon_arrow_2})" class="icon">
<input name="keyword" size="30" value="({$keyword})">
&nbsp;
<input type="submit" class="submit" value="AND検索" name="submit">&nbsp;&nbsp;
<input type="submit" class="submit" value="OR検索" name="submit">


</form>
<hr>
({$smarty.const.SNS_NAME})内のトピックもコメントもすべて検索します。サイトによっては検索に少々時間がかかることがあります。<br>

<!-- ここまで：主内容＞＞並び替え・カテゴリ・検索 -->

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
<!-- *ここまで：コミュニティ検索＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：コミュニティ検索****** -->
<!-- ************************************ -->

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ************************************ -->
<!-- ******ここから：コミュニティ一覧****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:650px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="left">
<!-- *ここから：コミュニティ一覧＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:600px;padding:2px 0px;" class="bg_06"><span class="c_00"><span class="b_b">コミュニティ一覧</span>&nbsp;&nbsp;***&nbsp;

({if $total_num})
    ({$total_num})
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
({if $start_num != $end_num})
<!-- ここから：主内容＞＞コミュニティ一覧件数表示タブ -->
<table border="0" cellspacing="0" cellpadding="0" style="width:634px;">
({*********})
<tr>
<td style="width:634px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:632px;" class="bg_02" align="right" valign="middle">
<div style="padding:4px 3px;">

トータル数[({$total_num|default:0})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br>

</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:634px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞コミュニティ一覧件数表示タブ -->
({/if})
<!-- ここから：主内容＞＞コミュニティ一覧本体 -->
<div class="border_01 bg_05" align="center">

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ここから：主内容＞＞コミュニティ一覧本体＞＞のループ部分 -->
({foreach from=$c_commu_search_list item=c_commu_search})
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

<a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$c_commu_search.c_commu_id})">
<img src="({t_img_url filename=$c_commu_search.image_filename w=76 h=76 noimg=no_logo_small})"></a>

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:85px;" class="bg_05" align="left" valign="middle">

<div class="padding_s">

コミュニティ名

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:371px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

({$c_commu_search.name|t_truncate:60:"…"|t_body:'title'})

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

メンバー数

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

({$c_commu_search.count_commu_member})人

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

説明文

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

({$c_commu_search.info|t_truncate:160:"…"|t_body:'title'|bbcode2del})

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

カテゴリ

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="center" valign="middle">

<table border="0" cellspacing="0" cellpadding="0" style="width:371px;">
<tr>
<td style="width:99px;" class="bg_02" align="left">

<div class="padding_s">

({$c_commu_search.c_commu_category_name})

</div>

</td>
<td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:271px;" class="bg_03" align="center">

<div class="padding_s">

<a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$c_commu_search.c_commu_id})"><img src="({t_img_url_skin filename=button_shosai})" class="icon"></a>

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
<!-- ここまで：主内容＞＞コミュニティ一覧本体＞＞のループ部分 -->

</div>
<!-- ここまで：＞＞コミュニティ一覧本体 -->
({if $start_num != $end_num})
<!-- ここから：主内容＞＞コミュニティ一覧件数表示タブ -->
<table border="0" cellspacing="0" cellpadding="0" style="width:634px;">
({*********})
<tr>
<td style="width:634px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:632px;" class="bg_02" align="right" valign="middle">
<div style="padding:4px 3px;">

トータル数[({$total_num|default:0})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br>

</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:634px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞コミュニティ一覧件数表示タブ -->
({/if})
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：コミュニティ一覧＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：コミュニティ一覧****** -->
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

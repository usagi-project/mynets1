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

<table class="container" border="0" cellspacing="0" cellpadding="0">
<tr><td class="full_content">
({***************************})
({**ここから：メインコンテンツ**})
({***************************})

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ************************************ -->
<!-- ******ここから：コミュニティ最新書き込み一覧****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:650px;margin:0px auto;" class="border_01">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01">
({*ここから：header*})
<!-- 小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:240px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">コミュニティ最新書き込み</span></td>
<td style="width:378px;" align="right" class="bg_06">&nbsp;</td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->

({if $total_num})
<!-- ここから：主内容＞＞メンバー一覧件数表示タブ -->
<table border="0" cellspacing="0" cellpadding="1" style="width:636px;" class="border_01">
<tr>
<td style="width:634px;" align="right" class="bg_02">

<div class="padding_s">

                トータル数[({$total_num|default:0})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br>

</div>

</td>
</tr>
</table>
<!-- ここまで：主内容＞＞メンバー一覧件数表示タブ -->
<!-- ここから：主内容＞＞コメント一覧 -->
<table border="0" cellspacing="1" cellpadding="0" style="width:636px;">
({foreach from=$h_com_comment_list item=item})
<tr>
<td style="width:180px;" class="bg_05">

<div class="padding_s">

({$item.e_datetime|date_format:"%Y年%m月%d日 %H:%M"})

</div>

</td>
<td style="width:453px;" class="bg_02">

<div class="padding_s">

<a href="({t_url m=pc a=page_c_topic_detail})&amp;target_c_commu_topic_id=({$item.c_commu_topic_id})&amp;comment_count=({$item.number})">({$item.c_commu_topic_name|t_body:'title'}) (({$item.number}))</a> (({$item.c_commu_name|t_body:'name'}))
({if $item.image_filename1 || $item.image_filename2 || $item.image_filename3})<img src="({t_img_url_skin filename=icon_camera})" class="icon">({/if})<br>

</div>

</td>
</tr>
({/foreach})
</table>
<!-- ここまで：主内容＞＞コメント一覧 -->
<!-- ここから：主内容＞＞メンバー一覧件数表示タブ -->
<table border="0" cellspacing="0" cellpadding="1" style="width:636px;" class="border_01">
<tr>
<td style="width:634px;" align="right" class="bg_02">

<div class="padding_s">

                トータル数[({$total_num|default:0})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br>

</div>

</td>
</tr>
</table>
<!-- ここまで：主内容＞＞メンバー一覧件数表示タブ -->

({else})

<!-- ここから：主内容＞＞0件 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;">
({*********})
<tr>
<td style="width:636px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:634px;" class="bg_02" valign="middle">

<div class="padding_s">

まだコミュニティ書き込みがありません。

</div>

</td>
<td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞0件 -->

({/if})

<!-- ここまで：主内容 -->
</td>
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：コミュニティ最新書き込み一覧****** -->
<!-- ************************************ -->

<img src="./skin/dummy.gif" class="v_spacer_l">

<img src="./skin/dummy.gif" class="v_spacer_l">

<img src="./skin/dummy.gif" class="v_spacer_l">

({***************************})
({**ここまで：メインコンテンツ**})
({***************************})
</td></tr>
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

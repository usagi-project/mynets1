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
<!-- ******ここから：メッセージテーブル****** -->
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
<td style="width:600px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">日記コメント記入履歴</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->

({if $total_num})
<!-- ここから：主内容＞＞タブ -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;" class="border_01">
<tr>
<td style="width:634px;" align="right" class="bg_02">

<div class="padding_s">

({if $is_prev})
<a href="({t_url m=pc a=page_h_diary_comment_list})&amp;page=({$page})&amp;direc=-1">前を表示</a>&nbsp;&nbsp;
({/if})({$pager.start})件～({$pager.end})件を表示({if $is_next})
&nbsp;&nbsp;<a href="({t_url m=pc a=page_h_diary_comment_list})&amp;page=({$page})&amp;direc=1">次を表示</a>
({/if})

</div>

</td>
</tr>
</table>
<!-- ここまで：主内容＞＞タブ -->
<!-- ここから：主内容＞＞コメント一覧 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;">
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({foreach from=$h_diary_comment_list item=item})
<tr>
<td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:180px;" class="bg_05" align="center">

<div class="padding_s">

({$item.e_datetime|date_format:"%Y年%m月%d日 %H:%M"})
</div>

</td>
<td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:453px;" class="bg_02">

<div class="padding_s">
<a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})&amp;c_diary_comment_count=({$item.comment_count})">({$item.subject|t_body:'title'}) (コメント:({$item.comment_count})|閲覧:({$item.etsuran_count}))</a> (({$item.nickname|t_body:'name'}))({if $item.public_flag == 'friend'})<img src="({t_img_url_skin filename=friend_icon f=gif})" align="absmiddle">({/if})
({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})<img src="({t_img_url_skin filename=icon_camera})" class="icon">({/if})
({if $item.edit_flag})
<img src="skin/default/img/comment.gif" align="absmiddle">
({/if})
({if $item.view_flag})
<img src="skin/default/img/new2.gif" align="absmiddle">
({/if})

</div>

</td>
<td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({/foreach})
</table>
<!-- ここまで：主内容＞＞コメント一覧 -->
<!-- ここから：主内容＞＞タブ -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;" class="border_01">
<tr>
<td style="width:634px;" align="right" class="bg_02">

<div class="padding_s">

({if $is_prev})
<a href="({t_url m=pc a=page_h_diary_comment_list})&amp;page=({$page})&amp;direc=-1">前を表示</a>&nbsp;&nbsp;
({/if})({$pager.start})件～({$pager.end})件を表示({if $is_next})
&nbsp;&nbsp;<a href="({t_url m=pc a=page_h_diary_comment_list})&amp;page=({$page})&amp;direc=1">次を表示</a>
({/if})

</div>

</td>
</tr>
</table>
<!-- ここまで：主内容＞＞タブ -->

({else})
<!-- ここから：主内容＞＞メッセージ -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;" class="border_01">
<tr>
<td class="bg_02">

<div style="padding:10px;">

まだ記入した日記コメントはありません。

</div>

</td>
</tr>
</table>
<!-- ここまで：主内容＞＞メッセージ -->

({/if})

<!-- ここまで：主内容 -->
({*ここまで：body*})
</td>
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
<!-- ******ここまで：メッセージテーブル****** -->
<!-- ************************************ -->

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

({$inc_html_header|smarty:nodefaults})
<body>
<script type="text/javascript" src="js/javascripts/oneword.js"></script>
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

<img src="./skin/dummy.gif" class="v_spacer_l">

({if $target_friend_list_disp})

<!-- *********************************************** -->
<!-- ******ここから：マイフレンド一覧（メンバー有り）****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:580px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:566px;" class="bg_00"><img src="./skin/dummy.gif" style="width:566px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="left">
<!-- *ここから：マイフレンド一覧＞内容* -->
({*ここから：header*})
<!-- 小タイトル -->
<div class="border_01">
<table border="0" cellspacing="0" cellpadding="0" style="width:564px;">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:150px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">({$WORD_FRIEND})リスト</span></td>
<td style="width:378px;" align="right" class="bg_06">&nbsp;</td>
</tr>
</table>
</div>
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<!-- ここから：ページ切り替えタブ：上 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:564px;">
({*********})
<tr>
<td style="width:564px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:562px;" class="bg_05" align="center">

<div class="padding_s">

[({foreach from=$page_num item=item})
({if $item!=$page})<a href="({t_url m=pc a=page_fh_friend_list})&amp;page=({$item})&amp;target_c_member_id=({$target_member.c_member_id})">({$item})</a>
({else})({$item})
({/if})
({/foreach})]

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:564px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：ページ切り替えタブ：上 -->
<!-- ここから：ページ切り替えメニュー：上 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:564px;">
({*********})
<tr>
<td style="width:564px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:562px;" class="bg_05" align="right">

<div class="padding_s">

({if $is_prev})&nbsp;<a href="({t_url m=pc a=page_fh_friend_list})&amp;target_c_member_id=({$target_member.c_member_id})&amp;direc=-1&amp;page=({$page})">前を表示</a>&nbsp;({/if})
({$start_num})件～({$end_num})件を表示&nbsp;
({if $is_next})&nbsp;<a href="({t_url m=pc a=page_fh_friend_list})&amp;target_c_member_id=({$target_member.c_member_id})&amp;direc=1&amp;page=({$page})">次を表示</a>&nbsp;({/if})
&nbsp;

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:564px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：ページ切り替えメニュー：上 -->
<!-- ここから：サムネイルとニックネーム -->
<table border="0" cellspacing="0" cellpadding="0" style="width:564px;">
({*********})
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({if $target_friend_list_disp.0})
<!-- ここから：サムネイル＞＞一段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=0 num=5})
<td style="width:111px;" class="bg_03" align="center">
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
({if $item})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})" oneword='({if $item.friend_oneword})({$item.friend_oneword|t_body:'dengon'|default:"&nbsp;"})({else})・・・・・・({/if})' class="oneword_bln">
<img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
({else})
<img src="./skin/dummy.gif" class="dummy" style="width:76px;height:76px;">
({/if})
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：サムネイル＞＞一段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<!-- ここから：ニックネーム＞＞一段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=0 num=5})
<td style="width:111px;" class="bg_02" align="center">
({if $item})
<img src="./skin/dummy.gif" class="v_spacer_s">
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
({$item.nickname|t_body:'name'}) (({$item.friend_count}))</a>
<img src="./skin/dummy.gif" class="v_spacer_s">
({else})
&nbsp;
({/if})
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：ニックネーム＞＞一段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({/if})
({*********})
({if $target_friend_list_disp.5})
<!-- ここから：サムネイル＞＞二段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=5 num=5})
<td style="width:111px;" class="bg_03" align="center">
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
({if $item})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})" oneword='({if $item.friend_oneword})({$item.friend_oneword|t_body:'dengon'|default:"&nbsp;"})({else})・・・・・・({/if})' class="oneword_bln">
<img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
({else})
<img src="./skin/dummy.gif" class="dummy" style="width:76px;height:76px;">
({/if})
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：サムネイル＞＞二段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<!-- ここから：ニックネーム＞＞二段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=5 num=5})
<td style="width:111px;" class="bg_02" align="center">
({if $item})
<img src="./skin/dummy.gif" class="v_spacer_s">
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
({$item.nickname|t_body:'name'}) (({$item.friend_count}))</a>
<img src="./skin/dummy.gif" class="v_spacer_s">
({else})
&nbsp;
({/if})
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：ニックネーム＞＞二段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({/if})
({*********})
({if $target_friend_list_disp.10})
<!-- ここから：サムネイル＞＞三段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=10 num=5})
<td style="width:111px;" class="bg_03" align="center">
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
({if $item})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})" oneword='({if $item.friend_oneword})({$item.friend_oneword|t_body:'dengon'|default:"&nbsp;"})({else})・・・・・・({/if})' class="oneword_bln">
<img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
({else})
<img src="./skin/dummy.gif" class="dummy" style="width:76px;height:76px;">
({/if})
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：サムネイル＞＞三段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<!-- ここから：ニックネーム＞＞三段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=10 num=5})
<td style="width:111px;" class="bg_02" align="center">
({if $item})
<img src="./skin/dummy.gif" class="v_spacer_s">
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
({$item.nickname|t_body:'name'}) (({$item.friend_count}))</a>
<img src="./skin/dummy.gif" class="v_spacer_s">
({else})
&nbsp;
({/if})
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
<!-- ここまで：ニックネーム＞＞三段目 -->
({*********})
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({/if})
({*********})
({if $target_friend_list_disp.15})
<!-- ここから：サムネイル＞＞四段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=15 num=5})
<td style="width:111px;" class="bg_03" align="center">
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
({if $item})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})" oneword='({if $item.friend_oneword})({$item.friend_oneword|t_body:'dengon'|default:"&nbsp;"})({else})・・・・・・({/if})' class="oneword_bln">
<img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
({else})
<img src="./skin/dummy.gif" class="dummy" style="width:76px;height:76px;">
({/if})
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：サムネイル＞＞四段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<!-- ここから：ニックネーム＞＞四段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=15 num=5})
<td style="width:111px;" class="bg_02" align="center">
({if $item})
<img src="./skin/dummy.gif" class="v_spacer_s">
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
({$item.nickname|t_body:'name'}) (({$item.friend_count}))</a>
<img src="./skin/dummy.gif" class="v_spacer_s">
({else})
&nbsp;
({/if})
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
<!-- ここまで：ニックネーム＞＞四段目 -->
({*********})
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({/if})
({*********})
({if $target_friend_list_disp.20})
<!-- ここから：サムネイル＞＞五段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=20 num=5})
<td style="width:111px;" class="bg_03" align="center">
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
({if $item})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})" oneword='({if $item.friend_oneword})({$item.friend_oneword|t_body:'dengon'|default:"&nbsp;"})({else})・・・・・・({/if})' class="oneword_bln">
<img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
({else})
<img src="./skin/dummy.gif" class="dummy" style="width:76px;height:76px;">
({/if})
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：サムネイル＞＞五段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<!-- ここから：ニックネーム＞＞五段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=20 num=5})
<td style="width:111px;" class="bg_02" align="center">
({if $item})
<img src="./skin/dummy.gif" class="v_spacer_s">
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
({$item.nickname|t_body:'name'}) (({$item.friend_count}))</a>
<img src="./skin/dummy.gif" class="v_spacer_s">
({else})
&nbsp;
({/if})
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：ニックネーム＞＞五段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({/if})
({*********})
({if $target_friend_list_disp.25})
<!-- ここから：サムネイル＞＞六段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=25 num=5})
<td style="width:111px;" class="bg_03" align="center">
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
({if $item})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})" oneword='({if $item.friend_oneword})({$item.friend_oneword|t_body:'dengon'|default:"&nbsp;"})({else})・・・・・・({/if})' class="oneword_bln">
<img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
({else})
<img src="./skin/dummy.gif" class="dummy" style="width:76px;height:76px;">
({/if})
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：サムネイル＞＞六段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<!-- ここから：ニックネーム＞＞六段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=25 num=5})
<td style="width:111px;" class="bg_02" align="center">
({if $item})
<img src="./skin/dummy.gif" class="v_spacer_s">
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
({$item.nickname|t_body:'name'}) (({$item.friend_count}))</a>
<img src="./skin/dummy.gif" class="v_spacer_s">
({else})
&nbsp;
({/if})
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：ニックネーム＞＞六段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({/if})
({*********})
({if $target_friend_list_disp.30})
<!-- ここから：サムネイル＞＞七段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=30 num=5})
<td style="width:111px;" class="bg_03" align="center">
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
({if $item})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})" oneword='({if $item.friend_oneword})({$item.friend_oneword|t_body:'dengon'|default:"&nbsp;"})({else})・・・・・・({/if})' class="oneword_bln">
<img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
({else})
<img src="./skin/dummy.gif" class="dummy" style="width:76px;height:76px;">
({/if})
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：サムネイル＞＞七段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<!-- ここから：ニックネーム＞＞七段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=30 num=5})
<td style="width:111px;" class="bg_02" align="center">
({if $item})
<img src="./skin/dummy.gif" class="v_spacer_s">
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
({$item.nickname|t_body:'name'}) (({$item.friend_count}))</a>
<img src="./skin/dummy.gif" class="v_spacer_s">
({else})
&nbsp;
({/if})
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
<!-- ここまで：ニックネーム＞＞七段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({/if})

({if $target_friend_list_disp.35})
<!-- ここから：サムネイル＞＞八段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=35 num=5})
<td style="width:111px;" class="bg_03" align="center">
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
({if $item})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})" oneword='({if $item.friend_oneword})({$item.friend_oneword|t_body:'dengon'|default:"&nbsp;"})({else})・・・・・・({/if})' class="oneword_bln">
<img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
({else})
<img src="./skin/dummy.gif" class="dummy" style="width:76px;height:76px;">
({/if})
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：サムネイル＞＞八段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<!-- ここから：ニックネーム＞＞八段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=35 num=5})
<td style="width:111px;" class="bg_02" align="center">
({if $item})
<img src="./skin/dummy.gif" class="v_spacer_s">
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
({$item.nickname|t_body:'name'}) (({$item.friend_count}))</a>
<img src="./skin/dummy.gif" class="v_spacer_s">
({else})
&nbsp;
({/if})
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：ニックネーム＞＞八段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({/if})
({*********})
({if $target_friend_list_disp.40})
<!-- ここから：サムネイル＞＞九段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=40 num=5})
<td style="width:111px;" class="bg_03" align="center">
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
({if $item})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})" oneword='({if $item.friend_oneword})({$item.friend_oneword|t_body:'dengon'|default:"&nbsp;"})({else})・・・・・・({/if})' class="oneword_bln">
<img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
({else})
<img src="./skin/dummy.gif" class="dummy" style="width:76px;height:76px;">
({/if})
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：サムネイル＞＞九段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<!-- ここから：ニックネーム＞＞九段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=40 num=5})
<td style="width:111px;" class="bg_02" align="center">
({if $item})
<img src="./skin/dummy.gif" class="v_spacer_s">
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
({$item.nickname|t_body:'name'}) (({$item.friend_count}))</a>
<img src="./skin/dummy.gif" class="v_spacer_s">
({else})
&nbsp;
({/if})
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
<!-- ここまで：ニックネーム＞＞九段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({/if})
({*********})
({if $target_friend_list_disp.45})
<!-- ここから：サムネイル＞＞十段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=45 num=5})
<td style="width:111px;" class="bg_03" align="center">
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
({if $item})
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})" oneword='({if $item.friend_oneword})({$item.friend_oneword|t_body:'dengon'|default:"&nbsp;"})({else})・・・・・・({/if})' class="oneword_bln">
<img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
({else})
<img src="./skin/dummy.gif" class="dummy" style="width:76px;height:76px;">
({/if})
<img src="./skin/dummy.gif" class="v_spacer_l" style="width:111px;">
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：サムネイル＞＞十段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<!-- ここから：ニックネーム＞＞十段目 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({t_loop from=$target_friend_list_disp start=45 num=5})
<td style="width:111px;" class="bg_02" align="center">
({if $item})
<img src="./skin/dummy.gif" class="v_spacer_s">
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
({$item.nickname|t_body:'name'}) (({$item.friend_count}))</a>
<img src="./skin/dummy.gif" class="v_spacer_s">
({else})
&nbsp;
({/if})
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/t_loop})
</tr>
({*********})
<!-- ここまで：ニックネーム＞＞十段目 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="11"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({/if})

</table>
<!-- ここまで：サムネイルとニックネーム -->
<!-- ここから：ページ切り替えタブ：下 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:564px;">
({*********})
<tr>
<td style="width:564px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:562px;" class="bg_05" align="center">

<div class="padding_s">

[({foreach from=$page_num item=item})
({if $item!=$page})<a href="({t_url m=pc a=page_fh_friend_list})&amp;page=({$item})&amp;target_c_member_id=({$target_member.c_member_id})">({$item})</a>
({else})({$item})
({/if})
({/foreach})]

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:564px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：ページ切り替えタブ：下 -->
<!-- ここから：ページ切り替えメニュー：下 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:564px;">
<tr>
<td style="width:564px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:562px;" class="bg_05" align="right">

<div class="padding_s">

({if $is_prev})&nbsp;<a href="({t_url m=pc a=page_fh_friend_list})&amp;target_c_member_id=({$target_member.c_member_id})&amp;direc=-1&amp;page=({$page})">前を表示</a>&nbsp;({/if})
({$start_num})件～({$end_num})件を表示&nbsp;
({if $is_next})&nbsp;<a href="({t_url m=pc a=page_fh_friend_list})&amp;target_c_member_id=({$target_member.c_member_id})&amp;direc=1&amp;page=({$page})">次を表示</a>&nbsp;({/if})
&nbsp;

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:564px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：ページ切り替えメニュー：下 -->
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：マイフレンド一覧＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:566px;" class="bg_00"><img src="./skin/dummy.gif" style="width:566px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：マイフレンド一覧（メンバー有り）****** -->
<!-- *********************************************** -->

({else})

<!-- *********************************************** -->
<!-- ******ここから：マイフレンド一覧（メンバー無し）****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:580px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:566px;" class="bg_00"><img src="./skin/dummy.gif" style="width:566px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="left">
<!-- *ここから：マイフレンド一覧＞内容* -->
({*ここから：header*})
<!-- 小タイトル -->
<div class="border_01">
<table border="0" cellspacing="0" cellpadding="0" style="width:564px;">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:150px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">({$WORD_MY_FRIEND})一覧</span></td>
<td style="width:378px;" align="right" class="bg_06">&nbsp;</td>
</tr>
</table>
</div>
({*ここまで：header*})
({*ここから：body*})
<table border="0" cellspacing="0" cellpadding="0" style="width:564px;">
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
<!-- ここから：主内容 -->
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:564px;height:50px;" class="bg_03" align="center" valign="middle">

({$WORD_MY_FRIEND})登録がありません。

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
<!-- ここまで：主内容 -->
<tr>
<td style="width:564px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
</table>
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：マイフレンド一覧＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:566px;" class="bg_00"><img src="./skin/dummy.gif" style="width:566px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：マイフレンド一覧（メンバー無し）****** -->
<!-- *********************************************** -->

({/if})

<!-- 今日のひとことふきだしアンカー -->
<span id="wedge"></span>
<script type="text/javascript">
    /*今日のひとこと初期化*/
    makeballoon();
</script>
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

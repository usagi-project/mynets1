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
<td style="width:5px;"><img src="./skin/dummy.gif" style="width:5px;" class="dummy"></td>({*<--spacer*})
<td class="left_content_175" align="center" valign="top">
({********************************})
({**ここから：メインコンテンツ（左）**})
({********************************})

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- *********************************************** -->
<!-- ******ここから：メッセージボックス左メニュー****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:165px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:151px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_02" align="center">
<!-- *ここから：メッセージボックス左メニュー＞内容* -->
({*ここから：header*})
<!-- 無し -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:151px;">
<tr>
({if $box != "inbox"})
<td align="left" style="width:151px;padding:3px;" class="bg_02 border_10">
<img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1"><a href="({t_url m=pc a=page_h_message_box})&amp;box=inbox">受信メッセージ</a>
({else})
<td align="left" style="width:151px;padding:3px;" class="bg_09 border_10">
<img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1">受信メッセージ
({/if})
</td>
</tr>
<tr>
({if $box != "outbox"})
<td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_02 border_10">
<img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1"><a href="({t_url m=pc a=page_h_message_box})&amp;box=outbox">送信済みメッセージ</a>
({else})
<td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_09 border_10">
<img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1">送信済みメッセージ
({/if})
</td>
</tr>
<tr>
({if $box != "savebox"})
<td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_02 border_10">
<img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1"><a href="({t_url m=pc a=page_h_message_box})&amp;box=savebox">下書きメッセージ</a>
({else})
<td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_09 border_10">
<img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1">下書きメッセージ
({/if})
</td>
</tr>
<tr>
({if $box != "trash"})
<td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_02 border_10">
<img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1"><a href="({t_url m=pc a=page_h_message_box})&amp;box=trash">ごみ箱</a>
({else})
<td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_09 border_10">
<img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1">ごみ箱
({/if})
</td>
</tr>
</table>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：メッセージボックス左メニュー＞＞内容* -->
</td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：メッセージボックス左メニュー****** -->
<!-- *********************************************** -->

<img src="./skin/dummy.gif" class="v_spacer_l">

({********************************})
({**ここまで：メインコンテンツ（左）**})
({********************************})
</td>
<td style="width:5px;"><img src="./skin/dummy.gif" style="width:5px;" class="dummy"></td>({*<--spacer*})
<td class="right_content_535" valign="top">
({********************************})
({**ここから：メインコンテンツ（右）**})
({********************************})

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- **************************** -->
<!-- ******ここから：Box一覧****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:520px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:506px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01">
<!-- *ここから：Box一覧＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:506px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:468px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">
({if $box == "inbox" || !$box })
受信メッセージ
({elseif $box == "outbox"})
送信済みメッセージ
({elseif $box == "savebox"})
下書きメッセージ
({elseif $box == "trash"})
ごみ箱
({/if})
</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->

<!-- ここから：主内容＞＞メッセージ -->
<div align="left" style="padding:0px;" class="bg_09">

({*～メッセージ挿入可～*})

</div>
<!-- ここまで：主内容＞＞メッセージ -->

({if $box == "inbox" || !$box })

 <!-- ここから：主内容＞＞受信箱＞＞検索BOX -->
({capture name="inbox_search_box"})
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="width:auto;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:50%;" class="bg_05" align="right">

<div class="padding_s">
({t_form _method=get m=pc a=page_h_message_box})
<input type="hidden" name="box" value="({$box})">
受信箱内キーワード<img src="({t_img_url_skin filename=icon_arrow_2})" class="icon">
<input type="text" size="15" name="keyword" class="text border_01" value="({$keyword})">
<input type="hidden" name="target_c_member_id" value="">
<input type=submit  class="submit"  value="  検　索  ">
</form>
</div>

</td>
</tr>
({*********})
</table>
({/capture})

<!-- ここまで：主内容＞＞受信箱＞＞検索BOX -->

({if $count_c_message_ru_list})

<!-- ここから：主内容＞＞受信箱＞＞ページ切り替えタブ -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="width:auto;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:25%;" class="bg_05" align="left">

<div class="padding_s">

&nbsp;<img src="({t_img_url_skin filename=icon_mail_4})" class="icon">&nbsp;…&nbsp;返信済み

</div>

</td>
<td class="bg_05" align="right">

<div class="padding_s">

トータル数[({$total_num|default:0})]件&nbsp;&nbsp;({$page_link|smarty:nodefaults})<br>
</div>

</td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞受信箱＞＞ページ切り替えタブ -->

<!-- ここから：主内容＞＞受信箱＞＞検索BOX -->
({$smarty.capture.inbox_search_box|smarty:nodefaults})
<!-- ここまで：主内容＞＞受信箱＞＞検索BOX -->
({t_form m=pc a=do_h_message_box_delete_message})
<input type="hidden" name="sessid" value="({$PHPSESSID})">

<!-- ここから：主内容＞＞受信箱＞＞メール内容リスト -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:35px;height:19px;" class="bg_08">&nbsp;</td>
<td style="width:35px;" class="bg_08">削除</td>
<td style="width:130px;" class="bg_08"><span class="b_b">送信者</span></td>
<td style="width:220px;" class="bg_08"><span class="b_b">件 名</span></td>
<td style="width:78px;" class="bg_08"><span class="b_b">日 付</span></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({foreach from=$c_message_ru_list item=c_message_ru})
<tr>
<td class="bg_({if $c_message_ru.is_read})02({else})09({/if})" align="center"><img src="({if $c_message_ru.is_hensin})({t_img_url_skin filename=icon_mail_4})({elseif $c_message_ru.is_read})({t_img_url_skin filename=icon_mail_2})({else})({t_img_url_skin filename=icon_mail_1})({/if})" class="icon"></td>
<td class="bg_({if $c_message_ru.is_read})02({else})09({/if})"><input name="c_message_id[]" value="({$c_message_ru.c_message_id})" type="checkbox" class="no_bg"></td>
<td class="bg_({if $c_message_ru.is_read})02({else})09({/if})">
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$c_message_ru.c_member_id_from})">({$c_message_ru.nickname|t_body:'name'})</a>
</td>
<td class="bg_({if $c_message_ru.is_read})02({else})09({/if})"><a href="({t_url m=pc a=page_h_message})&amp;target_c_message_id=({$c_message_ru.c_message_id})&amp;jyusin_c_message_id=({$c_message_ru.c_message_id})">({$c_message_ru.subject|t_body:'title'})</a></td>
<td class="bg_({if $c_message_ru.is_read})02({else})09({/if})">({$c_message_ru.r_datetime|date_format:"%m月%d日"})</td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({/foreach})
</table>
<!-- ここまで：主内容＞＞受信箱＞＞メール内容リスト -->

<!-- ここから：主内容＞＞受信箱＞＞ページ切り替えタブ -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="width:auto;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:100%;" class="bg_05" align="right">

<div class="padding_s">

                トータル数[({$total_num|default:0})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br>

</div>

</td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞受信箱＞＞ページ切り替えタブ -->

<!-- ここから：主内容＞＞受信箱＞＞削除タブ -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="width:auto;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:100%;" class="bg_05" align="left">

<div class="padding_s">
<input type="hidden" name="box" value="({$box})">
<input type="submit" class="submit" value="削 除">

</div>

</td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞受信箱＞＞削除タブ -->

({else})

<!-- ここから：主内容＞＞受信箱＞＞メールナッシング -->
<div align="center" style="padding:20px 30px;" class="bg_02 border_01">

メッセージがありません。

</div>
<!-- ここまで：主内容＞＞受信箱＞＞メールナッシング -->

({/if})

({/if})

({if $box == "outbox"})
 <!-- ここから：主内容＞＞送信箱＞＞検索BOX -->
({capture name="outbox_search_box"})
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="width:auto;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:50%;" class="bg_05" align="right">

<div class="padding_s">
({t_form _method=get m=pc a=page_h_message_box})
<input type="hidden" name="box" value="({$box})">
送信箱内キーワード<img src="({t_img_url_skin filename=icon_arrow_2})" class="icon">
<input type="text" size="15" name="keyword" class="text border_01" value="({$keyword})">
<input type="hidden" name="target_c_member_id" value="">
<input type=submit  class="submit"  value="  検　索  ">
</form>
</div>

</td>
</tr>
({*********})
</table>
({/capture})

<!-- ここまで：主内容＞＞送信箱＞＞検索BOX -->

({if $count_c_message_s_list})

<!-- ここから：主内容＞＞送信済み箱＞＞ページ切り替えタブ -->

<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="width:auto;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:100%;" class="bg_05" align="right">

<div class="padding_s">

                トータル数[({$total_num|default:0})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br>
</div>

</td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞送信済み箱＞＞ページ切り替えタブ -->
<!-- ここから：主内容＞＞送信箱＞＞検索BOX -->

({$smarty.capture.outbox_search_box|smarty:nodefaults})
({t_form m=pc a=do_h_message_box_delete_message})
<input type="hidden" name="sessid" value="({$PHPSESSID})">

<!-- ここまで：主内容＞＞送信箱＞＞検索BOX -->
<!-- ここから：主内容＞＞送信済み箱＞＞メール内容リスト -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:35px;height:19px;" class="bg_08">&nbsp;</td>
<td style="width:35px;" class="bg_08">削除</td>
<td style="width:130px;" class="bg_08"><span class="b_b">宛 先</span></td>
<td style="width:220px;" class="bg_08"><span class="b_b">件 名</span></td>
<td style="width:78px;" class="bg_08"><span class="b_b">日 付</span></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="4"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({foreach from=$c_message_s_list item=c_message_s})
<tr>
<td class="bg_02" align="center">({if $c_message_s.is_read})<img src="({t_img_url_skin filename=icon_mail_2})" class="icon">({else})<img src="({t_img_url_skin filename=icon_mail_1})" class="icon">({/if})</td>
<td class="bg_02"><input name="c_message_id[]" value="({$c_message_s.c_message_id})" type="checkbox" class="no_bg"></td>
<td class="bg_02"><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$c_message_s.c_member_id_to})">({$c_message_s.nickname|t_body:'name'})</a></td>
<td class="bg_02"><a href="({t_url m=pc a=page_h_message})&amp;target_c_message_id=({$c_message_s.c_message_id})&amp;box=outbox">({$c_message_s.subject|t_body:'title'})</a></td>
<td class="bg_02">({$c_message_s.r_datetime|date_format:"%m月%d日"})</td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="4"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({/foreach})
</table>
<!-- ここまで：主内容＞＞送信済み箱＞＞メール内容リスト -->

<!-- ここから：主内容＞＞送信済み箱＞＞ページ切り替えタブ -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="width:auto;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:100%;" class="bg_05" align="right">

<div class="padding_s">

                トータル数[({$total_num|default:0})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br>
</div>

</td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞送信済み箱＞＞ページ切り替えタブ -->

<!-- ここから：主内容＞＞送信済み箱＞＞削除タブ -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="width:auto;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:100%;" class="bg_05" align="left">

<div class="padding_s">
<input type="hidden" name="box" value="({$box})">
<input type="submit" class="submit" value="削 除">

</div>

</td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞送信済み箱＞＞削除タブ -->

({else})

<!-- ここから：主内容＞＞送信済み箱＞＞メールナッシング -->
<div align="center" style="padding:20px 30px;" class="bg_02 border_01">

メッセージがありません。

</div>
<!-- ここまで：主内容＞＞送信済み箱＞＞メールナッシング -->

({/if})

({/if})

({if $box == "savebox"})
({t_form m=pc a=do_h_message_box_delete_message})
<input type="hidden" name="sessid" value="({$PHPSESSID})">

({if $count_c_message_save_list})

<!-- ここから：主内容＞＞下書き保存箱＞＞ページ切り替えタブ -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="width:auto;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:100%;" class="bg_05" align="right">

<div class="padding_s">

                トータル数[({$total_num|default:0})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br>

</div>

</td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞下書き保存箱＞＞ページ切り替えタブ -->

<!-- ここから：主内容＞＞下書き保存箱＞＞メール内容リスト -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:35px;height:19px;" class="bg_08">&nbsp;</td>
<td style="width:35px;" class="bg_08">削除</td>
<td style="width:130px;" class="bg_08"><span class="b_b">宛 先</span></td>
<td style="width:220px;" class="bg_08"><span class="b_b">件 名</span></td>
<td style="width:78px;" class="bg_08"><span class="b_b">日 付</span></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="4"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({foreach from=$c_message_save_list item=c_message_save})
<tr>
<td class="bg_02" align="center"><img src="({t_img_url_skin filename=icon_mail_1})" class="icon"></td>
<td class="bg_02"><input name="c_message_id[]" value="({$c_message_save.c_message_id})" type="checkbox" class="no_bg"></td>
<td class="bg_02">({$c_message_save.nickname|t_body:'name'})</td>
<td class="bg_02"><a href="({t_url m=pc a=page_f_message_send})&amp;target_c_message_id=({$c_message_save.c_message_id})&amp;jyusin_c_message_id=({$c_message_save.hensinmoto_c_message_id})&amp;box=savebox">({$c_message_save.subject|t_body:'title'})</a></td>
<td class="bg_02">({$c_message_save.r_datetime|date_format:"%m月%d日"})</td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="4"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({/foreach})
</table>
<!-- ここまで：主内容＞＞下書き保存箱＞＞メール内容リスト -->

<!-- ここから：主内容＞＞下書き保存箱＞＞ページ切り替えタブ -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="width:auto;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:100%;" class="bg_05" align="right">

<div class="padding_s">

                トータル数[({$total_num|default:0})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br>

</div>

</td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞下書き保存箱＞＞ページ切り替えタブ -->

<!-- ここから：主内容＞＞下書き保存箱＞＞削除タブ -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="width:auto;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:100%;" class="bg_05" align="left">

<div class="padding_s">
<input type="hidden" name="box" value="savebox">
<input type="submit" class="submit" value="削 除">

</div>

</td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞下書き保存箱＞＞削除タブ -->

({else})

<!-- ここから：主内容＞＞下書き保存箱＞＞メールナッシング -->
<div align="center" style="padding:20px 30px;" class="bg_02 border_01">

メッセージがありません。

</div>
<!-- ここまで：主内容＞＞下書き保存箱＞＞メールナッシング -->

({/if})

({/if})

({if $box == "trash"})
({t_form m=pc a=do_h_message_box_delete_message})
<input type="hidden" name="sessid" value="({$PHPSESSID})">

({if $count_c_message_trash_list})

<!-- ここから：主内容＞＞ごみ箱＞＞ページ切り替えタブ -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="width:auto;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:350px;" class="bg_05" align="left">

<div class="padding_s">

&nbsp;<img src="({t_img_url_skin filename=icon_mail_2})" class="icon">&nbsp;…&nbsp;受信&nbsp;
&nbsp;<img src="({t_img_url_skin filename=icon_mail_3})" class="icon">&nbsp;…&nbsp;送信済み&nbsp;
&nbsp;<img src="({t_img_url_skin filename=icon_mail_1})" class="icon">&nbsp;…&nbsp;下書き

</div>

</td>
<td class="bg_05" align="right">

<div class="padding_s">

トータル数[({$total_num|default:0})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br>
</div>

</td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞ごみ箱＞＞ページ切り替えタブ -->

<!-- ここから：主内容＞＞ごみ箱＞＞メール内容リスト -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:35px;height:19px;" class="bg_08">&nbsp;</td>
<td style="width:35px;height:19px;" class="bg_08">&nbsp;</td>
<td style="width:130px;" class="bg_08"><span class="b_b">相 手</span></td>
<td style="width:220px;" class="bg_08"><span class="b_b">件 名</span></td>
<td style="width:auto;" class="bg_08"><span class="b_b">日 付</span></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="4"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({foreach from=$c_message_trash_list item=c_message_trash})
<tr>
({strip})
<td class="bg_02" align="center">
({if $c_message_trash.c_member_id_to == $u})({* 受信メッセージ *})
    <img src="({t_img_url_skin filename=icon_mail_2})" class="icon">
({else})
    ({if $c_message_trash.is_send})({* 送信メッセージ *})
        <img src="({t_img_url_skin filename=icon_mail_3})" class="icon">
    ({else})({* 下書きメッセージ *})
        <img src="({t_img_url_skin filename=icon_mail_1})" class="icon">
    ({/if})
({/if})
</td>
({/strip})
<td class="bg_02"><input name="c_message_id[]" value="({$c_message_trash.c_message_id})" type="checkbox" class="no_bg"></td>
<td class="bg_02">({$c_message_trash.nickname|t_body:'name'})</td>
<td class="bg_02"><a href="({t_url m=pc a=page_h_message})&amp;target_c_message_id=({$c_message_trash.c_message_id})&amp;box=trash">({$c_message_trash.subject|t_body:'title'})</a></td>
<td class="bg_02">({$c_message_trash.r_datetime|date_format:"%m月%d日"})</td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="4"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({/foreach})
</table>
<!-- ここまで：主内容＞＞ごみ箱＞＞メール内容リスト -->

<!-- ここから：主内容＞＞ごみ箱＞＞ページ切り替えタブ -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="width:auto;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:100%;" class="bg_05" align="right">

<div class="padding_s">

トータル数[({$total_num|default:0})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br>
</div>

</td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞ごみ箱＞＞ページ切り替えタブ -->

<!-- ここから：主内容＞＞ごみ箱＞＞削除タブ -->
<table style="width:504px;" border="0" cellspacing="0" cellpadding="0" style="width:auto;margin:0px auto;" class="border_01">
({*********})
<tr>
<td style="width:100%;" class="bg_05" align="left">

<div class="padding_s">
<input type="hidden" name="box" value="trash">

<input type="submit" class="submit" name="move" value="元に戻す">
<input type="submit" class="submit" name="remove" value="削除">

</div>

</td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞ごみ箱＞＞削除タブ -->

({else})

<!-- ここから：主内容＞＞ごみ箱＞＞メールナッシング -->
<div align="center" style="padding:20px 30px;" class="bg_02 border_01">

メッセージがありません。

</div>
<!-- ここまで：主内容＞＞ごみ箱＞＞メールナッシング -->

({/if})

({/if})

</form>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：Box一覧＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：Box一覧****** -->
<!-- **************************** -->

<img src="./skin/dummy.gif" class="v_spacer_l">

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

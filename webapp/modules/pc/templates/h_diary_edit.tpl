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
<td class="container main_content" align="center">

({ext_include file="inc_alert_box.tpl"})({* エラーメッセージコンテナ *})

<table class="container" border="0" cellspacing="0" cellpadding="0">({*BEGIN:container*})
<tr>
<td style="width:7px;"><img src="./skin/dummy.gif" style="width:7px;" class="dummy"></td>({*<--spacer*})
<td class="left_content_165" align="center" valign="top">
({********************************})
({**ここから：メインコンテンツ（左）**})
({********************************})

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ******************************* -->
<!-- ******ここから：カレンダー****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:165px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:149px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10" align="center">
<!-- *ここから：カレンダー＞内容* -->
({*ここから：header*})
<!-- ここから：カレンダータイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:149px;margin:0px auto;">
<tr>
<td align="center" class="bg_03 padding_s">

({strip})
({if $ym.prev_month})
<span class="b_b">
<a href="({t_url m=pc a=page_fh_diary_list})
    &amp;target_c_member_id=({$target_member.c_member_id})
    &amp;year=({$ym.prev_year})
    &amp;month=({$ym.prev_month})">
＜
</a>
</span>
({/if})

<span class="b_b">({$date_val.month})月のカレンダー</span>

({if $ym.next_month})
<span class="b_b">
<a href="({t_url m=pc a=page_fh_diary_list})
    &amp;target_c_member_id=({$target_member.c_member_id})
    &amp;year=({$ym.next_year})
    &amp;month=({$ym.next_month})">
＞
</a>
</span>
({/if})
({/strip})

</td>
</tr>
</table>
<!-- ここまで：カレンダータイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:149px;margin:0px auto;">
({****************})
<tr>
<td style="width:149px;" class="bg_10" colspan="13"><img src="./skin/dummy.gif" style="width:149px;height:1px;" class="dummy"></td>
</tr>
({****************})
<tr>
<td class="bg_09 s_ss padding_ss" align="right"><span class="c_02 s_ss">日</span></td>
<td style="width:1px;" class="bg_10"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_09 s_ss padding_ss" align="right">月</td>
<td style="width:1px;" class="bg_10"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_09 s_ss padding_ss" align="right">火</td>
<td style="width:1px;" class="bg_10"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_09 s_ss padding_ss" align="right">水</td>
<td style="width:1px;" class="bg_10"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_09 s_ss padding_ss" align="right">木</td>
<td style="width:1px;" class="bg_10"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_09 s_ss padding_ss" align="right">金</td>
<td style="width:1px;" class="bg_10"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_09 s_ss padding_ss" align="right"><span class="c_03 s_ss">土</span></td>
</tr>
({****************})
<tr>
<td style="width:149px;" class="bg_10" colspan="13"><img src="./skin/dummy.gif" style="width:149px;height:1px;" class="dummy"></td>
</tr>
({****************})
({foreach from=$calendar item=week})
<tr>
({foreach from=$week item=item name="calendar_days"})
<td style="width:({if $smarty.foreach.calendar_days.iteration%7 == 0 || $smarty.foreach.calendar_days.iteration%7 == 1})21({else})20({/if})px;height:18px;" valign="middle" align="right" class="bg_02 s_ss">
({if $item.day})
({if $item.is_diary})
<a href="({t_url m=pc a=page_fh_diary_list})&amp;target_c_member_id=({$target_member.c_member_id})&amp;year=({$date_val.year})&amp;month=({$date_val.month})&amp;day=({$item.day})" class="s_ss">({$item.day})</a>
({else})
({$item.day})
({/if})
({else})
&nbsp;({/if})
</td>
({if $smarty.foreach.calendar_days.iteration%7 != 0})
<td style="width:1px;" class="bg_10"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
({/if})
({/foreach})
</tr>
({****************})
<tr>
<td style="width:149px;" class="bg_10" colspan="13"><img src="./skin/dummy.gif" style="width:149px;height:1px;" class="dummy"></td>
</tr>
({****************})
({/foreach})
</table>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：カレンダー＞＞内容* -->
</td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：カレンダー****** -->
<!-- ****************************** -->

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ********************************** -->
<!-- ******ここから：最近のコメント****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:165px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:149px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10" align="left">
<!-- *ここから：最近のコメント＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:149px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:111px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">最近のコメント</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<div align="left" style="padding:3px;" class="bg_02 border_01">

<a href="({t_url m=pc a=page_fh_comment_list})&amp;target_c_member_id=({$target_member.c_member_id})"><img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1">一覧を見る</a>

</div>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：最近のコメント＞＞内容* -->
</td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：最近のコメント****** -->
<!-- ********************************** -->

<img src="./skin/dummy.gif" class="v_spacer_l">

({if $date_list})
<!-- ********************************** -->
<!-- ******ここから：各月の日記一覧****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:165px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:149px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10" align="left">
<!-- *ここから：各月の日記一覧＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:149px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:111px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">各月の日記</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<div align="left" style="padding:3px;" class="bg_02 border_01">
({foreach from=$date_list item=item})

<div><a href="({t_url m=pc a=page_fh_diary_list})&amp;target_c_member_id=({$target_member.c_member_id})&amp;year=({$item.year})&amp;month=({$item.month})"><img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_2">({$item.year})年({$item.month})月の一覧</a></div>

({/foreach})
</div>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：各月の日記一覧＞＞内容* -->
</td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：各月の日記一覧****** -->
<!-- ********************************** -->

<img src="./skin/dummy.gif" class="v_spacer_l">
({/if})

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

<!-- ********************************** -->
<!-- ******ここから：日記を編集する****** -->
({t_form _enctype=file m=pc a=page_h_diary_edit_confirm _name=editForm})
<input type="hidden" name="target_c_diary_id" value="({$diary.c_diary_id})">
<input type="hidden" name="del_img" value="({$del_img})">

<table border="0" cellspacing="0" cellpadding="0" style="width:540px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:524px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="left">
<!-- *ここから：日記を編集する＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:524px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:486px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">日記を編集する</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<!-- ここから：主内容＞＞日記表示 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:524px;" class="border_01">
({*********})
<tr>
<td style="width:522px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:80px;" class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">

タイトル

</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:439px;" class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">

<input size="40" name="subject" value="({$diary.subject})">

</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">

本　　文

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">

({* FeslyBBCode *})
({ext_include file="inc_bbcode_fesly_editor.tpl"})
<textarea name="body" rows="15" cols="50" style="width:415px">({$diary.body})</textarea>
({* BBCode *})
({ext_include file="inc_bbcode.tpl"})

({*********絵文字*********})
({ext_include file="new_templates/emojipat_docomo.tpl"})
({*********絵文字*********})
({*****グーグルマップ用スクリプト*****})
</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">

写　真 1

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">

({if $diary.image_filename_1 && !($del_img & 0x01)})
<input type="hidden" name="pre_image_filename_1" value="({$diary.image_filename_1})">
<a href="({t_img_url filename=$diary.image_filename_1})" target="_blank"><img src="({t_img_url filename=$diary.image_filename_1 w=120 h=120})"></a><br>
({*削除ボタン1*})
<a href="({t_url m=pc a=do_h_diary_edit_delete_image})&amp;target_c_diary_id=({$diary.c_diary_id})&amp;del_img=1&amp;sessid=({$PHPSESSID})">削除</a><br>
({/if})
<input type="file" size="40"  name="upfile_1">

</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">

写　真 2

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">

({if $diary.image_filename_2 && !($del_img & 0x02)})
<input type="hidden" name="pre_image_filename_2" value="({$diary.image_filename_2})">
<a href="({t_img_url filename=$diary.image_filename_2})" target="_blank"><img src="({t_img_url filename=$diary.image_filename_2 w=120 h=120})"></a><br>
({*削除ボタン2*})
<a href="({t_url m=pc a=do_h_diary_edit_delete_image})&amp;target_c_diary_id=({$diary.c_diary_id})&amp;del_img=2&amp;sessid=({$PHPSESSID})">削除</a><br>
({/if})
<input type="file" size="40"  name="upfile_2">

</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">

写　真 3

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">

({if $diary.image_filename_3 && !($del_img & 0x04)})
<input type="hidden" name="pre_image_filename_3" value="({$diary.image_filename_3})">
<a href="({t_img_url filename=$diary.image_filename_3})" target="_blank"><img src="({t_img_url filename=$diary.image_filename_3 w=120 h=120})"></a><br>
({*削除ボタン3*})
<a href="({t_url m=pc a=do_h_diary_edit_delete_image})&amp;target_c_diary_id=({$diary.c_diary_id})&amp;del_img=3&amp;sessid=({$PHPSESSID})">削除</a><br>
({/if})
<input type="file" size="40"  name="upfile_3">

</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">

タ　グ

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">

<input type="text" name="tagsname" id="tagsname" size="40" value="({foreach from=$tagsname item=item})({$item.c_tags_name}) ({/foreach})"><select onChange="if(selectedIndex){tagsname.value += options[selectedIndex].value + ' '}">
<option>タグを選択してください</option>
({foreach from=$tags_list item=item})
<option value="({$item.c_tags_name})">({$item.c_tags_name})</option>
({/foreach})
</select>
<br>
※ひとつのタグは半角36文字以内で入力してください。<br>
※タグは5つまで登録できます。<br>
※複数タグを利用する場合はスペース一つで区切ってください。複数スペースを入れた場合は正常に認識しませんのでご注意ください。

({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})


<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">
<div style="padding:4px 3px;">

公開範囲

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">
({if $opendiary_flag})
<input type="radio" name="public_flag" value="open"({if $diary.public_flag == "open"}) checked="checked"({/if}) class="no_bg" id="public_flag_public"><label for="public_flag_public">外部公開</label><br>
({/if})
<input type="radio" name="public_flag" value="public"({if $diary.public_flag == "public"}) checked="checked"({/if}) class="no_bg" id="public_flag_public"><label for="public_flag_public">全員に公開</label><br>
<input type="radio" name="public_flag" value="friend"({if $diary.public_flag == "friend"}) checked="checked"({/if}) class="no_bg" id="public_flag_friend"><label for="public_flag_friend">({$WORD_MY_FRIEND})まで公開</label><br>
<input type="radio" name="public_flag" value="private"({if $diary.public_flag == "private"}) checked="checked"({/if}) class="no_bg" id="public_flag_private"><label for="public_flag_private">公開しない</label><br>

</div>
</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>

({*********})
<tr>
<td class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})

<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="center" colspan="3">
<div style="padding:4px 3px;">

<input type="submit" class="submit" value="編 集">&nbsp;&nbsp;

</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞日記表示 -->
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：日記を編集する＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
</form>
<!-- ******ここまで：日記を編集する****** -->
<!-- ********************************** -->

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ********************************** -->
<!-- ******ここから：日記を削除する****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:540px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:524px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="left">
<!-- *ここから：日記を削除する＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:524px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:486px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">日記を削除する</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<!-- ここから：主内容＞＞日記表示 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:524px;" class="border_01">
({*********})
<tr>
<td style="width:522px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:95px;" class="bg_05" align="center" valign="middle" rowspan="3">
<div style="padding:4px 3px;">

日付

</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:424px;" class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">

({$diary.r_datetime|date_format:"%Y年%m月%d日"})

</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">
<div style="padding:4px 3px;">

この日記を削除します。

</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="center" colspan="3">
<div style="padding:4px 3px;">

({t_form m=pc a=page_h_delete_diary})
<input type="hidden" name="target_c_diary_id" value="({$diary.c_diary_id})">
<input type="submit" class="submit" value="削 除">
</form>

</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：主内容＞＞日記表示 -->
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：日記を削除する＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：日記を削除する****** -->
<!-- ********************************** -->

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

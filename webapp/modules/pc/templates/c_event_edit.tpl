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
<td class="full_content" align="center">
({***************************})
({**ここから：メインコンテンツ**})
({***************************})

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- **************************************** -->
<!-- ******ここから：イベントを編集する****** -->
({t_form _enctype=file m=pc a=do_c_event_edit_update_c_commu_topic _name=editForm})
<input type="hidden" name="sessid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_commu_id" value="({$event.c_commu_id})">
<input type="hidden" name="target_c_commu_topic_id" value="({$event.c_commu_topic_id})">
<input type="hidden" name="submit" value="main">

<table border="0" cellspacing="0" cellpadding="0" style="width:650px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:646px;" class="bg_00"><img src="./skin/dummy.gif" style="width:566px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="left">
<!-- *ここから：イベントを編集する＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<div class="border_01">
<table border="0" cellspacing="0" cellpadding="0" style="width:644px;">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:468px;padding:2px 0px;" class="bg_06"><span class="b_b">イベントを編集する</span></td>
<td style="width:140px;" align="right" class="bg_06">&nbsp;</td>
</tr>
</table>
</div>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:644px;">
({*********})
<tr>
<td style="width:644px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:150px;" class="bg_05" align="center" valign="middle">

<div class="padding_s">

タイトル <span class="caution">※</span>

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:491px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

<input type="text" name="title" value="({$event.name})" maxlength="240">

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:644px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:150px;" class="bg_05" align="center" valign="middle">

<div class="padding_s">

開催日時 <span class="caution">※</span>

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:491px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

<select name="open_date_year">
<option value=0>----</option>
({html_options values=$year selected=$event.open_date_year output=$year})
</select>
年
<select name="open_date_month">
<option value=0>----</option>
({html_options values=$month selected=$event.open_date_month output=$month})
</select>
月
<select name="open_date_day">
<option value=0>----</option>
({html_options values=$day selected=$event.open_date_day output=$day})
</select>
日
(補足：<input type="text" name="open_date_comment" value="({$event.open_date_comment})" size="30">)

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:636px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:150px;" class="bg_05" align="left" valign="middle">

<div class="padding_s">

外部への公開

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:483px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

<input type="radio" class="no_bg" name="open_flag" value="1"({if $event.open_flag == 1}) checked="checked"({/if})>公開する<br>
<input type="radio" class="no_bg" name="open_flag" value="0"({if $event.open_flag != 1}) checked="checked"({/if})>公開しない<br>
※イベントを外部へ公開します。（イベントの参加、コメント入力はできません）

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:644px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:150px;" class="bg_05" align="center" valign="middle">

<div class="padding_s">

開催場所

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:491px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

<select name="open_pref_id">
<option value=0>選択してください</option>
({html_options options=$pref selected=$event.open_pref_id})
</select>
(補足：<input type="text" name="open_pref_comment" value="({$event.open_pref_comment})" size="30">)

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:644px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:150px;" class="bg_05" align="center" valign="middle">

<div class="padding_s">

詳　　細 <span class="caution">※</span>

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:491px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

({* FeslyBBCode *})
({ext_include file="inc_bbcode_fesly_editor.tpl"})
<textarea name="body" rows="10" cols="50" style="width: 415px">({$event.body})</textarea>
({* BBCode *})
({ext_include file="inc_bbcode.tpl"})

({*********絵文字*********})
({ext_include file="new_templates/emojipat_docomo.tpl"})
({*********絵文字*********})

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:644px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:150px;" class="bg_05" align="center" valign="middle">

<div class="padding_s">

募集期限

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:491px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

<select name="invite_period_year">
<option value="">----</option>
({html_options values=$year selected=$event.invite_period_year output=$year})
</select>
年
<select name="invite_period_month">
<option value="">--</option>
({html_options values=$month selected=$event.invite_period_month output=$month})
</select>
月
<select name="invite_period_day">
<option value="">--</option>
({html_options values=$day selected=$event.invite_period_day output=$day})
</select>
日

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:644px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:150px;" class="bg_05" align="center" valign="middle">

<div class="padding_s">

写　真 1

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:491px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

({if $event.image_filename1})<img src="({t_img_url filename=$event.image_filename1 w=120 h=120})">
<a href="({t_url m=pc a=do_c_event_edit_delete_c_commu_topic_comment_image})&amp;target_c_commu_topic_id=({$event.c_commu_topic_id})&amp;pic_delete=1&amp;sessid=({$PHPSESSID})">削除</a>
<br>
({/if})
<input type="file" name="image_filename1" size="40">

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:644px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:150px;" class="bg_05" align="center" valign="middle">

<div class="padding_s">

写　真 2

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:491px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

({if $event.image_filename2})<img src="({t_img_url filename=$event.image_filename2 w=120 h=120})">
<a href="({t_url m=pc a=do_c_event_edit_delete_c_commu_topic_comment_image})&amp;target_c_commu_topic_id=({$event.c_commu_topic_id})&amp;pic_delete=2&amp;sessid=({$PHPSESSID})">削除</a>
<br>
({/if})
<input type="file" name="image_filename2" size="40">

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:644px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:150px;" class="bg_05" align="center" valign="middle">

<div class="padding_s">

写　真 3

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:491px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

({if $event.image_filename3})<img src="({t_img_url filename=$event.image_filename3 w=120 h=120})">
<a href="({t_url m=pc a=do_c_event_edit_delete_c_commu_topic_comment_image})&amp;target_c_commu_topic_id=({$event.c_commu_topic_id})&amp;pic_delete=3&amp;sessid=({$PHPSESSID})">削除</a>
<br>
({/if})
<input type="file" name="image_filename3" size="40">

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:644px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({*<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:150px;" class="bg_05" align="center" valign="middle">

<div class="padding_s">

表示範囲

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:491px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

<input type="radio" name="event_cal_level" value="1">全メンバーのカレンダーに表示させる。<br>
<input type="radio" name="event_cal_level" value="2">コミュニティ参加者のカレンダーにのみ表示させる

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
<tr>
<td style="width:644px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>*})
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:642px;" class="bg_03" align="left" valign="middle" colspan="3">

<div style="text-align:center;" align="center" class="padding_w_s">

<table border="0" cellspacing="0" cellpadding="0" style="width:100%;height:2em;">
<tr>
<td style="width:50%;text-align:right;">

<input type="submit" class="submit" value="　編集を確定　">&nbsp;
</form>

</td>
<td style="width:50%;text-align:left;">

({t_form _method=get m=pc a=page_c_event_detail})
<input type="hidden" name="target_c_commu_topic_id" value="({$event.c_commu_topic_id})">
&nbsp;<input type="submit" class="submit" value="　キャンセル　">
</form>

</td>
</tr>
</table>

</div>
</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:644px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：イベントを編集する＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:566px;" class="bg_00"><img src="./skin/dummy.gif" style="width:566px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：イベントを編集する****** -->
<!-- **************************************** -->

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ****************************************** -->
<!-- ******ここから：イベントと書き込みを削除****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:650px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:646px;" class="bg_00"><img src="./skin/dummy.gif" style="width:566px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="left">
<!-- *ここから：イベントと書き込みを削除＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<div class="border_01">
<table border="0" cellspacing="0" cellpadding="0" style="width:644px;">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:440px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">このイベントを削除する</span></td>
<td style="width:168px;" align="right" class="bg_06">&nbsp;</td>
</tr>
</table>
</div>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:644px;">
({*********})
<tr>
<td style="width:644px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:642px;" class="bg_03" align="left" valign="middle">

<div class="padding_w_m">

<span class="caution">削除の際はトラブル等を避けるため、あらかじめ参加者へ削除を告知してください。</span>

<div align="center" style="text-align:center;">
({t_form m=pc a=page_c_event_delete_confirm})
<input type="hidden" name="target_c_commu_topic_id" value="({$event.c_commu_topic_id})">
<input type="submit" class="submit" value="　　削　除　　">
</form>
</div>

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:644px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：イベントと書き込みを削除＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:566px;" class="bg_00"><img src="./skin/dummy.gif" style="width:566px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：イベントと書き込みを削除****** -->
<!-- ****************************************** -->

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

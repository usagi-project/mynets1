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
<td class="full_content">
({***************************})
({**ここから：メインコンテンツ**})
({***************************})

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ******************************************** -->
<!-- ******ここから：スケジュール追加内容確認****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:580px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:566px;" class="bg_00"><img src="./skin/dummy.gif" style="width:566px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td>
<!-- *ここから：スケジュール追加内容確認内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" align="center" cellpadding="0" style="width:566px;" class="border_01">
<tr>
<td class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width: 30px;height: 20px;" class="dummy" align="left"><div class="b_b c_00" style="padding:3px 0px;">以下の内容でよろしいですか？</div>
</td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- *ここから：スケジュール詳細* -->
<table border="0" cellspacing="0" cellpadding="0" style="width:566px;" class="border_01">
({*********})
<!-- *ここから：スケジュール詳細＞タイトル* -->
<tr>
<td align="center" class="border_01 bg_05" style="width:110px;border-width:0px 1px 1px 0px;">

<div class="padding_s">

タイトル

</div>

</td>
<td class="border_01 bg_02" style="width:454px;border-width:0px 0px 1px 0px;">

<div class="padding_s">

({$input.title})

</div>

</td>
</tr>
<!-- *ここまで：スケジュール詳細＞タイトル* -->
({*********})
<!-- *ここから：スケジュール詳細＞開始日時* -->
<tr>
<td align="center" class="border_01 bg_05" style="border-width:0px 1px 1px 0px">

<div class="padding_s">

開　　始

</div>

</td>
<td class="border_01 bg_02" style="border-width:0px 0px 1px 0px;">

<div class="padding_s">

({$input.start_year|string_format:"%04d"}) 年
({$input.start_month|string_format:"%02d"}) 月
({$input.start_day|string_format:"%02d"}) 日
({if is_null($input.start_hour)})
--
({else})
({$input.start_hour|string_format:"%02d"})
({/if}) 時
({if is_null($input.start_minute)})
--
({else})
({$input.start_minute|string_format:"%02d"})
({/if}) 分

</div>

</td>
</tr>
<!-- *ここまで：スケジュール詳細＞開始日時* -->
({*********})
<!-- *ここから：スケジュール詳細＞終了日時* -->
<tr>
<td align="center" class="border_01 bg_05" style="border-width:0px 1px 1px 0px;">

<div class="padding_s">

終　　了

</div>

</td>
<td class="border_01 bg_02" style="border-width:0px 0px 1px 0px;">

<div class="padding_s">

({$input.end_year|string_format:"%04d"}) 年
({$input.end_month|string_format:"%02d"}) 月
({$input.end_day|string_format:"%02d"}) 日
({if is_null($input.end_hour)})
--
({else})
({$input.end_hour|string_format:"%02d"})
({/if}) 時
({if is_null($input.end_minute)})
--
({else})
({$input.end_minute|string_format:"%02d"})
({/if}) 分

</div>

</td>
</tr>
<!-- *ここまで：スケジュール詳細＞終了日時* -->
({*********})
<!-- *ここから：スケジュール詳細＞詳細テキスト* -->
<tr>
<td align="center" class="border_01 bg_05" style="border-width:0px 1px 1px 0px;">

<div class="padding_s">

詳　　細

</div>

</td>
<td class="border_01 bg_02" style="border-width:0px 0px 1px 0px;">

<div class="padding_s">

({$input.body|t_body:'schedule'})&nbsp;

</div>

</td>
</tr>
<!-- *ここまで：スケジュール詳細＞詳細テキスト* -->
({*********})
({if !$is_unused_schedule})
<!-- *ここから：スケジュール詳細＞お知らせメール有無* -->
<tr>
<td align="center" class="border_01 bg_05" style="border-width:0px 1px 1px 0px;">

<div class="padding_s">

お知らせメール

</div>

</td>
<td class="border_01 bg_02" style="border-width:0px 0px 1px 0px;">

<div class="padding_s">

({if $input.is_receive_mail})
受け取る
({else})
受け取らない
({/if})

</div>

</td>
</tr>
<!-- *ここまで：スケジュール詳細＞お知らせメール有無* -->
({/if})
({*********})
<!-- *ここまで：スケジュール詳細* -->
<!-- *ここから：追加修正ボタン* -->
<tr>
<td class="bg_03 border_01" colspan="2" style="border-width:0px 0px 1px 0px;">

<div class="padding_w_s" align="center">

<table border="0" cellspacing="0" cellpadding="6" style="width:240px;">
<tr>
<td>

({t_form m=pc a=do_h_schedule_add_insert_c_schedule})
<input type="hidden" name="sessid" value="({$PHPSESSID})">
<input type="hidden" name="title" value="({$input.title})">
<input type="hidden" name="body" value="({$input.body})">
<input type="hidden" name="start_year" value="({$input.start_year})">
<input type="hidden" name="start_month" value="({$input.start_month})">
<input type="hidden" name="start_day" value="({$input.start_day})">
<input type="hidden" name="start_hour" value="({$input.start_hour})">
<input type="hidden" name="start_minute" value="({$input.start_minute})">
<input type="hidden" name="end_year" value="({$input.end_year})">
<input type="hidden" name="end_month" value="({$input.end_month})">
<input type="hidden" name="end_day" value="({$input.end_day})">
<input type="hidden" name="end_hour" value="({$input.end_hour})">
<input type="hidden" name="end_minute" value="({$input.end_minute})">
<input type="hidden" name="is_receive_mail" value="({$input.is_receive_mail})">
<input type="submit" class="submit" value="　 追　　加 　">
</form>

</td>
<td>

({t_form m=pc a=page_h_schedule_add})
<input type="hidden" name="title" value="({$input.title})">
<input type="hidden" name="body" value="({$input.body})">
<input type="hidden" name="start_year" value="({$input.start_year})">
<input type="hidden" name="start_month" value="({$input.start_month})">
<input type="hidden" name="start_day" value="({$input.start_day})">
<input type="hidden" name="start_hour" value="({$input.start_hour})">
<input type="hidden" name="start_minute" value="({$input.start_minute})">
<input type="hidden" name="end_year" value="({$input.end_year})">
<input type="hidden" name="end_month" value="({$input.end_month})">
<input type="hidden" name="end_day" value="({$input.end_day})">
<input type="hidden" name="end_hour" value="({$input.end_hour})">
<input type="hidden" name="end_minute" value="({$input.end_minute})">
<input type="hidden" name="is_receive_mail" value="({$input.is_receive_mail})">
<input type="submit" class="submit" value="　 修　　正 　"><br>
</form>

</td>
</tr>
</table>
</div>
</td>
</tr>
<!-- *ここまで：ボタン* -->
({*********})
</table>
({*ここまで：body*})
({*ここから：footer*})
<!-- *無し* -->
({*ここまで：footer*})
<!-- *ここから：スケジュール追加内容確認内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：スケジュール追加内容確認****** -->
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

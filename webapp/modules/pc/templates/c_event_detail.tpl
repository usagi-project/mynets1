({$inc_html_header|smarty:nodefaults})
<body>
<script type="text/javascript" src="js/javascripts/cmntlink.js"></script>
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

({if !$err_msg})

({if $is_c_event_admin || $is_c_event_member})
<!-- ******************************* -->
<!-- ******ここから：紹介の勧め****** -->
<table border="0" cellspacing="1" cellpadding="2" style="width:600px;margin:0px auto;" class="border_07 bg_07">
<tr>
<td class="bg_02" align="left" style="width:240px;">
&nbsp;・&nbsp;<span class="b_b">このイベントを({$WORD_MY_FRIEND})に教える</span>
</td>
<td class="bg_02" align="left">
<img src="./skin/dummy.gif" class="icon arrow_1">
<a href="({t_url m=pc a=page_c_event_invite})&amp;target_c_commu_topic_id=({$c_topic.c_commu_topic_id})">イベントお知らせメッセージを送る</a>
</td>
</tr>
</table>
<!-- ******ここまで：紹介の勧め****** -->
<!-- ******************************* -->

<img src="./skin/dummy.gif" class="v_spacer_l">
({/if})

<!-- ******************************** -->
<!-- ******ここから：イベント詳細****** -->
({t_form m=pc a=page_c_event_edit})
<input type="hidden" name="target_c_commu_topic_id" value="({$c_topic.c_commu_topic_id})">
<input type="hidden" name="submit" value="main">

<table border="0" cellspacing="0" cellpadding="0" style="width:650px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:566px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="left">
<!-- *ここから：イベント詳細＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:634px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:598px;padding:2px 0px;" class="bg_06"><span class="b_b">[({$c_commu.name|t_body:'name'})] イベント</span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;">
({*********})
<tr>
<td style="width:636px;height:1px;" class="bg_01" colspan="7"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({if $c_topic.image_filename1||$c_topic.image_filename2||$c_topic.image_filename3})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:110px;" class="bg_03" align="center" valign="top" rowspan="({if $is_c_event_admin})21({else})19({/if})">

<div class="padding_s">

({$c_topic.r_datetime|date_format:"%Y年%m月%d日<br>%H:%M"})<br>
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$c_topic.c_member_id})">
<img src="({t_img_url filename=$c_topic.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle" colspan="3">

<div style="padding:8px;">

    ({if $c_topic.image_filename1||$c_topic.image_filename2||$c_topic.image_filename3})
        ({if $c_topic.image_filename1})
            <a href="({t_img_url filename=$c_topic.image_filename1})" class="thickbox" rel="gallery-plants" target="_blank"><img src="({t_img_url filename=$c_topic.image_filename1 w=120 h=120})"></a><span class="functions"><a href="({t_img_url filename=$c_topic.image_filename1})" target="_blank"><img src="({t_img_url_skin filename=icon_window})" alt="別ウィンドウで開く（原寸）" title="別ウィンドウで開く（原寸）"></a></span>
        ({/if})
        ({if $c_topic.image_filename2})
            <a href="({t_img_url filename=$c_topic.image_filename2})" class="thickbox"rel="gallery-plants" target="_blank"><img src="({t_img_url filename=$c_topic.image_filename2 w=120 h=120})"></a><span class="functions"><a href="({t_img_url filename=$c_topic.image_filename2})" target="_blank"><img src="({t_img_url_skin filename=icon_window})" alt="別ウィンドウで開く（原寸）" title="別ウィンドウで開く（原寸）"></a></span>
        ({/if})
        ({if $c_topic.image_filename3})
            <a href="({t_img_url filename=$c_topic.image_filename3})" class="thickbox"rel="gallery-plants" target="_blank"><img src="({t_img_url filename=$c_topic.image_filename3 w=120 h=120})"></a><span class="functions"><a href="({t_img_url filename=$c_topic.image_filename3})" target="_blank"><img src="({t_img_url_skin filename=icon_window})" alt="別ウィンドウで開く（原寸）" title="別ウィンドウで開く（原寸）"></a></span>
        ({/if})
    ({/if})

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;height:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:525px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:122px;" class="bg_05" align="center" valign="middle">

<div class="padding_s">

タイトル

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:400px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

({$c_topic.name|t_body:'name'})
({if $c_topic.open_flag == 1})<br><span style="color:red">&nbsp;(このイベントは外部公開となっています)</span>({/if})
</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({else})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:110px;" class="bg_03" align="center" valign="top" rowspan="({if $is_c_event_admin})17({else})15({/if})">

<div class="padding_s">

({$c_topic.r_datetime|date_format:"%Y年%m月%d日<br>%H:%M"})<br>
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$c_topic.c_member_id})">
<img src="({t_img_url filename=$c_topic.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:122px;" class="bg_05" align="center" valign="middle">

<div class="padding_s">

タイトル

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:400px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

({$c_topic.name|t_body:'name'})
({if $c_topic.open_flag == 1})<br><span style="color:red">&nbsp;(このイベントは外部公開となっています)</span>({/if})
</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({/if})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">

<div class="padding_s">

作成者

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$c_topic.c_member_id})">({$c_topic.nickname|t_body:'name'})</a>

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">

<div class="padding_s">

開催日時

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

({$c_topic.open_date})&nbsp;({$c_topic.open_date_comment})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">

<div class="padding_s">

開催場所

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

({$c_topic.pref})&nbsp;({$c_topic.open_pref_comment})

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">

<div class="padding_s">

関連コミュニティ

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

<a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$c_commu.c_commu_id})">({$c_commu.name|t_body:'name'})</a>

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">

<div class="padding_s">

詳細

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s lh_120">

({$c_topic.body|bbcode2html|t_replace_d|t_body:'event'|t_geocode})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">

<div class="padding_s">

募集期限

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

({if $c_topic.invite_period != "0000-00-00"})({$c_topic.invite_period})({else})指定なし({/if})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">

<div class="padding_s">

参加者

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<table border="0" cellspacing="0" cellpadding="0" style="width:100%;">
<tr>
<td style="width:50%;text-align:left;">

<div class="padding_s">

({$c_topic.member_num})人

</div>

</td>
<td style="width:50%;text-align:right;">

<div class="padding_s">

<img src="./skin/dummy.gif" class="icon arrow_1"><a href="({t_url m=pc a=page_c_event_member_list})&amp;target_c_commu_topic_id=({$c_topic.c_commu_topic_id})">参加者一覧を見る</a>&nbsp;

</div>

</td>
</tr>
</table>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({if $is_c_event_admin})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">

<div class="padding_s">

一括メッセージ

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<table border="0" cellspacing="0" cellpadding="0" style="width:100%;">
<tr>
<td style="width:40%;text-align:left;">

<div class="padding_s">

イベント参加者に一括メッセージを送ります。

</div>

</td>
<td style="width:60%;text-align:right;">

<div class="padding_s">

<img src="./skin/dummy.gif" class="icon arrow_1"><a href="({t_url m=pc a=page_c_event_mail})&amp;target_c_commu_topic_id=({$c_topic.c_commu_topic_id})">一括メッセージを送る</a>&nbsp;

</div>

</td>
</tr>
</table>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="center" valign="middle" colspan="5">

<div class="padding_s">

<input type="submit" class="submit" value="　編　　集　">

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
({/if})
<tr>
<td style="height:1px;" class="bg_01" colspan="7"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：イベント詳細＞＞内容* -->
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
<!-- ******ここまで：イベント詳細****** -->
<!-- ******************************** -->

<img src="./skin/dummy.gif" class="v_spacer_l">

({if $c_topic_write.0})
<!-- ********************************* -->
<!-- ******ここから：書き込み一覧****** -->
<table border="0" cellspacing="0" cellpadding="0" style="width:650px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="left">
<!-- *ここから：書き込み一覧＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;" class="border_01">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:598px;padding:2px 0px;" class="bg_06"><span class="b_b"><a name="comments">書き込み</a></span></td>
</tr>
</table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;">
({*********})
<tr>
<td style="width:636px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td  class="bg_00 border_01" colspan="5" style="width:636px; border-bottom:none;text-align:right;">

<div class="padding_s">
トータル数[({$total_num|default:0})]件&nbsp;&nbsp;({$page_link|smarty:nodefaults})
</div>

</td>

</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr><td class="bg_01" colspan="5">

<table border="0" cellspacing="0" cellpadding="0" style="width:636px;" class="bg_02">
({foreach from=$c_topic_write item=item})
     <tr>
     <td rowspan="2" align="center" valign="top" class="border_01" style="width:110px; border-top:none;border-right:none;" >
     <div class="padding_s"> ({$item.r_datetime|date_format:"%Y年%m月%d日"})<br>
     ({$item.r_datetime|date_format:"%H:%M"})<br>
     <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})"> <img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a> </div></td>

     <td class="border_01" style="width:526px; border-top:none;">
     <div class="padding_s"> <a name="({$item.number})"></a> <span class="c_08 b_b"> ({$item.number}):</span>&nbsp;<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">({$item.nickname|t_body:'name'})</a>&nbsp;
     ({if $c_member_id == $item.c_member_id || $c_member_id == $c_commu.c_member_id_admin}) <a href="({t_url m=pc a=page_c_event_write_delete_confirm})&amp;target_c_commu_topic_comment_id=({$item.c_commu_topic_comment_id})">削除</a> ({/if})
&nbsp;&nbsp;<a href="#comment" onclick="javascript:document.getElementsByName('body').item(0).value += '>>({$item.number})&nbsp;({$item.nickname|replace:"&#039;":"’"})さん\n';"><img src="skin/default/img/write_pen01.gif" align="absmiddle" alt="レスをつける"></a> </div></td>

     </tr>
     <tr>
     <td class="border_01" style="width:526px; border-top:none;">
<div class="padding_s lh_120">

({if $item.image_filename1||$item.image_filename2||$item.image_filename3})
     ({if $item.image_filename1})<a href="({t_img_url filename=$item.image_filename1})" class="thickbox" rel="gallery-plants({$item.number})" target="_blank"><img src="({t_img_url filename=$item.image_filename1 w=120 h=120})"></a><span class="functions"><a href="({t_img_url filename=$item.image_filename1})" target="_blank"><img src="({t_img_url_skin filename=icon_window})" alt="別ウィンドウで開く（原寸）" title="別ウィンドウで開く（原寸）"></a></span>({/if})
     ({if $item.image_filename2})<a href="({t_img_url filename=$item.image_filename2})" class="thickbox" rel="gallery-plants({$item.number})" target="_blank"><img src="({t_img_url filename=$item.image_filename2 w=120 h=120})"></a><span class="functions"><a href="({t_img_url filename=$item.image_filename2})" target="_blank"><img src="({t_img_url_skin filename=icon_window})" alt="別ウィンドウで開く（原寸）" title="別ウィンドウで開く（原寸）"></a></span>({/if})
     ({if $item.image_filename3})<a href="({t_img_url filename=$item.image_filename3})" class="thickbox" rel="gallery-plants({$item.number})" target="_blank"><img src="({t_img_url filename=$item.image_filename3 w=120 h=120})"></a><span class="functions"><a href="({t_img_url filename=$item.image_filename3})" target="_blank"><img src="({t_img_url_skin filename=icon_window})" alt="別ウィンドウで開く（原寸）" title="別ウィンドウで開く（原寸）"></a></span>({/if})
     <br>
     ({/if})

     ({$item.body|bbcode2html|t_replace_d|t_body:'event'|t_geocode})
</div></td>
</tr>
({*********})
({/foreach})
</table>






</td></tr>
<tr><td  class="bg_00 border_01" colspan="5" style="width:636px; border-bottom:none;text-align:right; border-top:none;">

<div class="padding_s">
トータル数[({$total_num|default:0})]件&nbsp;&nbsp;({$page_link|smarty:nodefaults})
</div>

</td>

</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：書き込み一覧＞＞内容* -->
</td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
</table>
<!-- ******ここまで：書き込み一覧****** -->
<!-- ********************************* -->
({/if})
<img src="./skin/dummy.gif" class="v_spacer_l">
({/if})

<!-- コメントふきだしアンカー -->
<span id="wedge"></span>
<script type="text/javascript">
    /*コメントふきだし初期化*/
    makeballoon();
</script>

({if $is_c_commu_member})
<!-- ******************************* -->
<!-- ******ここから：書き込み覧****** -->
({t_form _enctype=file m=pc a=page_c_event_write_confirm _name=editForm})
<input type="hidden" name="target_c_commu_topic_id" value="({$c_topic.c_commu_topic_id})">

<table border="0" cellspacing="0" cellpadding="0" style="width:650px;margin:0px auto;" class="border_07">
<tr>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:636px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
</tr>
<tr>
<td class="bg_00" style="width:7px;"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
<td class="bg_01" align="center" style="width:636px;">
<!-- *ここから：書き込み覧＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
<a name="comment_entry"></a>
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;">
<tr>
<td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
<td style="width:600px;padding:2px 0px;" class="bg_06"><span class="b_b">新しく書き込む</span></td>
</tr>
</table>

<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<table border="0" cellspacing="0" cellpadding="0" style="width:636px;">
({*********})
<tr>
<td style="width:636px;height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:150px;height:50px;" class="bg_05" align="center" valign="middle">

<div class="padding_s">

本　　文

</div>

</td>
<td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td style="width:485px;" class="bg_02" align="left" valign="middle">

<div class="padding_s">

({* FeslyBBCode *})
({ext_include file="inc_bbcode_fesly_editor.tpl"})
<textarea name="body" rows="10" cols="50" style="width:415px">({$body})</textarea>
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
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">

<div class="padding_s">

写　真 1

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

<input type="file" name="image_filename1" size="40">

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_05" align="center" valign="middle">

<div class="padding_s">

写　真 2

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

<input type="file" name="image_filename2" size="40">

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
<td class="bg_05" align="center" valign="middle">

<div class="padding_s">

写　真 3

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
<td class="bg_02" align="left" valign="middle">

<div class="padding_s">

<input type="file" name="image_filename3" size="40">

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
<td class="bg_03" align="center" valign="middle" colspan="3">

<div class="padding_w_m">

({if $is_c_event_admin})
<input type="submit" class="submit" name="button" value="コメントのみ書き込む">
({elseif $is_c_event_member})
<input type="submit" class="submit" name="button" value="参加をキャンセルする">
<input type="submit" class="submit" name="button" value="コメントのみ書き込む">
({elseif $is_c_commu_member})
<input type="submit" class="submit" name="button" value="イベントに参加する">
<input type="submit" class="submit" name="button" value="コメントのみ書き込む">
({/if})

</div>

</td>
<td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
<tr>
<td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
</tr>
({*********})
</table>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：書き込み覧＞＞内容* -->
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
<!-- ******ここまで：書き込み覧****** -->
<!-- ******************************* -->

<img src="./skin/dummy.gif" class="v_spacer_l">
({/if})

<!-- **************************************** -->
<!-- ******ここから：コミュニティトップへ****** -->
<div id="link_community_top" align="center">

<img src="./skin/dummy.gif" class="icon arrow_1">&nbsp;
<a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$c_commu.c_commu_id})">[({$c_commu.name|t_body:'name'})]コミュニティトップへ</a>

</div>
<!-- ******ここまで：コミュニティトップへ****** -->
<!-- **************************************** -->

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

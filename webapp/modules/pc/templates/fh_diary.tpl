({$inc_html_header|smarty:nodefaults})
<body onload="onLoad()">
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
                        <td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy">
                        </td>
                        <td style="width:149px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy">
                        </td>
                    </tr>
                    <tr>
                        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy">
                        </td>
                        <td class="bg_10" align="center">
<!-- *ここから：カレンダー＞内容* -->
({*ここから：header*})
<!-- ここから：カレンダータイトル -->
                        <table border="0" cellspacing="0" cellpadding="0" style="width:149px;margin:0px auto;">
                            <tr>
                                <td align="center" class="bg_03 padding_s">
                                <div class="padding_s">
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
                                </div>
                                </td>
                            </tr>
                        </table>
<!-- ここまで：カレンダータイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
                        <table border="0" cellspacing="0" cellpadding="0" style="width:149px;margin:0px auto;">
                            <tr>
                                <td style="width:149px;" class="bg_10" colspan="13"><img src="./skin/dummy.gif" style="width:149px;height:1px;" class="dummy">
                                </td>
                            </tr>
                            <tr>
                                <td class="bg_09 s_ss" align="center"><span class="c_02 s_ss">日</span></td>
                                <td style="width:1px;" class="bg_10"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                <td class="bg_09 s_ss" align="center">月</td>
                                <td style="width:1px;" class="bg_10"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                <td class="bg_09 s_ss" align="center">火</td>
                                <td style="width:1px;" class="bg_10"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                <td class="bg_09 s_ss" align="center">水</td>
                                <td style="width:1px;" class="bg_10"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                <td class="bg_09 s_ss" align="center">木</td>
                                <td style="width:1px;" class="bg_10"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                <td class="bg_09 s_ss" align="center">金</td>
                                <td style="width:1px;" class="bg_10"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                <td class="bg_09 s_ss" align="center"><span class="c_03 s_ss">土</span></td>
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
                                    &nbsp;
                                ({/if})
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

<!-- ****************************** -->
<!-- ******ここから：最近の日記****** -->
                <table border="0" cellspacing="0" cellpadding="0" style="width:165px;margin:0px auto;" class="border_07">
                    <tr>
                        <td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td style="width:149px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    </tr>
                    <tr>
                        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td class="bg_10" align="left">
                        <!-- *ここから：最近の日記＞内容* -->
                        ({*ここから：header*})
                        <!-- ここから：小タイトル -->
                        <table border="0" cellspacing="0" cellpadding="0" style="width:149px;" class="border_01">
                            <tr>
                                <td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
                                <td style="width:111px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">最近の日記</span></td>
                            </tr>
                        </table>
                        <!-- ここまで：小タイトル -->
                        ({*ここまで：header*})
                        ({*ここから：body*})
                        <!-- ここから：主内容 -->
                        <div align="left" style="padding:3px;" class="bg_02 border_01">
                        ({foreach from=$new_diary_list item=item})
                            <div><a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})"><img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_3">({$item.subject|t_body:'title'})</a></div>

                        ({/foreach})
                        </div>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：最近の日記＞＞内容* -->
                        </td>
                        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    </tr>
                    <tr>
                        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    </tr>
                </table>
<!-- ******ここまで：最近の日記****** -->
<!-- ******************************* -->

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
({if $member_tag_list})
({ext_include file="new_templates/tag_list.tpl"})
({/if})
({********************************})
({**ここまで：メインコンテンツ（左）**})
({********************************})
                </td>
                <td style="width:8px;"><img src="./skin/dummy.gif" style="width:8px;" class="dummy"></td>({*<--spacer*})
                <td class="right_content_540" align="left" valign="top">
({********************************})
({**ここから：メインコンテンツ（右）**})
({********************************})

<img src="./skin/dummy.gif" class="v_spacer_l">

<!-- ***************************** -->
<!-- ******ここから：日記本文****** -->
<!-- ******ここから：日記本文****** -->
     <table border="0" cellspacing="0" cellpadding="0" style="width:540px;margin:0px auto;" class="border_07">
     <tr>
          <td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
          <td style="width:524px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
          <td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
     </tr>
     <tr>
          <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
          <td class="bg_01" align="left">
<!-- *ここから：日記本文＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
          <table border="0" cellspacing="0" cellpadding="0" style="width:526px;" class="border_01">
          <tr>
               <td style="width:201px;" class="bg_06">
               <img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy">
               </td>
               <td style="width:325px;padding:2px 0px;" class="bg_06">
               <span class="b_b c_00"><span id="DOM_fh_diary_writer">({$target_member.nickname|t_body:'name'})</span>({if $type == "f"})さん({/if})の日記</span>
               </td>
          </tr>
          <tr>
               <td style="width:201px;padding:2px 0px;" class="bg_05">
               ({if $target_diary.c_diary_id_prev})<a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$target_diary.c_diary_id_prev})">&lt;&lt;前の日記</a>({/if})</td>
               <td style="width:325px;padding:2px 0px;" class="bg_05" align="right">
               ({if $target_diary.c_diary_id_next})<a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$target_diary.c_diary_id_next})"> 次の日記&gt;&gt;</a>({/if})
               </td>
          </tr>
          </table>


<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<!-- ここから：主内容＞＞日記表示 -->
                        <table border="0" cellspacing="0" cellpadding="0" style="width:526px;" class="border_01">

                            <tr>

                                <td style="width:95px;" class="bg_05" align="center" valign="top" rowspan="5">
                                <div style="padding:4px 3px;">
                                ({$target_diary.r_datetime|date_format:"%Y年%m月%d日<br>%H:%M"})<br>
                                <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$target_member.c_member_id})">
                                <img src="({t_img_url filename=$target_member.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
                                </div>
                                </td>
                                <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                <td style="width:430px;" class="bg_02" align="left" valign="middle">
                                <div style="padding:4px 3px;">
                                <span id="DOM_fh_diary_title">({$target_diary.subject|t_body:'title'})</span>
                                </div>
                                </td>

                            </tr>
({*********})
                            <tr>
                                <td style="width:526px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                            </tr>
({*********})
                            <tr>
                                <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>

                                <td class="bg_02" align="right" valign="middle">
                                <div style="padding:4px 3px;">
                                ({if $type == "h"})
                                    ({if $target_diary.public_flag == "open"})
                                    外部公開
                                    ({elseif $target_diary.public_flag == "public"})
                                    サイト内全体公開
                                    ({elseif $target_diary.public_flag == "friend"})
                                    ({$WORD_MY_FRIEND})まで公開
                                    ({elseif $target_diary.public_flag == "private"})
                                    公開しない
                                    ({/if})
                                ({else})
                                    ({if $target_diary.public_flag == "open"})
                                    外部公開
                                    ({elseif $target_diary.public_flag == "public"})
                                    サイト内全体公開
                                    ({elseif $target_diary.public_flag == "friend"})
                                    ({$WORD_MY_FRIEND})まで公開
                                    ({/if})
                                ({/if})
                                <br>
                                閲覧件数:({$target_diary.etsuran_count})
                                </div>
                                </td>

                            </tr>
({*********})
                            <tr>

                                <td style="width:426px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                            </tr>
({*********})
                            <tr>
                                <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>

                                <td class="bg_02" align="left" valign="middle" style="width:424px;">
                                <div style="padding:4px 3px;">
                                ({if $target_diary.image_filename_1})
                                    <a href="({t_img_url filename=$target_diary.image_filename_1})" class="thickbox" rel="gallery-plants" target="_blank">
                                    <img src="({t_img_url filename=$target_diary.image_filename_1 w=120 h=120})"></a>
                                    <span class="functions"><a href="({t_img_url filename=$target_diary.image_filename_1})" target="_blank"><img src="({t_img_url_skin filename=icon_window})" alt="別ウィンドウで開く（原寸）" title="別ウィンドウで開く（原寸）" /></a></span>
                                ({/if})
                                ({if $target_diary.image_filename_2})
                                    <a href="({t_img_url filename=$target_diary.image_filename_2})" class="thickbox" rel="gallery-plants" target="_blank">
                                    <img src="({t_img_url filename=$target_diary.image_filename_2 w=120 h=120})"></a>
                                    <span class="functions"><a href="({t_img_url filename=$target_diary.image_filename_2})" target="_blank"><img src="({t_img_url_skin filename=icon_window})" alt="別ウィンドウで開く（原寸）" title="別ウィンドウで開く（原寸）" /></a></span>
                                ({/if})
                                ({if $target_diary.image_filename_3})
                                    <a href="({t_img_url filename=$target_diary.image_filename_3})" class="thickbox" rel="gallery-plants" target="_blank">
                                    <img src="({t_img_url filename=$target_diary.image_filename_3 w=120 h=120})"></a>
                                    <span class="functions"><a href="({t_img_url filename=$target_diary.image_filename_3})" target="_blank"><img src="({t_img_url_skin filename=icon_window})" alt="別ウィンドウで開く（原寸）" title="別ウィンドウで開く（原寸）" /></a></span>
                                ({/if})
                                <div class="lh_120" id="DOM_fh_diary_body">
                                ({$target_diary.body|bbcode2html|t_replace_d|t_body:'diary'|t_geocode})
                                </div>
                                </td>

                            </tr>
({*********})
                            <tr>
                                <td style="height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                            </tr>
({*********})
                            <tr>

                                <td class="bg_02" align="right" colspan="3">
                                <div style="padding:4px 3px;">
                                ({foreach from=$tags_list item=item})
                                     ({$item.c_tags_name})
                                     ({/foreach})
                                </div>
                                </td>

                            </tr>
({*********})
                            <tr>
                                <td style="height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                            </tr>
                        ({if $type == "h"})
                            <tr>

                                <td class="bg_02" align="center" colspan="3">
                                <div style="padding:4px 3px;">
                                ({t_form _method=get m=pc a=page_h_diary_edit})
                                <input type="hidden" name="target_c_diary_id" value="({$target_diary.c_diary_id})">
                                <input type="submit"  class="submit" value="編 集">
                                </form>
                                </div>
                                </td>

                            </tr>
({*********})
                            <tr>
                                <td style="height:1px;" class="bg_01" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                            </tr>
({*********})
                        ({/if})
                        </table>
<!-- ここまで：主内容＞＞日記表示 -->
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- 無し -->
({*ここまで：footer*})
<!-- *ここまで：日記本文＞＞内容* -->
                        </td>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    </tr>
                    <tr>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    </tr>
                </table>
<!-- ******ここまで：日記本文****** -->
<!-- ***************************** -->

<img src="./skin/dummy.gif" class="v_spacer_l">

            ({if $target_diary_comment_list})
<!-- ********************************* -->
<!-- ******ここから：コメント一覧****** -->

                <table border="0" cellspacing="0" cellpadding="0" style="width:540px;margin:0px auto;" class="border_07" id="DOM_fh_diary_comments">
                    <tr>
                        <td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td style="width:524px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    </tr>
                    <tr>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td class="bg_01" align="left">
<!-- *ここから：コメント一覧＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
                        <table border="0" cellspacing="0" cellpadding="0" style="width:256px;" class="border_01">
                            <tr>
                                <td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
                                <td style="width:486px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">
                                コメント
                                </span></td>
                            </tr>
                        </table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
<!-- ここから：主内容＞＞表示件数切り替え -->
                        <table border="0" cellspacing="0" cellpadding="0" style="width:526px;">
({*********})
                            <tr>
                                <td style="width:526px;height:1px;" class="bg_01" colspan="3"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                            </tr>
({*********})
                            <tr>
                                <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                <td style="width:524px;" class="bg_02" align="right" valign="middle">
                                <div style="padding:4px 3px;">コメント数[({$total_num})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br><br>
                                <a href="#comment_entry">コメント入力</a>
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
<!-- ここまで：主内容＞＞表示件数切り替え -->
<!-- ここから：主内容＞＞コメント表示 -->
                ({t_form m=pc a=page_fh_delete_comment})
                <input type="hidden" name="target_c_diary_id" value="({$target_diary.c_diary_id})">

                        <table border="0" cellspacing="0" cellpadding="0"   style="width:526px;">
          ({foreach from=$target_diary_comment_list item=item})
                            <tr>

                                <td  class="bg_05 border_01" align="center" valign="top" rowspan="2" style="width:95px; border-top-style:none;">
                                <div style="padding:4px 3px;">
                                <a name="({$item.comment_number})"></a>
                                ({$item.r_datetime|date_format:"%Y年%m月%d日<br>%H:%M"})<br>
                                <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
                                <img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
                                ({if $type == "h"})
                                    <br>
                                    <input type="checkbox" name="target_c_diary_comment_id[]" value="({$item.c_diary_comment_id})" class="no_bg">
                                ({/if})
                                </div>
                                </td>

                                <td  class="bg_02 border_01" align="left" valign="middle" style="width:430px; border-top-style:none; border-left-style:none;">
                                <div style="padding:4px 3px;">
                                ({$item.comment_number})&nbsp;
                                ({if $item.nickname|t_body:'name'})
                                    <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})"><span class="DOM_fh_diary_comment_writer">({$item.nickname|t_body:'name'|default:"&nbsp;"})</span></a>
                                ({else})&nbsp;
                                ({/if})
                                ({if $type == "f" && $item.c_member_id == $member.c_member_id})
                                    |&nbsp;<a href="({t_url m=pc a=page_fh_delete_comment})&amp;target_c_diary_id=({$target_diary.c_diary_id})&amp;target_c_diary_comment_id=({$item.c_diary_comment_id})">削除</a>

                                ({/if})
                                &nbsp;&nbsp;<a href="#comment_entry" onclick="javascript:document.getElementsByName('body').item(0).value += '>>({$item.comment_number})&nbsp;({$item.nickname|replace:"&#039;":"’"})さん\n';">
                                <img src="skin/default/img/write_pen01.gif" align="absmiddle" alt="レスをつける">
                                </a>
                                </div>

                                </td>

                            </tr>

                            <tr>


                                <td class="bg_02 border_01" align="left" valign="middle" style="border-top-style:none;border-left-style:none;">
                                <div style="padding:4px 3px;" class="lh_120 DOM_fh_diary_comment_body">
                                ({if $item.image_filename_1||$item.image_filename_2||$item.image_filename_3})
                                ({if $item.image_filename_1})<a href="({t_img_url filename=$item.image_filename_1})" class="thickbox" rel="gallery-plants({$item.c_diary_comment_id})" target="_blank"><img src="({t_img_url filename=$item.image_filename_1 w=120 h=120})"></a><span class="functions"><a href="({t_img_url filename=$item.image_filename_1})" target="_blank"><img src="({t_img_url_skin filename=icon_window})" alt="別ウィンドウで開く（原寸）" title="別ウィンドウで開く（原寸）" /></a></span>({/if})
                                ({if $item.image_filename_2})<a href="({t_img_url filename=$item.image_filename_2})" class="thickbox" rel="gallery-plants({$item.c_diary_comment_id})" target="_blank"><img src="({t_img_url filename=$item.image_filename_2 w=120 h=120})"></a><span class="functions"><a href="({t_img_url filename=$item.image_filename_2})" target="_blank"><img src="({t_img_url_skin filename=icon_window})" alt="別ウィンドウで開く（原寸）" title="別ウィンドウで開く（原寸）" /></a></span>({/if})
                                ({if $item.image_filename_3})<a href="({t_img_url filename=$item.image_filename_3})" class="thickbox" rel="gallery-plants({$item.c_diary_comment_id})" target="_blank"><img src="({t_img_url filename=$item.image_filename_3 w=120 h=120})"></a><span class="functions"><a href="({t_img_url filename=$item.image_filename_3})" target="_blank"><img src="({t_img_url_skin filename=icon_window})" alt="別ウィンドウで開く（原寸）" title="別ウィンドウで開く（原寸）" /></a></span>({/if})
                                    <br>
                                ({/if})

                                ({$item.body|t_geocode|bbcode2html|t_replace_d|t_body:'diary'})
                                </div>
                                </td>

                            </tr>


                        ({/foreach})
                        </table>
<!-- ここまで：主内容＞＞コメント表示 -->
<!-- ここまで：主内容 -->
({*ここまで：body*})

({*ここから：footer*})
                        ({if $type == "h"})
<!-- ここから：削除 -->
                        <table border="0" cellspacing="0" cellpadding="0"  class="border_01" style="width:526px; border-top-style:none;">

                            <tr>

                                <td style="width:526px;" class="bg_03" align="left" valign="middle" colspan="3">
                                <div style="padding:4px 3px;" class="lh_120">
                                <img src="./skin/dummy.gif" class="v_spacer_l">
                                    <div style="text-align:center;">
                                    <input type="submit" class="submit" value="　削 除　">
                                    </div>
                                <img src="./skin/dummy.gif" class="v_spacer_l">
                                </div>
                                </td>

                            </tr>

                        </table>
<!-- ここまで：削除 -->
                    ({/if})
                        </form>
({*ここまで：footer*})
<!-- *ここまで：コメント一覧＞＞内容* -->
<!-- ここから：主内容＞＞表示件数切り替え -->
                        <table border="0" cellspacing="0" cellpadding="0" style="width:526px;">

                            <tr>
                                <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                <td style="width:524px;" class="bg_02" align="right" valign="middle">
                                <div style="padding:4px 3px;">
                                コメント数[({$total_num})]件&nbsp;&nbsp;
                                ({$page_link|smarty:nodefaults})<br>
                                ({t_form m=pc a=page_fh_diary}) <select name="page_size">
                                <option value="5"({if $page_size == "5"}) selected ({/if})>5件</option>
                                <option value="10"({if $page_size == "10"}) selected ({/if})>10件</option>
                                <option value="20"({if $page_size == "20"}) selected ({/if})>20件</option>
                                <option value="30"({if $page_size == "30"}) selected ({/if})>30件</option>
                                </select><input type="submit" value="表示件数変更">
                                <input type="hidden" name="target_c_diary_id" value="({$target_diary.c_diary_id})">
                                </form>
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
<!-- ここまで：主内容＞＞表示件数切り替え -->
                        </td>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    </tr>
                    <tr>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    </tr>
                </table>
<!-- ******ここまで：コメント一覧****** -->
<!-- ******************************** -->
<img src="./skin/dummy.gif" class="v_spacer_l">
            ({/if})

<!-- コメントふきだしアンカー -->
<span id="wedge"></span>
<script type="text/javascript">
    /*コメントふきだし初期化*/
    makeballoon();
</script>

<!-- ********************************** -->
<!-- ******ここから：コメントを書く****** -->
                ({t_form _enctype=file m=pc a=page_fh_diary_comment_confirm})
                </form>
                <form name="editForm" action="./" method="post" enctype="multipart/form-data">
                <input type="hidden" name="m" value="pc">
                <input type="hidden" name="a" value="page_fh_diary_comment_confirm">
                <input type="hidden" name="target_c_diary_id" value="({$target_diary.c_diary_id})">
                <table border="0" cellspacing="0" cellpadding="0" style="width:540px;margin:0px auto;" class="border_07">
                    <tr>
                        <td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td style="width:524px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                    </tr>
                    <tr>
                        <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
                        <td class="bg_01" align="left">
<!-- *ここから：コメントを書く＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
                        <a name="comment_entry"></a>
                        <table border="0" cellspacing="0" cellpadding="0" style="width:524px;" class="border_01">
                            <tr>
                                <td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
                                <td style="width:486px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">コメントを書く</span></td>
                            </tr>
                        </table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
                        <table border="0" cellspacing="0" cellpadding="0" style="width:524px;" class="border_01">
({*********})
                            <tr>
                                <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                <td style="width:522px;height:1px;" class="bg_01" colspan="4"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                            </tr>
({*********})
                            <tr>
                                <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                <td style="width:95px;" class="bg_05" align="center" valign="middle">
                                    <div style="padding:4px 4px;" class="lh_120">
                                    本　　文
                                    </div>
                                    </td>
                                <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                <td class="bg_02" align="left" valign="middle" style="width:424px;">


                                <div class="padding_s">
                                ({* FeslyBBCode *})
                                ({ext_include file="inc_bbcode_fesly_editor.tpl"})
                                <textarea name="body" rows="8" cols="40" style="width:419px">({$requests.body})</textarea>
                                ({* BBCode *})
                                ({ext_include file="inc_bbcode.tpl"})

                                ({*********絵文字*********})
                                ({ext_include file="new_templates/emojipat_docomo.tpl"})
                                ({*********絵文字*********})

                                </div>
                                </td>
                                <td style="width:1px" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
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
                                <input type="file" name="upfile_1" size="40">
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
                                <div style="padding:4px 3px;">
                                写　真 2
                                </div>
                                </td>
                                <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                <td class="bg_02" align="left" valign="middle">
                                <div style="padding:4px 3px;">
                                <input type="file" name="upfile_2" size="40">
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
                                <div style="padding:4px 3px;">
                                写　真 3
                                </div>
                                </td>
                                <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                                <td class="bg_02" align="left" valign="middle">
                                <div style="padding:4px 3px;">
                                <input type="file" name="upfile_3" size="40">
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
                                <input type="submit" class="submit" value="　確認画面　">&nbsp;&nbsp;
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
<!-- *ここまで：コメントを書く＞＞内容* -->
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
<!-- ******ここまで：コメントを書く****** -->
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

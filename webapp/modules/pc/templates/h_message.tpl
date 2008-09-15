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
        <td style="width:5px;"><img src="./skin/dummy.gif" style="width:5px;" class="dummy"></td>
        <td class="left_content_175" align="center" valign="top">
({***********************************})
({**ここから：メインコンテンツ(左)*******})
({***********************************})

        <img src="./skin/dummy.gif" class="v_spacer_l">

        ({ext_include file="new_templates/message_left.tpl"})

({********************************})
({**ここまで：メインコンテンツ（左）**})
({********************************})
        </td>
        <td style="width:5px;"><img src="./skin/dummy.gif" style="width:5px;" class="dummy"></td>
        <td class="right_content_535" align="center" valign="top">
({********************************})
({**ここから：メインコンテンツ（右）**})
({********************************})

        <img src="./skin/dummy.gif" class="v_spacer_l">

<!-- **************************** -->
<!-- ******ここから：メッセージ表示欄****** -->
        <table border="0" cellspacing="0" cellpadding="0" style="width:520px;margin:0px auto;" class="border_07">
          <tr>
            <td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
            <td style="width:506px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
            <td style="width:7px;" class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
          </tr>
          <tr>
            <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
            <td class="bg_01" align="left">
<!-- *ここから：メッセージ表示欄＞内容* -->
({*ここから：header*})
<!-- ここから：小タイトル -->
              <table border="0" cellspacing="0" cellpadding="0" style="width:506px;" class="border_01">
                <tr>
                  <td style="width:36px;" class="bg_06"><img src="({t_img_url_skin filename=content_header_1})" style="width:30px;height:20px;" class="dummy"></td>
                  <td style="width:468px;padding:2px 0px;" class="bg_06"><span class="b_b c_00">メッセージの詳細</span></td>
                </tr>
              </table>
<!-- ここまで：小タイトル -->
({*ここまで：header*})
({*ここから：body*})
<!-- ここから：主内容 -->
              <table border="0" cellspacing="0" cellpadding="0" style="width:506px;">
({*********})
                <tr>
                  <td style="height:1px;" class="bg_01" colspan="6"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                </tr>
({*********})
                <tr>
                  <td style="width:1px;" class="bg_01" rowspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                  <td style="width:110px;" align="center" rowspan="5" class="bg_03">
                    <div class="padding_s">
                    <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({if $c_message.is_received})({$c_message.c_member_id_from})({else})({$c_message.c_member_id_to})({/if})">
                    <img src="({t_img_url filename=$c_message.image_filename_disp w=120 h=120 noimg=no_image_midium})"></a>
                    </div>
                  </td>
                  <td style="width:1px;" class="bg_01" rowspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                  <td style="width:63px;" class="bg_05" align="right">
                    <div class="padding_s">
                    ({if $c_message.is_received})
                      差出人 :
                    ({else})
                      宛 先 :
                    ({/if})
                    </div>
                  </td>
                  <td style="width:330px;" class="bg_05" align="left">
                    <div class="padding_s">
                    ({if $c_message.is_received})
                      <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$c_message.c_member_id_from})">({$c_message.c_member_nickname_from|t_body:'name'})</a>&nbsp;&nbsp;&nbsp;<a href="({t_url m=pc a=page_h_inquiry})&amp;category_flag=2&amp;target_c_member_id=({$c_message.c_member_id_from})&amp;data_id=({$c_message.c_message_id})&amp;data_flag=2">迷惑ユーザを報告する</a>
                    ({else})
                      <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$c_message.c_member_id_to})">({$c_message.c_member_nickname_to|t_body:'name'})</a>
                    ({/if})
                    </div>
                  </td>
                  <td style="width:1px;" class="bg_01" rowspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy">
                  </td>
                </tr>
({*********})
                <tr>
                  <td style="height:1px;" class="bg_01" colspan="2"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                </tr>
({*********})
                <tr>
                  <td class="bg_05" align="right">
                    <div class="padding_s">
                      日　付 :
                    </div>
                  </td>
                  <td class="bg_05" align="left">
                    <div class="padding_s">
                      ({$c_message.r_datetime|date_format:"%Y年%m月%d日 %H:%M"})
                    </div>
                  </td>
                </tr>
({*********})
                <tr>
                  <td style="height:1px;" class="bg_01" colspan="2"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                </tr>
({*********})
                <tr>
                  <td class="bg_05" align="right">
                  <div class="padding_s">
                    件　名 :
                  </div>
                  </td>
                  <td class="bg_05" align="left">
                  <div class="padding_s">
                    ({$c_message.subject|t_body:'title'})
                  </div>
                  </td>
                </tr>
({*********})
                <tr>
                  <td style="height:1px;" class="bg_01" colspan="6"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                </tr>
({*********})
                <tr>
                  <td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy">
                  </td>
                  <td align="left" valign="top" colspan="4" class="bg_02">
                    <div class="padding_w_m">
                    ({if $c_message.image_filename_1})
                      <a href="({t_img_url filename=$c_message.image_filename_1})" target="_blank">
                      <img src="({t_img_url filename=$c_message.image_filename_1 w=120 h=120})"></a>
                    ({/if})
                    ({if $c_message.image_filename_2})
                      <a href="({t_img_url filename=$c_message.image_filename_2})" target="_blank">
                      <img src="({t_img_url filename=$c_message.image_filename_2 w=120 h=120})"></a>
                    ({/if})
                    ({if $c_message.image_filename_3})
                      <a href="({t_img_url filename=$c_message.image_filename_3})" target="_blank">
                      <img src="({t_img_url filename=$c_message.image_filename_3 w=120 h=120})"></a>
                    ({/if})
                    ({if $c_message.image_filename_1||$c_message.image_filename_2||$c_message.image_filename_3})
                      <br><br>
                    ({/if})
                      ({$c_message.body|bbcode2html|t_replace_d|t_body:'message'|t_geocode})
                    </div>
                  </td>
                  <td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy">
                  </td>
                </tr>
({*********})
              </table>
<!-- ここまで：主内容 -->
({*ここまで：body*})
({*ここから：footer*})
<!-- ここから：コマンド？ -->
              <table border="0" cellspacing="0" cellpadding="0" class="border_01" style="width: 506px;">
                <tr>
                  <td style="width:340px;height:2em;" class="bg_03" align="left">
                  <div class="padding_s">
                  ({t_form m=pc a=do_h_message_box_delete_message})
                    <input type="hidden" name="sessid" value="({$PHPSESSID})">
                    <input type="hidden" name="c_message_id[]" value=({$c_message.c_message_id})>
                    <input type="hidden" name="box" value="({$box})">
                    ({if $box == 'trash'})
                      <input type="submit" class="submit" name="move" value="元に戻す">
                    ({/if})
                    <input type="submit" class="submit" name="remove" value="削 除">
                  </form>
                  </div>
                  </td>
                  <td style="width:164px;" class="bg_03" align="right">
                  <div class="padding_s">
                    ({if $box == 'inbox' || !$box })
                    ({t_form m=pc a=page_f_message_send})
                      <input type="hidden" name="target_c_message_id" value="({$c_message.c_message_id})">
                      <input type="hidden" name="jyusin_c_message_id" value="({$jyusin_c_message_id})">
                      <input type="hidden" name="target_c_member_id" value="({$c_message.c_member_id_from})">
                      <input name="hensin2" type="submit" class="submit" value="　返信する　">
                    </form>
                    ({/if})
                  </div>
                  </td>
                </tr>
              </table>
<!-- ここまで：コマンド？ -->
({*ここまで：footer*})
<!-- *ここまで：メッセージ表示欄＞＞内容* -->
            </td>
            <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
          </tr>
          <tr>
            <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
            <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
            <td class="bg_00"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
          </tr>
        </table>
<!-- ******ここまで：メッセージ表示欄****** -->
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

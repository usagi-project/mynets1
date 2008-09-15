<table border="0" cellspacing="0" cellpadding="0" style="width:270px;margin:0px auto;" class="border_07" id="main_image_and_name">
    <tr>
        <td style="width:7px;height:7px;" class="bg_05">
            <img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy">
        </td>
        <td style="width:254px;height:7px;" class="bg_05">
            <img src="./skin/dummy.gif" style="width:254px;height:7px;" class="dummy">
        </td>
        <td style="width:7px;height:7px;" class="bg_05">
            <img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy">
        </td>
    </tr>
    <tr>
        <td class="bg_05">
            <img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy">
        </td>
        <td align="center" class="bg_02">
        ({if !$is_h_prof})
            <table border="0" cellspacing="0" cellpadding="0" style="width:254px;">
                <tr>
                    <td align="center" class="bg_05">
                    ({if ($is_friend || $friend_path)})
                        ({$c_member.nickname|t_body:'name'})
                        ({if $friend_path})
                        ⇒ <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$friend_path.c_member_id})">({$friend_path.nickname|t_body:'name'})</a>
                        ({/if})
                        ⇒ <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$target_c_member.c_member_id})">({$target_c_member.nickname|t_body:'name'})</a>
                    ({else})
                        &nbsp;
                    ({/if})
                    <img src="./skin/dummy.gif" class="v_spacer_s">
                    </td>
                </tr>
            </table>
        ({/if})
({*ここまで：header*})
({*ここから：body*})
            <div class="border_07 bg_02" align="center">
                <table border="0" cellspacing="0" cellpadding="0" style="width:252px;">
                    <tr>
                        <td align="center">
                            <img src="./skin/dummy.gif" class="v_spacer_m">
                            <div align="center">
                                <div><img src="({t_img_url_skin filename=oneword_top})"></div>
                                <div id="oneword_back">
                                    <div id="oneword">
                                        ({if $oneword})({$oneword|t_body:'dengon'|default:"&nbsp;"})
                                        ({else})・・・・・・
                                        ({/if})
                                    </div>
                                </div>
                                <div><img src="({t_img_url_skin filename=oneword_bottom})"></div>
                            </div>
                            <img src="({t_img_url filename=$c_member.image_filename w=180 h=180 noimg=no_image})" class="pict" alt="写真" style="margin:2px">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <a href="({t_url m=pc a=page_h_config_image})">
                                        <img src="({t_img_url_skin filename=button_edit_photo})"></a>
                                        <a href="({t_url m=pc a=page_h_prof})">
                                        <img src="({t_img_url_skin filename=button_prof_conf})"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="./skin/dummy.gif" class="v_spacer_m">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
({*ここまで：body*})
({*ここから：footer*})
            <table border="0" cellspacing="0" cellpadding="0" style="width:254px;">
                <tr>
                    <td align="center" class="bg_05 c_04">
                        <img src="./skin/dummy.gif" class="v_spacer_m">
                        ({$c_member.nickname|t_body:'name'})さん (({$c_friend_count}))
                        <img src="./skin/dummy.gif" class="v_spacer_m">
                    </td>
                </tr>
            </table>
            <table border="0" cellspacing="0" cellpadding="0" style="width:252px;">
                <tr>
                    <td style="line-height:120%;">
                        <div class="border_01 bg_02 padding_s" align="left">
                            ({$inc_side_menu|smarty:nodefaults})
                            <hr style="border-style:solid;border-color:#cccccc;border-width:1px 0 0 0;margin:3px 0;">
                            <img src="skin/default/img/icon_1.gif" align="absmiddle" style="margin-right:5px">
                            <a href="?m=pc&a=page_h_gmaps_list_all" target="_top">ソーシャルマップ</a><br>
                            <img src="skin/default/img/icon_1.gif" align="absmiddle" style="margin-right:5px">
                            <a href="?m=pc&a=page_h_sns_help" target="_top">ヘルプ</a>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td class="bg_05"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_05"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td class="bg_05"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td class="bg_05"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    </tr>
</table>

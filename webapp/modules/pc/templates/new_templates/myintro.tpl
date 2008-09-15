<div class="border_07 bg_02" style="margin-bottom:5px;" id="item_11">
    <div style="padding:3px;margin:1px;" class="bg_06">
        <img src="({t_img_url_skin filename=icon_title_1})" style="cursor:pointer;" align="absmiddle" onClick="paneOnOff(11)" id="mkcnt11">
        <span style="cursor: move;" class="b_b c_00">({$WORD_MY_FRIEND})からの紹介文</span>
    </div>
    <div id="cnt11" style="display:none">
        <table border="0" cellspacing="0" cellpadding="0" style="width:100%;">
            ({foreach from=$c_friend_intro_list item=item})
            <tr>
                <td style="width:124px;border-right:none;border-left:none;border-top:none;" class="bg_03 border_01 padding_l" align="center">
                    <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
                    <img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" border="0"><br>({$item.nickname|t_body:'name'})</a>
                </td>
                <td  class="bg_02 border_01 padding_l" style="width:298px;border-right:none;border-top:none;">
                    ({$item.intro|t_truncate:"200"|nl2br|t_body:'title'})
                </td>
            </tr>
            ({/foreach})
        </table>
        <table border="0" cellspacing="0" cellpadding="0" style="width:100%;">
            <tr>
                <td style="text-align:right;" class="bg_02 lh_140 padding_s">
                    <img src="./skin/dummy.gif" class="icon arrow_1">
                    <a href="({t_url m=pc a=page_fh_intro})">全て見る</a>
                    <br>
                    <img src="./skin/dummy.gif" class="icon arrow_1">
                    <a href="({t_url m=pc a=page_h_manage_friend})">紹介文を書く</a>
                </td>
            </tr>
        </table>
    </div>
</div>

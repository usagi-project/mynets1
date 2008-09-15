({if $c_friend_list})
<div class="border_07 bg_02" style="margin-bottom:5px;">
    <div style="padding:3px;margin:1px;" class="bg_06">
        <img src="({t_img_url_skin filename=icon_title_1})" style="cursor:pointer;" align="absmiddle" onClick="paneOnOff(12)" id="mkcnt12">
        <span class="b_b c_00">({$WORD_MY_FRIEND})リスト</span>
    </div>
    <div id="cnt12" style="display:none">
        ({if $smarty.const.OPENPNE_USE_FLASH_LIST})
        <table border="0" cellspacing="0" cellpadding="0" style="width:266px;" class="bg_07">
            <tr>
                <td class="bg_07"><img src="./skin/dummy.gif" style="width:1px;"></td>
                <td class="bg_03" align="center">
                    ({capture assign=flashvars})({strip})
                    ({foreach from=$c_friend_list item=item key=key})
                    ({if $key > 0})&({/if})
                    pne_item({$key+1})_id=({$item.c_member_id})
                    &pne_item({$key+1})_name=({$item.nickname|t_truncate:36:'..'|escape:'url'})
                    &pne_item({$key+1})_linkurl=({t_url m=pc a=page_f_home _urlencode=true _html=false})%26target_c_member_id=({$item.c_member_id})
                    &pne_item({$key+1})_imageurl=({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small _urlencode=true _html=false})
                    &pne_item({$key+1})_count=({$item.friend_count})
                    ({/foreach})
                    ({/strip})({/capture})
                    <script type="text/javascript" src="js/show_flash.js"></script>
                    <script type="text/javascript">
                        <!--
                        show_flash('flash/list.swf', '({$flashvars})');
                        //-->
                    </script>
                </td>
                <td class="bg_07"><img src="./skin/dummy.gif" style="width:1px;"></td>
            </tr>
        </table>
        ({else})
        <table border="0" cellspacing="1" cellpadding="2" style="width:268px" class="bg_07">
            ({if $c_friend_list[0]})
            ({*１行目img*})
            <tr>
                ({t_loop from=$c_friend_list start=0 num=3})
                ({if $item})
                <td style="width:88px;" class="bg_03" align="center">
                    <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})" oneword='({if $item.friend_oneword})({$item.friend_oneword|t_body:'dengon'|default:"&nbsp;"})({else})・・・・・・({/if})' class="oneword_bln">
                    <img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
                </td>
                ({else})
                <td style="width:88px;" class="bg_03"><img src="./skin/dummy.gif" style="width:84px;height:84px;" class="dummy"></td>
                ({/if})
                ({/t_loop})
            </tr>
            ({*１行目name*})
            <tr>
                ({t_loop from=$c_friend_list start=0 num=3})
                ({if $item})
                <td class="bg_02" align="center">
                    <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
                    ({$item.nickname|t_body:'name'}) (({$item.friend_count}))
                    </a>
                </td>
                ({else})
                <td class="bg_02" align="center"><img src="./skin/dummy.gif" style="height:1em;" class="dummy"></td>
                ({/if})
                ({/t_loop})
            </tr>
            ({/if})
            ({*************************************************************})
            ({if $c_friend_list[3]})
            <!-- ２行目img -->
            <tr>
                ({t_loop from=$c_friend_list start=3 num=3})
                ({if $item})
                <td class="bg_03" align="center">
                    <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})" oneword='({if $item.friend_oneword})({$item.friend_oneword|t_body:'dengon'|default:"&nbsp;"})({else})・・・・・・({/if})' class="oneword_bln">
                    <img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
                </td>
                ({else})
                <td class="bg_03"><img src="./skin/dummy.gif" style="width:84px;height:84px;" class="dummy"></td>
                ({/if})
                ({/t_loop})
            </tr>
            <!-- ２行目name -->
            <tr>
                ({t_loop from=$c_friend_list start=3 num=3})
                ({if $item})
                <td class="bg_02" align="center">
                    <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
                        ({$item.nickname|t_body:'name'}) (({$item.friend_count}))
                    </a>
                </td>
                ({else})
                <td class="bg_02" align="center"><img src="./skin/dummy.gif" style="height:1em;" class="dummy"></td>
                ({/if})
                ({/t_loop})
            </tr>
            ({/if})
            ({*************************************************************})
            ({if $c_friend_list[6]})
            <!-- ３行目img -->
            <tr>
                ({t_loop from=$c_friend_list start=6 num=3})
                ({if $item})
                <td class="bg_03" align="center">
                    <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})" oneword='({if $item.friend_oneword})({$item.friend_oneword|t_body:'dengon'|default:"&nbsp;"})({else})・・・・・・({/if})' class="oneword_bln">
                    <img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image_small})" class="pict"></a>
                </td>
                ({else})
                <td class="bg_03"><img src="./skin/dummy.gif" style="width:84px;height:84px;" class="dummy"></td>
                ({/if})
                ({/t_loop})
            </tr>
            <!-- ３行目name -->
            <tr>
                ({t_loop from=$c_friend_list start=6 num=3})
                ({if $item})
                <td class="bg_02" align="center">
                    <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
                    ({$item.nickname|t_body:'name'}) (({$item.friend_count}))
                    </a>
                </td>
                ({else})
                <td class="bg_02" align="center"><img src="./skin/dummy.gif" style="height:1em;" class="dummy"></td>
                ({/if})
                ({/t_loop})
            </tr>
            ({/if})
        </table>
        ({/if})
        <div style="text-align:right;padding:5px;">
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_fh_friend_list})">全てを見る(({$c_friend_count})人)</a><br>
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_h_manage_friend})">({$WORD_MY_FRIEND})管理</a>
        </div>
    </div>
</div>
({/if})

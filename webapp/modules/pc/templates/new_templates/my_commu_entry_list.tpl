({if $c_commu_user_list})
<div class="border_07 bg_02" style="margin-bottom:5px;">
    <div style="padding:3px;margin:1px;" class="bg_06">
        <img src="({t_img_url_skin filename=icon_title_1})" style="cursor:pointer;" align="absmiddle" onClick="paneOnOff(13)" id="mkcnt13">
        <span class="b_b c_00">コミュニティリスト</span>
    </div>
    <div id="cnt13" style="display:none">
        ({if $smarty.const.OPENPNE_USE_FLASH_LIST})
        <table border="0" cellspacing="0" cellpadding="0" style="width:266px;" class="bg_07">
            <tr>
                <td class="bg_07"><img src="./skin/dummy.gif" style="width:1px;"></td>
                <td class="bg_03" align="center">

                ({capture assign=flashvars})({strip})
                ({foreach from=$c_commu_user_list item=item key=key})
                    ({if $key > 0})&({/if})
                    pne_item({$key+1})_id=({$item.c_commu_id})
                    &pne_item({$key+1})_name=({$item.name|t_truncate:36:'..'|escape:'url'})
                    &pne_item({$key+1})_linkurl=({t_url m=pc a=page_c_home _urlencode=true _html=false})%26target_c_commu_id=({$item.c_commu_id})
                    &pne_item({$key+1})_imageurl=({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_logo_small _urlencode=true _html=false})
                    &pne_item({$key+1})_count=({$item.count_commu_members})
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

            ({if $c_commu_user_list[0]})
            ({*１行目img*})
            <tr>

            ({t_loop from=$c_commu_user_list start=0 num=3})
            ({if $item})
                <td style="width:88px;" class="bg_03" align="center">
                ({if $item.c_member_id_admin == $c_member.c_member_id })<img src="({t_img_url_skin filename=icon_crown})" class="icon"><br>({/if})
                <a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$item.c_commu_id})">
                <img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_logo_small})" class="pict"></a>
                </td>
            ({else})
                <td style="width:88px;" class="bg_03"><img src="./skin/dummy.gif" style="width:84px;height:84px;" class="dummy"></td>
            ({/if})
            ({/t_loop})

            </tr>

            ({*１行目name*})
            <tr>
            ({t_loop from=$c_commu_user_list start=0 num=3})
            ({if $item})
                <td class="bg_02" align="center">
                <a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$item.c_commu_id})">
                ({$item.name|t_body:'name'}) (({$item.count_commu_members}))
                </a>
                </td>
            ({else})
                <td class="bg_02" align="center"><img src="./skin/dummy.gif" style="height:1em;" class="dummy"></td>
            ({/if})
            ({/t_loop})

        </tr>

        ({/if})
({*************************************************************})

    ({if $c_commu_user_list[3]})
        <!-- ２行目img -->
        <tr>
        ({t_loop from=$c_commu_user_list start=3 num=3})
        ({if $item})
            <td class="bg_03" align="center">
            ({if $item.c_member_id_admin == $c_member.c_member_id })<img src="({t_img_url_skin filename=icon_crown})" class="icon"><br>({/if})
                <a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$item.c_commu_id})">
                <img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_logo_small})" class="pict"></a>
            </td>
        ({else})
            <td class="bg_03"><img src="./skin/dummy.gif" style="width:84px;height:84px;" class="dummy"></td>
        ({/if})
        ({/t_loop})
        </tr>

        <!-- ２行目name -->
        <tr>

        ({t_loop from=$c_commu_user_list start=3 num=3})
        ({if $item})
            <td class="bg_02" align="center">
                <a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$item.c_commu_id})">
                ({$item.name|t_body:'name'}) (({$item.count_commu_members}))
                </a>
            </td>
        ({else})
            <td class="bg_02" align="center"><img src="./skin/dummy.gif" style="height:1em;" class="dummy"></td>
        ({/if})
        ({/t_loop})

        </tr>
    ({/if})

({*************************************************************})

    ({if $c_commu_user_list[6]})
        <!-- ３行目img -->
        <tr>

        ({t_loop from=$c_commu_user_list start=6 num=3})
        ({if $item})
            <td class="bg_03" align="center">
                ({if $item.c_member_id_admin == $c_member.c_member_id })<img src="({t_img_url_skin filename=icon_crown})" class="icon"><br>({/if})
                <a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$item.c_commu_id})">
                <img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_logo_small})" class="pict"></a>
            </td>
        ({else})
            <td class="bg_03"><img src="./skin/dummy.gif" style="width:84px;height:84px;" class="dummy"></td>
        ({/if})
        ({/t_loop})

        </tr>

        <!-- ３行目name -->
        <tr>

        ({t_loop from=$c_commu_user_list start=6 num=3})
        ({if $item})
            <td class="bg_02" align="center">
                <a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$item.c_commu_id})">
                ({$item.name|t_body:'name'}) (({$item.count_commu_members}))
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
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_fh_com_list})">全てを見る(({$fh_com_count_user}))</a>
        </div>
    </div>
</div>
({/if})

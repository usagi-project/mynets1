<!-- ここから：主内容＞＞日記一覧本体＞＞のループ部分 -->
({foreach from=$new_diary_list item=diary})
<div class="border_01 bg_09" style="width:562px;margin:0px auto;" align="center">
<img src="./skin/dummy.gif" class="v_spacer_m">
<table border="0" cellspacing="0" cellpadding="0" style="width:550px;margin:0px auto;">
    ({*********})
    <tr>
        <td style="width:550px;height:1px;" class="bg_01" colspan="7"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    ({*********})
    <tr>
        <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td style="width:90px;" class="bg_03" align="center" valign="middle" rowspan="9">

        <div class="padding_s">

        <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$diary.c_member_id})">
        <img src="({t_img_url filename=$diary.c_member.image_filename w=76 h=76 noimg=no_image_small})"></a>

        </div>
        </td>
        <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td style="width:85px;" class="bg_05" align="left" valign="middle">

        <div class="padding_s">

        名&nbsp;&nbsp;前

        </div>

        </td>
        <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td style="width:371px;" class="bg_02" align="left" valign="middle">

        <div class="padding_s">
        <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$diary.c_member_id})">
        ({$diary.c_member.nickname|t_body:'name'})</a>
        ({if $diary.c_member.profile.sex.value}) (({$diary.c_member.profile.sex.value}))({/if})

        </div>

        </td>
        <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    ({*********})
    <tr>
        <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td style="width:457px;" class="bg_01" align="center" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    ({*********})
    <tr>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_05" align="left" valign="middle">

        <div class="padding_s">

        タイトル

        </div>

        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_02" align="left" valign="middle">

        <div class="padding_s">
        <a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$diary.c_diary_id})&amp;c_diary_comment_count=({$diary.comment_count})">({$diary.subject|t_body:'title'})</a> (コメント:({$diary.comment_count}) | 閲覧:({$diary.etsuran_count}))
        </div>

        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
        ({*********})
    <tr>
        <td style="width:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td style="width:457px;" class="bg_01" align="center" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>

    ({*********})
    <tr>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_05" align="left" valign="middle">

        <div class="padding_s">

        タグ

        </div>

        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_02" align="left" valign="middle">

        <div class="padding_s">
        ({foreach from=$diary.tags_list item=item})
            ({$item.c_tags_name})
        ({/foreach})
        </div>

        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>

    ({*********})
    <tr>
        <td style="height:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td style="height:1px;" class="bg_01" align="center" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    ({*********})
    <tr>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_05" align="left" valign="middle">

        <div class="padding_s">

        本&nbsp;&nbsp;文

        </div>

        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_02" align="left" valign="middle">

        <div class="padding_s">
        ({*ませうさんBookさんの日記画像改造*})
        ({if $diary.image_filename_3})
        <DIV class="diary_list_all_imgbox">
        <a href="({t_img_url filename=$diary.image_filename_3})" class="thickbox" rel="gallery-plants({$diary.c_diary_id})" target="_blank">
        <img src="({t_img_url filename=$diary.image_filename_3 w=36 h=36})"></a>
        </DIV>
        ({/if})

        ({if $diary.image_filename_2})
        <DIV class="diary_list_all_imgbox">
        <a href="({t_img_url filename=$diary.image_filename_2})" class="thickbox" rel="gallery-plants({$diary.c_diary_id})" target="_blank">
        <img src="({t_img_url filename=$diary.image_filename_2 w=36 h=36})"></a>
        </DIV>
        ({/if})

        ({if $diary.image_filename_1})
        <DIV class="diary_list_all_imgbox">
        <a href="({t_img_url filename=$diary.image_filename_1})" class="thickbox" rel="gallery-plants({$diary.c_diary_id})" target="_blank">
        <img src="({t_img_url filename=$diary.image_filename_1 w=36 h=36})"></a>
        </DIV>
        ({/if})
        ({*ませうさんBookさんの日記画像改造*})
        ({$diary.body|t_truncate:80:"…"|t_body:'title'|bbcode2del})

        </div>

        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    ({*********})
    <tr>
        <td style="height:1px;" class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td style="height:1px;" class="bg_01" align="center" colspan="5"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    ({*********})
    <tr>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_05" align="left" valign="middle">

        <div class="padding_s">

        作成日時

        </div>

        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
        <td class="bg_02" align="center" valign="middle">

        <table border="0" cellspacing="0" cellpadding="0" style="width:371px;">
            <tr>
                <td style="width:169px;" class="bg_02" align="left">

                <div class="padding_s">

                ({$diary.r_datetime|date_format:"%m月%d日 %H:%M"})
                ({if $diary.view_flag})
                <img src="skin/default/img/new2.gif" align="absmiddle">
                ({/if})

                </div>

                </td>
                <td style="width:1px;" class="bg_01"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
                <td style="width:201px;" class="bg_03" align="center">

                <div class="padding_s">

                <a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$diary.c_diary_id})"><img src="({t_img_url_skin filename=button_shosai})" class="icon"></a>

                </div>

                </td>
            </tr>
        </table>

        </td>
        <td class="bg_01" align="center"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    ({*********})
    <tr>
        <td style="height:1px;" class="bg_01" colspan="7"><img src="./skin/dummy.gif" style="width:1px;height:1px;" class="dummy"></td>
    </tr>
    ({*********})
</table>
<img src="./skin/dummy.gif" class="v_spacer_m">
</div>

<img src="./skin/dummy.gif" class="v_spacer_l">
({/foreach})
<!-- ここまで：主内容＞＞日記一覧本体＞＞のループ部分 -->

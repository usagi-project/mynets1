<div class="border_07 bg_02" style="margin-bottom:5px;" id="item_3">
    <div style="padding:3px;margin:1px;" class="bg_06">
        <img src="({t_img_url_skin filename=icon_title_1})" style="cursor:pointer;" align="absmiddle" onClick="paneOnOff(3)" id="mkcnt3">
        <span style="cursor: move;" class="b_b c_00">({$WORD_MY_FRIEND})最新日記</span>
    </div>
    <div id="cnt3" style="display:none">
        ({foreach from=$c_diary_friend_list item=item})
        <div style="padding:5px 10px 0 10px">
            <img src="({t_img_url_skin filename=icon_1})" style="margin-right:5px;">
            ({$item.r_datetime|t_date})…&nbsp;
            <a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})&amp;c_diary_comment_count=({$item.comment_count})">({$item.subject|t_body:'title'|default:"&nbsp;"})</a>({if $item.public_flag == 'friend'})<img src="({t_img_url_skin filename=friend_icon f=gif})" align="absmiddle">({/if})&nbsp;
            ({if $item.view_flag})
            <img src="skin/default/img/new2.gif" align="absmiddle">
            ({/if})
            (コメント({$item.comment_count|default:0})&nbsp;閲覧:({$item.etsuran_count}))(({$item.nickname|t_body:'name'|default:"&nbsp;"}))({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})<img src="({t_img_url_skin filename=icon_camera})" class="icon">({/if})
        </div>
        ({/foreach})
        <div style="text-align:right;padding:5px;">
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_h_diary_list_friend})">もっと読む</a>
        </div>
    </div>
</div>

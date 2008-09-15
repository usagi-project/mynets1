<div class="border_07 bg_02" style="margin-bottom:5px;" id="item_8">
    <div style="padding:3px;margin:1px;" class="bg_06">
        <img src="({t_img_url_skin filename=icon_title_1})" style="cursor:pointer;" align="absmiddle" onClick="paneOnOff(8)" id="mkcnt8">
        <span style="cursor: move;" class="b_b c_00">お気に入りの最新日記</span>
    </div>
    <div id="cnt8" style="display:none">
        ({foreach from=$bookmark_diary_list item=item})
        <div style="padding:5px 10px 0 10px">
            <img src="({t_img_url_skin filename=icon_1})" style="margin-right:5px;" align="absmiddle">
            ({$item.r_datetime|t_date})…&nbsp;<a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})">({$item.subject|t_body:'title'|default:"&nbsp;"})</a>&nbsp;(コメント:({$item.comment_count})&nbsp;閲覧:({$item.etsuran_count}))(({$item.nickname|t_body:'name'}))({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})<img src="({t_img_url_skin filename=icon_camera})" class="icon">({/if})
        </div>
        ({/foreach})
        <div style="text-align:right;padding:5px;">
        <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_h_bookmark_diary_blog_list})">もっと読む</a>
        </div>
    </div>
</div>

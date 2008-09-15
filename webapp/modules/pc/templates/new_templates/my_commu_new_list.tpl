<div class="border_07 bg_02" style="margin-bottom:5px;" id="item_6">
    <div style="padding:3px;margin:1px;" class="bg_06">
        <img src="({t_img_url_skin filename=icon_title_1})" style="cursor:pointer;" align="absmiddle" onClick="paneOnOff(6)" id="mkcnt6">
        <span style="cursor: move;" class="b_b c_00">コミュニティ最新書き込み</span>
    </div>
    <div id="cnt6" style="display:none">
        ({foreach from=$c_commu_topic_comment_list item=item})
        <div style="padding:5px 10px 0 10px">
            <img src="({t_img_url_skin filename=icon_2})" style="margin-right:5px;" align="absmiddle">
            ({$item.e_datetime|t_date})…&nbsp;<a href="({t_url m=pc a=page_c_topic_detail})&amp;target_c_commu_topic_id=({$item.c_commu_topic_id})&amp;comment_count=({$item.number})">({$item.c_commu_topic_name|t_body:'title'}) (({$item.number}))</a>(({$item.c_commu_name|t_body:'title'}))({if $item.image_filename1 || $item.image_filename2 || $item.image_filename3})<img src="({t_img_url_skin filename=icon_camera})" class="icon">({/if})
        </div>
        ({/foreach})
        <div style="text-align:right;padding:5px;">
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_h_com_comment_list})">もっと読む</a>
        </div>
    </div>
</div>

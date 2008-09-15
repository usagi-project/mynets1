<div class="border_07 bg_02" style="margin-bottom:5px;" id="item_10">
    ({if $c_diary_list})
    <div style="padding:3px;margin:1px;" class="bg_06">
        <img src="({t_img_url_skin filename=icon_title_1})" style="cursor:pointer;" align="absmiddle" onClick="paneOnOff(10)" id="mkcnt10">
        <span style="cursor: move;" class="b_b c_00">マイ最新日記</span>
    </div>
    <div id="cnt10" style="display:none">
        ({foreach from=$c_diary_list item=item})
        <div style="padding:5px 10px 0 10px">
            <img src="({t_img_url_skin filename=icon_1})" style="margin-right:5px;" align="absmiddle">
            ({$item.r_datetime|t_date})…&nbsp;<a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})">({$item.subject|t_truncate:40|t_body:'title'})</a>({if $item.public_flag == 'friend'})<img src="({t_img_url_skin filename=friend_icon f=gif})" align="absmiddle">({/if})&nbsp;(コメント:({$item.comment_count}) 閲覧:({$item.etsuran_count}))&nbsp;({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})<img src="({t_img_url_skin filename=icon_camera})" class="icon">({/if})
        </div>
        ({/foreach})
        <div style="text-align:right;padding:5px;">
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_fh_diary_list})">もっと読む</a><br>
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_h_diary_add})">日記を書く</a>
        </div>
        ({if $c_blog_list})
        <div style="padding:5px 0 5px 31px;margin:1px;" class="bg_06">
            <span class="b_b c_00">マイ最新blog</span>
        </div>
        ({foreach from=$c_blog_list item=item})
        <div style="padding:5px 10px 0 10px">
            <img src="({t_img_url_skin filename=icon_2})" style="margin-right:5px;" align="absmiddle">
            ({$item.r_datetime|t_date})…&nbsp;<a href="({$item.link})" target="_blank">({$item.subject|t_truncate:40|t_body:'title'})</a>
        </div>
        ({/foreach})
        <div style="text-align:right;padding:5px;">
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_fh_diary_list})#blog">もっと読む</a>
        </div>
        ({/if})
        ({if $c_review_list})
        <div style="padding:5px 0 5px 31px;margin:1px;" class="bg_06">
            <span class="b_b c_00">マイ最新レビュー</span>
        </div>
        ({foreach from=$c_review_list item=item})
        <div style="padding:5px 10px 0 10px">
            <img src="({t_img_url_skin filename=icon_3})" style="margin-right:5px;" align="absmiddle">
            ({$item.r_datetime|t_date})…&nbsp;<a href="({t_url m=pc a=page_h_review_list_product})&amp;c_review_id=({$item.c_review_id})">({$item.title|t_truncate:40})</a>
        </div>
        ({/foreach})
        <div style="text-align:right;padding:5px;">
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_fh_review_list_member})">もっと読む</a><br>
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_h_review_add})">レビューを書く</a>
        </div>
        ({/if})
    </div>
    ({elseif $c_blog_list})
    <div style="padding:3px;margin:1px;" class="bg_06">
        <img src="({t_img_url_skin filename=icon_title_1})" style="cursor:pointer;" align="absmiddle" onClick="paneOnOff(8)" id="mkcnt8">
        <span style="cursor: move;" class="b_b c_00">マイ最新blog</span>
    </div>
    <div id="cnt8" style="display:none">
        ({foreach from=$c_blog_list item=item})
        <div style="padding:5px 10px 0 10px">
            <img src="({t_img_url_skin filename=icon_2})" style="margin-right:5px;" align="absmiddle">
            ({$item.r_datetime|t_date})…&nbsp;<a href="({$item.link})" target="_blank">({$item.subject|t_truncate:40|t_body:'title'})</a>
        </div>
        ({/foreach})
        <div style="text-align:right;padding:5px;">
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_fh_diary_list})#blog">もっと読む</a>
        </div>
        ({if $c_review_list})
        <div style="padding:5px 0 5px 31px;margin:1px;" class="bg_06">
            <span class="b_b c_00">マイ最新レビュー</span>
        </div>
        ({foreach from=$c_review_list item=item})
        <div style="padding:5px 10px 0 10px">
            <img src="({t_img_url_skin filename=icon_3})" style="margin-right:5px;" align="absmiddle">
            ({$item.r_datetime|t_date})…&nbsp;<a href="({t_url m=pc a=page_h_review_list_product})&amp;c_review_id=({$item.c_review_id})">({$item.title|t_truncate:40})</a>
        </div>
        ({/foreach})
        <div style="text-align:right;padding:5px;">
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_fh_review_list_member})">もっと読む</a><br>
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_h_review_add})">レビューを書く</a>
        </div>
        ({/if})
    </div>
    ({else})
    <div style="padding:3px;margin:1px;" class="bg_06">
        <img src="({t_img_url_skin filename=icon_title_1})" style="cursor:pointer;" align="absmiddle" onClick="paneOnOff(8)" id="mkcnt8">
        <span style="cursor: move;" class="b_b c_00">マイ最新レビュー</span>
    </div>
    <div id="cnt8" style="display:none">
        ({foreach from=$c_review_list item=item})
        <div style="padding:5px 10px 0 10px">
            <img src="({t_img_url_skin filename=icon_3})" style="margin-right:5px;" align="absmiddle">
            ({$item.r_datetime|t_date})…&nbsp;<a href="({t_url m=pc a=page_h_review_list_product})&amp;c_review_id=({$item.c_review_id})">({$item.title|t_truncate:40})</a>
        </div>
        ({/foreach})
        <div style="text-align:right;padding:5px;">
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_fh_review_list_member})">もっと読む</a><br>
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_h_review_add})">レビューを書く</a>
        </div>
    </div>
    ({/if})
</div>

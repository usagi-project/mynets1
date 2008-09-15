<div class="border_07 bg_02" style="margin-bottom:5px;" id="item_4">
    <div style="padding:3px;margin:1px;" class="bg_06">
        <img src="({t_img_url_skin filename=icon_title_1})" style="cursor:pointer;" align="absmiddle" onClick="paneOnOff(4)" id="mkcnt4">
        <span style="cursor: move;" class="b_b c_00">({$WORD_MY_FRIEND})最新Blog</span>
    </div>
    <div id="cnt4" style="display:none">
        ({foreach from=$c_rss_cache_list item=item})
        <div style="padding:5px 10px 0 10px">
            <img src="({t_img_url_skin filename=icon_1})" style="margin-right:5px;" align="absmiddle">
            ({$item.r_datetime|t_date})…&nbsp;<a href="({$item.link})" target="_blank">
            ({$item.subject|default:"&nbsp;"})</a>(({$item.c_member.nickname|t_body:'name'|default:"&nbsp;"}))
        </div>
        ({/foreach})
        <div style="text-align:right;padding:5px;">
            <img src="({t_img_url_skin filename=icon_arrow_1})" align="absmiddle">&nbsp;<a href="({t_url m=pc a=page_h_diary_list_friend})#blog">もっと読む</a>
        </div>
    </div>
</div>

({window2 id="whatsnew2" class="border_07" title="titlestyle2 bg_06" name="最新情報"})

({if $c_diary_friend_list})
<div class="whatsnew">
<table border="0" cellspacing="0" cellpadding="0"><tr><td class="whatsnewleft">
マイフレンド<br>最新日記
</td><td>
({foreach from=$c_diary_friend_list item=item})
<span class="icon_1">({$item.r_datetime|date_format:"%m月%d日"})<font size="3">...</font>&nbsp;<a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})&amp;comment_count=({$item.count_comments})">({$item.subject|t_body:'title'|default:"&nbsp;"}) (({$item.count_comments|default:0}))</a>
(({$item.nickname|t_body:'name'|default:"&nbsp;"}))
({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})<img src="({t_img_url_skin filename=icon_camera})">({/if})</span><br>
({/foreach})
<span class="iconArrow3">
<a href="({t_url m=pc a=page_h_diary_list_friend})">もっと読む</a>
</span>
</td></tr></table>
</div>
({/if})

({if $c_rss_cache_list})
<div class="whatsnew">
<table border="0" cellspacing="0" cellpadding="0"><tr><td class="whatsnewleft">
マイフレンド<br>最新Blog
</td><td>
({foreach from=$c_rss_cache_list item=item})
<span class="icon_1">({$item.r_datetime|date_format:"%m月%d日"})<font size="3">...</font>&nbsp;<a href="({$item.link})" target="_blank">({$item.subject|t_body:'title'|default:"&nbsp;"})</a>
(({$item.c_member.nickname|t_body:'name'|default:"&nbsp;"}))</span><br>
({/foreach})
<span class="iconArrow3"><a href="({t_url m=pc a=page_h_diary_list_friend})#blog">もっと読む</a></span>
</td></tr></table>
</div>
({/if})

({if $c_diary_my_comment_list})
<div class="whatsnew">
<table cellspacing="0" cellpadding="0"><tr><td class="whatsnewleft">
日記コメント<br>記入履歴
</td><td>
({foreach from=$c_diary_my_comment_list item=item})
<span class="icon_1">({$item.r_datetime|date_format:"%m月%d日"})<font size="3">...</font>&nbsp;<a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})&amp;comment_count=({$item.num_comment})">({$item.subject|t_body:'title'}) (({$item.num_comment}))</a>
(({$item.nickname|t_body:'name'}))</span><br>
({/foreach})
<span class="iconArrow3"><a href="({t_url m=pc a=page_h_diary_comment_list})">もっと読む</a></span>
</td></tr></table>
</div>
({/if})

({if $c_commu_topic_comment_list})
<div class="whatsnew">
<table cellspacing="0" cellpadding="0"><tr><td class="whatsnewleft">
コミュニティ<br>最新書き込み
</td><td>
({foreach from=$c_commu_topic_comment_list item=item})
<span class="icon_1">({$item.r_datetime|date_format:"%m月%d日"})<font size="3">...</font>&nbsp;<a href="({t_url m=pc a=page_c_topic_detail})&amp;target_c_commu_topic_id=({$item.c_commu_topic_id})&amp;comment_count=({$item.number})">({$item.c_commu_topic_name|t_body:'title'}) (({$item.number}))</a>
(({$item.c_commu_name|t_body:'name'}))
({if $item.image_filename1 || $item.image_filename2 || $item.image_filename3})<img src="({t_img_url_skin filename=icon_camera})" class="icon">({/if})</span><br>
({/foreach})
<span class="iconArrow3"><a href="({t_url m=pc a=page_h_com_comment_list})">もっと読む</a></span>
</td></tr></table>
</div>
({/if})

({if $c_friend_review_list})
<div class="whatsnew">
<table cellspacing="0" cellpadding="0"><tr><td class="whatsnewleft">
マイフレンド<br>最新レビュー
</td><td>
({foreach from=$c_friend_review_list item=item})
<span class="icon_1">({$item.r_datetime|date_format:"%m月%d日"})<font size="3">...</font>&nbsp;<a href="({t_url m=pc a=page_h_review_list_product})&amp;c_review_id=({$item.c_review_id})">({$item.title|t_truncate:30|t_body:'title'})</a>
(({$item.nickname|t_body:'name'}))</span><br>
({/foreach})
<span class="iconArrow3"><a href="({t_url m=pc a=page_h_friend_review_list})">もっと読む</a></span>
</td></tr></table></div>
({/if})

({if $bookmark_diary_list})
<div class="whatsnew">
<table cellspacing="0" cellpadding="0"><tr><td class="whatsnewleft">
お気に入り<br>最新日記
</td><td>
({foreach from=$bookmark_diary_list item=item})
<span class="icon_1">({$item.r_datetime|date_format:"%m月%d日"})<font size="3">...</font>&nbsp;<a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})&amp;comment_count=({$item.count_comments})">({$item.subject|t_body:'title'|default:"&nbsp;"}) (({$item.count_comments}))</a>
(({$item.nickname|t_body:'name'}))
({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})<img src="({t_img_url_skin filename=icon_camera})" class="icon">({/if})</span><br>
({/foreach})
<span class="iconArrow3"><a href="({t_url m=pc a=page_h_bookmark_diary_blog_list})">もっと読む</a></span>
</td></tr></table></div>
({/if})

({/window2})

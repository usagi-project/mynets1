({if $c_diary_list || $c_blog_list || $c_review_list})
({window2 id="newdiary2" class="border_07" title="titlestyle2 bg_06" name="最新日記"})

({if $c_diary_list})
<div class="whatsnew">
<table cellspacing="0" cellpadding="0"><tr><td class="whatsnewleft">
最新日記
</td><td>
({foreach from=$c_diary_list item=item})
<span class="icon_1">({$item.r_datetime|date_format:"%m月%d日"})<font size="3">...</font>&nbsp;<a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})&amp;comment_count=({$item.comment_count})">({$item.subject|t_truncate:40|t_body:'title'}) (({$item.comment_count}))</a>
({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})<img src="({t_img_url_skin filename=icon_camera})" class="icon">({/if})</span><br>
({/foreach})
<span class="iconArrow3"><a href="({t_url m=pc a=page_fh_diary_list})">もっと読む</a></span>
<span class="iconArrow3"><a href="({t_url m=pc a=page_h_diary_add})">日記を書く</a></span>
</td></tr></table></div>
({/if})

({if $c_blog_list})
<div class="whatsnew">
<table cellspacing="0" cellpadding="0"><tr><td class="whatsnewleft">
最新Blog
</td><td>
({foreach from=$c_blog_list item=item})
<span class="icon_1">({$item.r_datetime|date_format:"%m月%d日"})<font size="3">...</font>&nbsp;<a href="({$item.link})" target="_blank">({$item.subject|t_truncate:40|t_body:'title'})</a></span><br>
({/foreach})
<span class="iconArrow3"><a href="({t_url m=pc a=page_fh_diary_list})#blog">もっと読む</a></span>
</td></tr></table></div>
({/if})

({if $c_review_list})
<div class="whatsnew">
<table cellspacing="0" cellpadding="0"><tr><td class="whatsnewleft">
最新レビュー
</td><td>
({foreach from=$c_review_list item=item})
<span class="icon_1">({$item.r_datetime|date_format:"%m月%d日"})<font size="3">...</font>&nbsp;<a href="({t_url m=pc a=page_h_review_list_product})&amp;c_review_id=({$item.c_review_id})">({$item.title|t_truncate:30|t_body:'title'})</a></span><br>
({/foreach})
<span class="iconArrow3"><a href="({t_url m=pc a=page_fh_review_list_member})">もっと読む</a></span>
<span class="iconArrow3"><a href="({t_url m=pc a=page_h_review_add})">レビューを書く</a></span>
</td></tr></table></div>
({/if})

({/window2})
({/if})

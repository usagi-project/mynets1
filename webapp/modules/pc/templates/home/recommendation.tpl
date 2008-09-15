({window2 id="recommendation2" class="border_07" title="titlestyle2 bg_06" border="borderstyle2" name="紹介文を書く"})

({if $c_friend_intro_list})
({foreach from=$c_friend_intro_list item=item})
<div class="whatsnew">
<table cellspacing="0" cellpadding="0"><tr><td class="whatsnewleft">
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">
<img src="({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image})" border="0"><br>({$item.nickname|t_body:'name'})</a>
</td><td class="whatsnewright">
({$item.intro|t_truncate:"200"|t_body:'title'|nl2br})
</td></tr></table></div>
({/foreach})
({/if})
<span class="iconArrow4"><a href="({t_url m=pc a=page_fh_review_list_member})">全てを見る</a></span>
<span class="iconArrow4"><a href="({t_url m=pc a=page_h_review_add})">紹介文を書く</a></span>
({/window2})


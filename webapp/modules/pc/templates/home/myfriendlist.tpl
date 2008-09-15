({window id="myfriend" class="border_07" title="titlestyle1 bg_06" name="マイフレンドリスト"})

({if $smarty.const.OPENPNE_USE_FLASH_LIST})

({capture assign=flashvars})({strip})
({foreach from=$c_friend_list item=item key=key})
({if $key > 0})&({/if})
pne_item({$key+1})_id=({$item.c_member_id})
&pne_item({$key+1})_name=({$item.nickname|t_truncate:12:'..'|escape:'url'})
&pne_item({$key+1})_linkurl=({t_url m=pc a=page_f_home _urlencode=true _html=false})%26target_c_member_id=({$item.c_member_id})
&pne_item({$key+1})_imageurl=({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_image _urlencode=true _html=false})
&pne_item({$key+1})_count=({$item.friend_count})
({/foreach})
({/strip})({/capture})
<script type="text/javascript" src="js/show_flash.js"></script>
<script type="text/javascript">
<!--
show_flash('flash/list.swf', '({$flashvars})');
//-->
</script>

({else})
<div class="friendc">
({section name=id loop=$c_friend_list})
<span class="friend border_07 bg_05">
<div class="friendimg">
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$c_friend_list[id].c_member_id})">
<img src="({t_img_url filename=$c_friend_list[id].image_filename w=76 h=76 noimg=no_image})" class="pict"></a>
</div>
<div class="bg_05">
<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$c_friend_list[id].c_member_id})">
({$c_friend_list[id].nickname|t_truncate:11:'..'|t_body:'name'}) (({$c_friend_list[id].friend_count}))</a>
</div>
</span>
({/section})
</div>
({/if})
<br>
<div class="iconArrow1">
<a href="({t_url m=pc a=page_h_friend_list})">全てを見る(({$c_friend_count})人)</a>
</div>
<div class="iconArrow1">
<a href="({t_url m=pc a=page_h_manage_friend})">マイフレンド管理</a>
</div>

({/window})

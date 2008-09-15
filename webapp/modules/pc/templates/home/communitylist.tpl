({window id="communitylist" class="border_07" title="titlestyle1 bg_06" name="コミュニティリスト"})

({if $smarty.const.OPENPNE_USE_FLASH_LIST})
({capture assign=flashvars})({strip})
({foreach from=$c_commu_user_list item=item key=key})
({if $key > 0})&({/if})
pne_item({$key+1})_id=({$c_commu_user_list[id].c_commu_id})
&pne_item({$key+1})_name=({$item.name|t_truncate:12:'..'|escape:'url'})
&pne_item({$key+1})_linkurl=({t_url m=pc a=page_c_home _urlencode=true _html=false})%26target_c_commu_id=({$item.c_commu_id})
&pne_item({$key+1})_imageurl=({t_img_url filename=$item.image_filename w=76 h=76 noimg=no_logo_small _urlencode=true _html=false})
&pne_item({$key+1})_count=({$item.count_commu_members})
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
({section name=id loop=$c_commu_user_list})
<span class="commu border_07 bg_05">
<div class="commuimg">
({if $c_commu_user_list[id].c_member_id_admin == $c_member.c_member_id })<img src="({t_img_url_skin filename=icon_crown})" class="icon"><br>({/if})
<a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$c_commu_user_list[id].c_commu_id})">
<img src="({t_img_url filename=$c_commu_user_list[id].image_filename w=76 h=76 noimg=no_logo_small})" class="pict"></a>
</div>
<div class="bg_05">
<a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$c_commu_user_list[id].c_commu_id})">
({$c_commu_user_list[id].name|t_truncate:11:'..'|t_body:'name'}) (({$c_commu_user_list[id].count_commu_members}))</a>
</div>
</span>
({/section})
</div>
({/if})
<div class="iconArrow1">
<a href="({t_url m=pc a=page_h_com_list})">全てを見る(({$fh_com_count_user})人)</a>
</div>

({/window})

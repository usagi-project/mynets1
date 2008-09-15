({if $oneword_list_other})
({foreach from=$oneword_list_other item=item name=other})
<div style="padding:3px 5px;({if $smarty.foreach.other.last})({if $other_link})border-bottom:#cccccc 1px solid;({else})({/if})({else})border-bottom:#cccccc 1px dotted;({/if})" id="list_other_({$item.c_one_word_id})">
    <img src="({t_img_url_skin filename=icon_1})" style="margin-right:5px;">
    ({$item.r_datetime|t_date})…&nbsp;
    「({if $item.nickname_to})<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_to})" oneword='({$item.comment_to|replace:"&#039;":"\'"|t_body:'dengon'|default:"&nbsp;"})' class="oneword_bln">>>({$item.nickname_to|t_body:'name'|default:"&nbsp;"})</a>&nbsp;&nbsp;({/if})({$item.comment|t_body:'dengon'|default:"&nbsp;"})」
</div>
({/foreach})
({if $other_link})
<div style="text-align:right;padding:3px;">
    トータル数[({$other_total_num|default:0})]件&nbsp;&nbsp;({$other_link|smarty:nodefaults})
</div>
({/if})
({/if})

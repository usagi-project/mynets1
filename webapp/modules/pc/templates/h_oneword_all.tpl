({if $oneword_list_all})
<div id="all_current" style="display:none;">
max_oneword_id = ({if $max_oneword_id})({$max_oneword_id})({else})0({/if});
oneword2 = '({$oneword2|replace:"&#039;":"\'"|t_body:'dengon'|default:"&nbsp;"})';
all_page = ({$all_page});
</div>
({foreach from=$oneword_list_all item=item name=all})
<div style="padding:3px 5px;({if $smarty.foreach.all.last})({if $all_link})border-bottom:#cccccc 1px solid;({else})({/if})({else})border-bottom:#cccccc 1px dotted;({/if})" id="list_all_({$item.c_one_word_id})">
    <img src="({t_img_url_skin filename=icon_1})" style="margin-right:5px;">
    ({$item.r_datetime|t_date})…&nbsp;
    「({if $item.nickname_to})<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_to})" oneword='({$item.comment_to|replace:"&#039;":'&amp#039;'|t_body:'dengon'|default:"&nbsp;"})' class="oneword_bln">>>({$item.nickname_to|t_body:'name'|default:"&nbsp;"})</a>&nbsp;&nbsp;({/if})({$item.comment|t_body:'dengon'|default:"&nbsp;"})」&nbsp;
    （<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">({$item.nickname|t_body:'name'|default:"&nbsp;"})</a>）&nbsp;
    <a href="javascript:void(0);" onclick="comment_form(({$item.c_one_word_id}),this);return false;"><img src="skin/default/img/write_pen01.gif" align="absmiddle" alt="コメントする"></a>({if $c_member_id == $item.c_member_id})&nbsp;<a href="javascript:void(0);" onclick="oneword_del(({$item.c_one_word_id}));return false;">削除</a>({/if})
</div>
({/foreach})
({if $all_link})
<div style="text-align:right;padding:3px;">
    トータル数[({$all_total_num|default:0})]件&nbsp;&nbsp;({$all_link|smarty:nodefaults})
</div>
({/if})
({/if})

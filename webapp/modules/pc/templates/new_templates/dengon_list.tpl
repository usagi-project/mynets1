<style>
div{
    min-height:1%;
}
div:after{/*for modern browser*/
    content:".";
    display: block;
    height:0px;
    clear:both;
    visibility:hidden;
}
* html div{
    /*\*/height:1%;/*for WinIE*/
    display:inline-table;/*for MacIE*/
}
</style>
<div class="border_07 bg_02" style="margin-bottom:5px;" id="item_2">
    <div style="padding:3px;margin:1px;" class="bg_06">
        <img src="({t_img_url_skin filename=icon_title_1})" style="cursor:pointer;" align="absmiddle" onClick="paneOnOff(2)" id="mkcnt2">
        <span style="cursor: move;" class="b_b c_00">({$smarty.const.QUICK_SERVICE_NAME})</span>
    </div>
    <div id="cnt2" style="display:none;">
        <div style="padding:0 1px;">
    		<div style="height:25px;position:relative;overflow:hidden;background:url(./skin/default/img/bg_button.gif) left bottom repeat-x;">
    			<ul id="tabs">
    				<li>
    					<a href="#tab1">ひとこと（全体）</a>
    				</li>
    				<li>
    					<a href="#tab2">ひとこと（({$WORD_MY_FRIEND})まで）</a>
    				</li>
    				<li>
    					<a href="#tab3">MyBBS</a>
    				</li>
    			</ul>
    		</div>
    		<div class="panel" id="tab1">
    		    ({if $oneword_list_all})
    		    <script type="text/javascript">
    		    max_oneword_id = ({if $max_oneword_id})({$max_oneword_id})({else})0({/if});
    		    oneword2 = '({$oneword2|replace:"&#039;":"\'"|t_body:'dengon'|default:"&nbsp;"})';
                all_page = ({$all_page});
                </script>
                ({foreach from=$oneword_list_all item=item name=all})
                <div style="padding:3px 5px;({if $smarty.foreach.all.last})({if $all_link})border-bottom:#cccccc 1px solid;({else})({/if})({else})border-bottom:#cccccc 1px dotted;({/if})" id="list_all_({$item.c_one_word_id})">
                    <img src="({t_img_url_skin filename=icon_1})" style="margin-right:5px;">
                    ({$item.r_datetime|t_date})…&nbsp;
                    「({if $item.nickname_to})<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_to})" oneword='({$item.comment_to|replace:"&#039;":'&amp#039;'|t_body:'dengon'|default:"&nbsp;"})' class="oneword_bln">>>({$item.nickname_to|t_body:'name'|default:"&nbsp;"})</a>&nbsp;&nbsp;({/if})({$item.comment|t_body:'dengon'|default:"&nbsp;"})」&nbsp;
                    （<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">({$item.nickname|t_body:'name'|default:"&nbsp;"})</a>）&nbsp;
                    <a href="javascript:void(0);" onclick="comment_form(({$item.c_one_word_id}),this);return false;"><img src="skin/default/img/write_pen01.gif" align="absmiddle" alt="コメントする"></a>({if $c_member.c_member_id == $item.c_member_id})&nbsp;<a href="javascript:void(0);" onclick="oneword_del(({$item.c_one_word_id}));return false;">削除</a>({/if})
                </div>
                ({/foreach})
                ({if $all_link})
                <div style="text-align:right;padding:3px;">
                    トータル数[({$all_total_num|default:0})]件&nbsp;&nbsp;({$all_link|smarty:nodefaults})
                </div>
                ({/if})
                ({/if})
    		</div>
    		<div class="panel" id="tab2">
    		    ({if $oneword_list_friend})
    		    <script type="text/javascript">
                fri_page = ({$fri_page});
                </script>
                ({foreach from=$oneword_list_friend item=item name=fri})
                <div style="padding:3px 5px;({if $smarty.foreach.fri.last})({if $fri_link})border-bottom:#cccccc 1px solid;({else})({/if})({else})border-bottom:#cccccc 1px dotted;({/if})" id="list_friend_({$item.c_one_word_id})">
                    <img src="({t_img_url_skin filename=icon_1})" style="margin-right:5px;">
                    ({$item.r_datetime|t_date})…&nbsp;
                    「({if $item.nickname_to})<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_to})" oneword='({$item.comment_to|replace:"&#039;":'&amp#039;'|t_body:'dengon'|default:"&nbsp;"})' class="oneword_bln">>>({$item.nickname_to|t_body:'name'|default:"&nbsp;"})</a>&nbsp;&nbsp;({/if})({$item.comment|t_body:'dengon'|default:"&nbsp;"})」&nbsp;
                    （<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})">({$item.nickname|t_body:'name'|default:"&nbsp;"})</a>）&nbsp;
                    <a href="javascript:void(0);" onclick="comment_form(({$item.c_one_word_id}),this);return false;"><img src="skin/default/img/write_pen01.gif" align="absmiddle" alt="コメントする"></a>({if $c_member.c_member_id == $item.c_member_id})&nbsp;<a href="javascript:void(0);" onclick="oneword_del(({$item.c_one_word_id}));return false;">削除</a>({/if})
                </div>
                ({/foreach})
                ({if $fri_link})
                <div style="text-align:right;padding:3px;">
                    トータル数[({$fri_total_num|default:0})]件&nbsp;&nbsp;({$fri_link|smarty:nodefaults})
                </div>
                ({/if})
                ({/if})
    		</div>
    		<div class="panel" id="tab3">
    		    ({if $c_dengon_comment})
                ({foreach from=$c_dengon_comment item=item name=dengon})
                <div style="padding:3px 5px;border-bottom:#cccccc 1px ({if $smarty.foreach.dengon.last})solid;({else})dotted;({/if})">
                    <img src="({t_img_url_skin filename=icon_1})" style="margin-right:5px;">
                    ({$item.r_datetime|t_date})…&nbsp;
                    <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_from})">({$item.nickname|t_body:'name'|default:"&nbsp;"})</a>&nbsp;&nbsp;「({$item.body|strip|t_body:'dengon'|default:"&nbsp;"})」
                </div>
                ({/foreach})
                ({/if})
                <div style="text-align:right;padding:3px;">
                    <img src="./skin/dummy.gif" class="icon arrow_1">
                    <a href="({t_url m=pc a=page_fh_dengon})&amp;target_c_member_id=({$target_c_member_id})">もっと読む・入力</a>
                </div>
    		</div>
		</div>
    </div>
</div>

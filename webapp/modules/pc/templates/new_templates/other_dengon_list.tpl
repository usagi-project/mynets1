<script type="text/javascript" src="./js/javascripts/oneword.js"></script>
<script type="text/javascript" src="./js/javascripts/othertabs.js"></script>
<div class="border_07 bg_02" style="margin-bottom:5px;">
    <div style="padding:3px;margin:1px;" class="bg_06">
        <img src="({t_img_url_skin filename=content_header_1})"align="absmiddle">
        <span class="b_b c_00">({$smarty.const.QUICK_SERVICE_NAME})</span>
    </div>
    <div>
        <div style="padding:0 1px;">
    		<div style="height:25px;position:relative;overflow:hidden;background:url(./skin/default/img/bg_button.gif) left bottom repeat-x;">
    			<ul id="tabs">
    				<li>
    					<a href="#tab1">({$target_c_member.nickname|t_body:'name'})のひとこと</a>
    				</li>
    				<li>
    					<a href="#tab2">({$target_c_member.nickname|t_body:'name'})のBBS</a>
    				</li>
    			</ul>
    		</div>
    		<div class="panel" id="tab1">
    		    ({if $oneword_list_other})
                ({foreach from=$oneword_list_other item=item name=other})
                <div style="padding:3px 5px;({if $smarty.foreach.other.last})({if $other_link})border-bottom:#cccccc 1px solid;({else})({/if})({else})border-bottom:#cccccc 1px dotted;({/if})" id="list_other_({$item.c_one_word_id})">
                    <img src="({t_img_url_skin filename=icon_1})" style="margin-right:5px;">
                    ({$item.r_datetime|t_date})…&nbsp;
                    「({if $item.nickname_to})<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_to})" oneword='({$item.comment_to|replace:"&#039;":'&amp#039;'|t_body:'dengon'|default:"&nbsp;"})' class="oneword_bln">>>({$item.nickname_to|t_body:'name'|default:"&nbsp;"})</a>&nbsp;&nbsp;({/if})({$item.comment|t_body:'dengon'|default:"&nbsp;"})」
                </div>
                ({/foreach})
                ({if $other_link})
                <div style="text-align:right;padding:3px;">
                    トータル数[({$other_total_num|default:0})]件&nbsp;&nbsp;({$other_link|smarty:nodefaults})
                </div>
                ({/if})
                ({/if})
    		</div>
    		<div class="panel" id="tab2">
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
<!-- 今日のひとことふきだしアンカー -->
<span id="wedge"></span>
<script type="text/javascript">
    /*ひとことタブ初期化*/
    new Fabtabs('tabs', 'tab1');
    /*今日のひとこと初期化*/
    makeballoon();
</script>

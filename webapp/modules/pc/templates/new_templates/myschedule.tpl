<div class="border_07 bg_02" style="margin-bottom:5px;" id="item_1">
    <div style="padding:3px;margin:1px;" class="bg_06">
        <img src="({t_img_url_skin filename=icon_title_1})" style="cursor:pointer;" align="absmiddle" onClick="paneOnOff(1)" id="mkcnt1">
        <span style="cursor: move;" class="b_b c_00">スケジュール</span>
    </div>
    <div id="cnt1" style="display:none">
        ({t_form m=pc a=do_h_home_insert_c_schedule})
        <input type="hidden" name="sessid" value="({$PHPSESSID})">
        <input type="hidden" name="w" value="({$w})">

            ({if $msg})
            <div class="border_01 bg_02" style="border-top:none;border-left:none;border-right:none;">
            <div class="padding_s" align="left">
            <span class="caution">({$msg})</span>
            </div>
            </div>
            ({/if})
            <div class="bg_02 padding_s" align="left">
                予定 <input type="text" name="title" value="" size="24">
                <select name="start_date">
                ({foreach from=$calendar item=item})
                <option value="({$item.year})-({$item.month})-({$item.day})"({if $item.now}) selected="selected"({/if})>({$item.month})/({$item.day})(({$item.dayofweek}))</option>
                ({/foreach})
                </select>
                <input type="submit" class="submit" value="追加">
                &nbsp;
                <a href="({t_url m=pc a=page_h_home})&amp;w=({$w-1})" title="前の週">＜</a>
                <a href="({t_url m=pc a=page_h_home})" title="今週">■</a>
                <a href="({t_url m=pc a=page_h_home})&amp;w=({$w+1})" title="次の週">＞</a>
            </div>
            <table border="0" cellspacing="0" cellpadding="0" style="width:100%;">
                <tr>
                    ({foreach from=$calendar item=item name=calendar})
                    <td style="width:14%;({if $smarty.foreach.calendar.last})border-right:none;border-left:none;({else})border-left:none;({/if})" align="left" valign="top" class="border_01 bg_0({if $item.now})9({else})2({/if})({if $item.dayofweek == "日"}) c_02({elseif $item.dayofweek == "土"}) c_03({/if}) padding_s">
                        ({if $item.now})<span class="b_b">({/if})
                        ({if $smarty.foreach.calendar.first || $item.day == 1})
                        ({$item.month})/({/if})
                        ({$item.day})<br>
                        (({$item.dayofweek}))<br>
                        ({if $item.now})</span>({/if})
                        <div>
                            ({* 誕生日 *})
                            ({foreach from=$item.birth item=item_birth})
                            <img src="({t_img_url_skin filename=icon_birthday})" class="icon"><a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$item_birth.c_member_id})">({$item_birth.nickname|t_body:'name'})さん</a><br>
                            ({/foreach})
                            ({* イベント *})
                            ({foreach from=$item.event item=item_event})
                            <img src="({if $item_event.is_join})({t_img_url_skin filename=icon_event_R})({else})({t_img_url_skin filename=icon_event_B})({/if})" class="icon"><a href="({t_url m=pc a=page_c_event_detail})&amp;target_c_commu_topic_id=({$item_event.c_commu_topic_id})">({$item_event.name|t_truncate:36:".."|t_body:'name'})</a><br>
                            ({/foreach})
                            ({* スケジュール *})
                            ({foreach from=$item.schedule item=item_schedule})
                            <img src="({t_img_url_skin filename=icon_pen})" class="icon"><a href="({t_url m=pc a=page_h_schedule})&amp;target_c_schedule_id=({$item_schedule.c_schedule_id})">({$item_schedule.title|t_body:'title'})</a><br>
                            ({/foreach})
                        </div>
                    </td>
                    ({/foreach})
                </tr>
            </table>

            <div style="text-align:right;padding-right:20px;" class="bg_02 padding_s">
                <img src="./skin/dummy.gif" class="icon arrow_1">
                <a href="({t_url m=pc a=page_h_calendar})">月別カレンダー</a>
            </div>

        </form>
    </div>
</div>


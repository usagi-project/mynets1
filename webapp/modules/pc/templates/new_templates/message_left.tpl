<table border="0" cellspacing="0" cellpadding="0" style="width:165px;margin:0px auto;" class="border_07">
    <tr>
        <td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td style="width:151px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td class="bg_02" align="center">
        <table border="0" cellspacing="0" cellpadding="0" style="width:151px;">
            <tr>
            ({if $box != "inbox"})
                <td align="left" style="width:151px;padding:3px;" class="bg_02 border_10">
            ({else})
                <td align="left" style="width:151px;padding:3px;" class="bg_09 border_10">
            ({/if})
                <img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1"><a href="({t_url m=pc a=page_h_message_box})&amp;box=inbox">受信メッセージ</a>
                </td>
            </tr>
            <tr>
            ({if $box != "outbox"})
                <td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_02 border_10">
            ({else})
                <td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_09 border_10">
            ({/if})
                <img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1"><a href="({t_url m=pc a=page_h_message_box})&amp;box=outbox">送信済メッセージ</a>
                </td>
            </tr>
            <tr>
            ({if $box != "savebox"})
                <td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_02 border_10">
            ({else})
                <td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_09 border_10">
            ({/if})
                <img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1"><a href="({t_url m=pc a=page_h_message_box})&amp;box=savebox">下書き</a>
                </td>
            </tr>
            <tr>
            ({if $box != "trash"})
                <td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_02 border_10">
            ({else})
                <td align="left" style="width:151px;padding:3px;border-top:none;" class="bg_09 border_10">
            ({/if})
                <img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1"><a href="({t_url m=pc a=page_h_message_box})&amp;box=trash">ごみ箱</a>
                </td>
            </tr>
        </table>
        </td>
        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    </tr>
</table>
<img src="./skin/dummy.gif" class="v_spacer_l">
({$tomember|t_body:'name'})さんとのメール履歴
({*ここから、その人とのメッセージのやり取りがリスト表示されます。*})
<table border="0" cellspacing="0" cellpadding="0" style="width:165px;margin:0px auto;" class="border_07">
    <tr>
        <td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td style="width:151px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td style="width:7px;" class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td class="bg_02" align="center">
        <table border="0" cellspacing="0" cellpadding="0" style="width:151px;">
            ({foreach from=$message_list item=item})
            <tr>
                <td align="left" style="width:151px;padding:3px;" class="bg_09 border_10" colspan="2">
                <img src="./skin/dummy.gif" style="width:14px;height:14px;" class="icon icon_1">
                ({$item.r_datetime|date_format:"%Y/%m/%d-%H:%M"})<br>
                ({if $item.c_member_id_to !== $u})送→
                <a href="({t_url m=pc a=page_h_message})&amp;target_c_message_id=({$item.c_message_id})&amp;box=outbox">({$item.subject})</a>
                ({else})受←
                <a href="({t_url m=pc a=page_h_message})&amp;target_c_message_id=({$item.c_message_id})&amp;box=inbox&amp;jyusin_c_message_id=({$item.c_message_id})">({$item.subject})</a>
                ({/if})
                </td>
            </tr>
            ({/foreach})
            
            <tr>
            <td width="50%">
            ({if $is_prev})
                 <a href="({t_url m=pc a=page_h_message})&amp;target_c_message_id=({$c_message.c_message_id})&amp;page=({$page-1})">前へ</a>
            ({/if})
            </td>
            <td width="50%">
            ({if $is_next})
                <a href="({t_url m=pc a=page_h_message})&amp;target_c_message_id=({$c_message.c_message_id})&amp;page=({$page+1})">次へ</a>
            ({/if})
            </td>
            </tr>
            
        </table>
        </td>
        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td class="bg_10"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    </tr>
</table>
<img src="./skin/dummy.gif" class="v_spacer_l">

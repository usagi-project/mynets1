<!--　インフォメーション　＆　カレンダー　-->
<table border="0" cellspacing="0" cellpadding="0" style="width:720px;" class="info">
<tr>
<td style="width:5px;"><img src="./skin/dummy.gif" style="width:5px;height:1px;" class="dummy"></td>
<td style="width:715px;" valign="middle">

<!--ここから：運営者からのお知らせ-->
<table border="0" cellspacing="0" cellpadding="0" style="width:715px;" class="info_body">
<tr>
<td class="border_07 bg_11" style="width:105px;border-right:none;" align="center"><img src="({t_img_url_skin filename=icon_information})" alt="お知らせ"></td>
<td class="border_07 bg_02" style="width:610px;">

<table border="0" cellspacing="0" cellpadding="0" style="width:610px;">
<tr>
<td class="padding_s">

<div style="margin:2px 5px;padding:2px 5px;">({$site_info|smarty:nodefaults|default:"&nbsp;"})</div>

<div id="infoarea">
({if $info})
<div id="infolist">
    ({foreach from=$info item="info" key="key"})
    <div style="margin:2px 5px;padding:2px 5px;border-top:#cccccc 1px dotted;">
        <div id="sub_({$key})" style="padding:2px;">
            <img src="({t_img_url_skin filename=icon_2})" style="margin-right:5px;" align="absmiddle">&nbsp;({$info.r_datetime|date_format:"%Y年%m月%d日%H:%M"})&nbsp;&nbsp;<span style="font-weight:bold;">({$info.subject|t_body:'title'})</span>&nbsp;<a href="javascript:void(0);" onclick="infoOnOff(({$key}),({$info.c_admin_information_id}));return false;"><img src="({t_img_url_skin filename=icon_admin_info})" align="absmiddle" id="icon_({$key})"></a>
        </div>
        <div style="padding:5px;line-height:120%;display:none;" id="body_({$key})"></div>
    </div>
    ({/foreach})
</div>
({/if})
({if $page_link})
<div style="margin-top:2px;padding-top:3px;border-top:#cccccc 1px solid;text-align:right;">
    トータル数[({$total_num|default:0})]件&nbsp;&nbsp;({$page_link|smarty:nodefaults})
</div>
({/if})
</div>

</td>
</tr>
({if $num_f_confirm_list})
<tr>
<td class="padding_s">

★<span class="caution">承認待ちのメンバーが({$num_f_confirm_list})名います！</span>&nbsp;<a href="({t_url m=pc a=page_h_confirm_list})"><span class="b_b">承認・拒否</span></a>

</td>
</tr>
({/if})
({if $num_message_not_is_read})
<tr>
<td class="padding_s">

★<span class="caution">新着メッセージが({$num_message_not_is_read})件あります！</span>&nbsp;<a href="({t_url m=pc a=page_h_message_box})"><span class="b_b">メッセージを読む</span></a>

</td>
</tr>
({/if})
({if $num_diary_not_is_read})
<tr>
<td class="padding_s">

★<span class="caution">({$num_diary_not_is_read})件の日記に対して新着コメントがあります！</span>&nbsp;<a href="({t_url m=pc a=page_fh_diary})&amp;target_c_diary_id=({$first_diary_read})"><span class="caution">日記を見る</span></a>

</td>
</tr>
({/if})
({if $num_h_confirm_list})
<tr>
<td class="padding_s">

★<span class="caution">コミュニティ参加承認待ちのメンバーが({$num_h_confirm_list})名います！</span>&nbsp;<a href="({t_url m=pc a=page_h_confirm_list})"><span class="b_b">承認・拒否</span></a>

</td>
</tr>
({/if})
({if $anatani_c_commu_admin_confirm_list})
<tr>
<td class="padding_s">

★<span class="caution">コミュニティ管理人交代依頼が({$num_anatani_c_commu_admin_confirm_list})件きています。</span>&nbsp;<a href="({t_url m=pc a=page_h_confirm_list})"><span class="b_b">承認・拒否</span></a>

</td>
</tr>
({/if})
</table>

</td>
</tr>
</table>
<!--ここまで：運営者からのお知らせ-->

</td>
</tr>
</table>
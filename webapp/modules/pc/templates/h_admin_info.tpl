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

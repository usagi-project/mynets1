<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<style type="text/css">
img {
    border:none;
    padding:3px;
}
.clearfix:after {
    height: 0;
    visibility: hidden;
    content: ".";
    display: block;
    clear: both;
}
.clearfix{
  zoom:1;
}
</style>
</head>
<body>
<span id='business_name'><div style="text-align:left;"><span style='font-weight:bold;color:#FD766A;'>({if $target_topic.event_flag})■イベント({if $target_topic.number != 0})書き込み({/if})({else})■トピック({if $target_topic.number != 0})書き込み({/if})({/if})</span>&nbsp;({$target_topic.r_datetime|date_format:"%Y年%m月%d日%H:%M"})</div></span>
<div style="margin:5px;">
    <div style="margin:5px;" class="clearfix">
        <div style="width:90px;float:left;">
            <a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$target_topic.c_commu_id})" onclick="window.open('({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$target_topic.c_commu_id})'); return false;">
            <img src="({t_img_url filename=$target_topic.commu_image_filename w=76 h=76 noimg=no_image_small})">
            </a>
        </div>
        <div style="float:left;">
            <div style="font-size:14px;font-weight:bold;line-height:150%;">
                <a href="({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$target_topic.c_commu_id})" onclick="window.open('({t_url m=pc a=page_c_home})&amp;target_c_commu_id=({$target_topic.c_commu_id})'); return false;">({$target_topic.communame|t_body:'title'})</a> - ({$target_topic.topicname|t_body:'title'})(<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$target_topic.ownermemberid})" onclick="window.open('({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$target_topic.ownermemberid})'); return false;">({$target_topic.ownernickname|t_body:'name'})</a>さん作成)({if $target_topic.number != 0})への<br>
                <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$target_topic.c_member_id})" onclick="window.open('({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$target_topic.c_member_id})'); return false;">({$target_topic.nickname|t_body:'title'})</a>さんの書き込み({/if})&nbsp;<img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href="({$url})" onclick="window.open('({$url})'); return false;">書き込みをする</a>
            </div>
        </div>
    </div>
    <div style="margin:5px;padding:5px;clear:left;line-height:150%;font-size:12px;border-top:#cccccc 1px solid;">
    <div style="text-align:right;">
        <img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href='javascript:void(0);' onClick='map.getInfoWindow().restore();'>要約に戻る</a>
    </div>
({if $target_topic.image_filename1})
    <a href="({t_img_url filename=$target_topic.image_filename1})" onclick="window.open('({t_img_url filename=$target_topic.image_filename1})'); return false;">
        <img src="({t_img_url filename=$target_topic.image_filename1 w=120 h=120})">
    </a>
({/if})
({if $target_topic.image_filename2})
    <a href="({t_img_url filename=$target_topic.image_filename2})" onclick="window.open('({t_img_url filename=$target_topic.image_filename2})'); return false;">
        <img src="({t_img_url filename=$target_topic.image_filename2 w=120 h=120})">
    </a>
({/if})
({if $target_topic.image_filename3})
    <a href="({t_img_url filename=$target_topic.image_filename3})" onclick="window.open('({t_img_url filename=$target_topic.image_filename3})'); return false;">
        <img src="({t_img_url filename=$target_topic.image_filename3 w=120 h=120})">
    </a>
({/if})
        <br>
        ({$target_topic.body|bbcode2html|t_replace_d|t_body:'diary'|t_geocode})
    </div>
</div>
</body>
</html>

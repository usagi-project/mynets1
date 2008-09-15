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
<span id='business_name'><div style="text-align:left;"><span style='font-weight:bold;color:#60E060;'>■日記</span>&nbsp;({$target_diary.r_datetime|date_format:"%Y年%m月%d日%H:%M"})</div></span>
<div style="margin:5px;">
    <div style="margin:5px;" class="clearfix">
        <div style="width:90px;float:left;">
        <a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$target_diary.c_member_id})" onclick="window.open('({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$target_diary.c_member_id})'); return false;">
            <img src="({t_img_url filename=$target_diary.image_filename w=76 h=76 noimg=no_image_small})">
        </a>
        </div>
        <div style="float:left;">
            <div style="font-size:14px;font-weight:bold;line-height:150%;">
                ({$target_diary.subject|t_body:'title'})(<a href="({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$target_diary.c_member_id})" onclick="window.open('({t_url m=pc a=page_f_home})&amp;target_c_member_id=({$target_diary.c_member_id})'); return false;">({$target_diary.nickname|t_body:'name'})</a>さんの日記)&nbsp;<img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href="({$url})" onclick="window.open('({$url})'); return false;">コメントをする</a>
            </div>
        </div>
    </div>
    <div style="margin:5px;padding:5px;clear:left;line-height:150%;font-size:12px;border-top:#cccccc 1px solid;">
    <div style="text-align:right;">
        <img src='./skin/default/img/icon_arrow_1.gif' align='absmiddle'><a href='javascript:void(0);' onClick='map.getInfoWindow().restore();'>要約に戻る</a>
    </div>
({if $target_diary.image_filename_1})
    <a href="({t_img_url filename=$target_diary.image_filename_1})" onclick="window.open('({t_img_url filename=$target_diary.image_filename_1})'); return false;">
        <img src="({t_img_url filename=$target_diary.image_filename_1 w=120 h=120})">
    </a>
({/if})
({if $target_diary.image_filename_2})
    <a href="({t_img_url filename=$target_diary.image_filename_2})" onclick="window.open('({t_img_url filename=$target_diary.image_filename_2})'); return false;">
        <img src="({t_img_url filename=$target_diary.image_filename_2 w=120 h=120})">
    </a>
({/if})
({if $target_diary.image_filename_3})
    <a href="({t_img_url filename=$target_diary.image_filename_3})" onclick="window.open('({t_img_url filename=$target_diary.image_filename_3})'); return false;">
        <img src="({t_img_url filename=$target_diary.image_filename_3 w=120 h=120})">
    </a>
({/if})
        <br>
        ({$target_diary.body|bbcode2html|t_replace_d|t_body:'diary'|t_geocode})
    </div>
</div>
</body>
</html>

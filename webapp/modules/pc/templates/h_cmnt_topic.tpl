<div>
    <div>
        <b>({$target_topic.number})</b>&nbsp;&nbsp;
        ({$target_topic.r_datetime|date_format:"%Y年%m月%d日%H:%M"})&nbsp;&nbsp;
        <a href="#comment_entry" onclick="javascript:document.getElementsByName('body').item(0).value += '>>({$target_topic.number})&nbsp;({$target_topic.nickname|replace:"&#039;":"’"})さん\n';"><img src="skin/default/img/write_pen01.gif" align="absmiddle" alt="レスをつける"></a>
    </div>
    <div style="margin-top:5px;line-height:150%;font-size:12px;border-top:#cccccc 1px solid;">
    ({if $target_topic.image_filename1})
        <img src="({t_img_url filename=$target_topic.image_filename1 w=76 h=76})" style="padding:5px;">
    ({/if})
    ({if $target_topic.image_filename2})
        <img src="({t_img_url filename=$target_topic.image_filename2 w=76 h=76})" style="padding:5px;">
    ({/if})
    ({if $target_topic.image_filename3})
        <img src="({t_img_url filename=$target_topic.image_filename3 w=76 h=76})" style="padding:5px;">
    ({/if})
        <br>
        ({$target_topic.body|t_geocode|bbcode2html|t_replace_d|t_body:'admin_info'})
    </div>
</div>

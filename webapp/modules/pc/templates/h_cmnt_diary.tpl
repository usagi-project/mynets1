<div>
    <div>
        <b>({$target_diary_comment.comment_number})</b>&nbsp;&nbsp;
        ({$target_diary_comment.r_datetime|date_format:"%Y年%m月%d日%H:%M"})&nbsp;&nbsp;
        <a href="#comment_entry" onclick="javascript:document.getElementsByName('body').item(0).value += '>>({$target_diary_comment.comment_number})&nbsp;({$target_diary_comment.nickname|replace:"&#039;":"’"})さん\n';"><img src="skin/default/img/write_pen01.gif" align="absmiddle" alt="レスをつける"></a>
    </div>
    <div style="margin-top:5px;line-height:150%;font-size:12px;border-top:#cccccc 1px solid;">
    ({if $target_diary_comment.image_filename_1})
        <img src="({t_img_url filename=$target_diary_comment.image_filename_1 w=76 h=76})" style="padding:5px;">
    ({/if})
    ({if $target_diary_comment.image_filename_2})
        <img src="({t_img_url filename=$target_diary_comment.image_filename_2 w=76 h=76})" style="padding:5px;">
    ({/if})
    ({if $target_diary_comment.image_filename_3})
        <img src="({t_img_url filename=$target_diary_comment.image_filename_3 w=76 h=76})" style="padding:5px;">
    ({/if})
        <br>
        ({$target_diary_comment.body|t_geocode|bbcode2html|t_replace_d|t_body:'admin_info'})
    </div>
</div>

({$inc_ktai_header|smarty:nodefaults})

<center><font color="orange">({$target_c_member.nickname|t_body:'name'}) さんの日記リスト</font></center>
<hr><br>
({foreach from=$target_diary_list item=target_diary})
({$target_diary.r_date|date_format:"%y/%m/%d"})-<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$target_diary.c_diary_id})&amp;({$tail})">({$target_diary.subject|t_body:'title'})</a>
<div align="right">({if $target_diary.image_filename_1}) <img src="({t_img_url_skin filename=icon_camera})" class="icon">({/if})<font size="1" color="blue">(コメント:({$target_diary.comment_count}) 閲覧:({$target_diary.etsuran_count}))</font></div>
({/foreach})
({if $is_prev || $is_next})
<br>
({if $is_prev})<a href="({t_url m=ktai a=page_fh_diary_list})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;page=({$page-1})&amp;({$tail})">前へ</a> ({/if})
({if $is_next})<a href="({t_url m=ktai a=page_fh_diary_list})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;page=({$page+1})&amp;({$tail})">次へ</a>({/if})
({/if})
<hr>
({if $INC_NAVI_type=="h"})
<a href="({t_url m=ktai a=page_h_diary_edit})&amp;({$tail})">日記を書く</a><br>
({/if})
({if $INC_NAVI_type=="f"})
<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">({$target_c_member.nickname|t_body:'name'})さんのﾄｯﾌﾟ</a><br>
({/if})

({$inc_ktai_footer|smarty:nodefaults})
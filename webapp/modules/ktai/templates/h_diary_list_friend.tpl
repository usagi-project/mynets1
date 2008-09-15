({$inc_ktai_header|smarty:nodefaults})

({$WORD_FRIEND_HALF})最新日記<br>
<hr>

({foreach from=$h_diary_list_friend item=each_diary})
({$each_diary.r_datetime|t_date})(({$each_diary.c_member.nickname|t_truncate:36:""|t_body:'name'}))<br>
<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$each_diary.c_diary_id})&amp;c_diary_comment_count=({$each_diary.comment_count})&amp;({$tail})">({$each_diary.subject|t_body:'title'})</a>
({if $each_diary.view_flag})
<blink>&em_new;</blink>
({/if})
<div align="right"><font size="1" color="blue">(コメント:({$each_diary.comment_count})|閲覧:({$each_diary.etsuran_count}))</font>({if $each_diary.image_filename_1 || $each_diary.image_filename_2 || $each_diary.image_filename_3})&em_camera;({/if})</div>
({/foreach})

({if $is_prev || $is_next})
<br>
({if $is_prev})<a href="({t_url m=ktai a=page_h_diary_list_friend})&amp;page=({$page-1})&amp;({$tail})">前へ</a> ({/if})
({if $is_next})<a href="({t_url m=ktai a=page_h_diary_list_friend})&amp;page=({$page+1})&amp;({$tail})">次へ</a>({/if})

({/if})
<br>
<hr>

({$inc_ktai_footer|smarty:nodefaults})

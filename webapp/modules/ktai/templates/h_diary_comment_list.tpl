({$inc_ktai_header|smarty:nodefaults})

日記ｺﾒﾝﾄ記入履歴<br>
<hr>

({foreach from=$c_diary_my_comment_list item=each_diary})
({$each_diary.e_datetime|t_date})(({$each_diary.nickname|t_truncate:24:""|t_body:'name'}))<br>
<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$each_diary.c_diary_id})&amp;c_diary_comment_count=({$each_diary.comment_count})&amp;({$tail})">({$each_diary.subject|t_body:'title'})</a>
({if $each_diary.view_flag})
<blink>&em_new;</blink>
({/if})
({if $each_diary.edit_flag})
<blink>&em_memo;</blink>
({/if})
<div align="right"><font size="1" color="blue">(コメント:({$each_diary.comment_count})|閲覧:({$each_diary.etsuran_count}))</font></div>
({/foreach})

<br>
({strip})
({if $is_prev})<a href="({t_url m=ktai a=page_h_diary_comment_list})&amp;page=({$page})&amp;direc=-1&amp;({$tail})">前へ</a>&nbsp;({/if})
({if $is_next})<a href="({t_url m=ktai a=page_h_diary_comment_list})&amp;page=({$page})&amp;direc=1&amp;({$tail})">次へ</a>({/if})
({/strip})
<hr>

({$inc_ktai_footer|smarty:nodefaults})

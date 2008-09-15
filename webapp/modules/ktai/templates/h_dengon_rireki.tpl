({$inc_ktai_header|smarty:nodefaults})
<div id="top"></div>
<font size="1">
<center><font color="orange">({$c_member.nickname|t_body:'name'})さんの伝言板ｺﾒﾝﾄ履歴</font></center>
<hr>
■自分がつけたｺﾒﾝﾄ一覧<br>
全({$total_num})件中、({$pager.start})～({$pager.end})件目を表示しています<br>
({foreach from=$c_dengon_comment_list item=c_dengon_comment})
<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$c_dengon_comment.c_member_id_to})&amp;({$tail})">({$c_dengon_comment.nickname|t_body:'name'})</a>(({$c_dengon_comment.r_datetime|date_format:"%m/%d %H:%M"}))<br>
({$c_dengon_comment.body|t_body:'kdengon'|default:"&nbsp;"})<br>
<br>

({/foreach})

({if $is_prev || $is_next})
    ({if $is_prev})<a href="({t_url m=ktai a=page_h_dengon_rireki})&amp;page=({$page-1})&amp;({$tail})">前へ</a>({/if})
    ({if $is_next})<a href="({t_url m=ktai a=page_h_dengon_rireki})&amp;page=({$page+1})&amp;({$tail})">次へ</a>({/if})
({/if})
<hr>
<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$c_member.c_member_id})&amp;({$tail})">({$c_member.nickname|t_body:'name'})自分のプロフィールへ</a>
<hr>
({$inc_ktai_footer|smarty:nodefaults})


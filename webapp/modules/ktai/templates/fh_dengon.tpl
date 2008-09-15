({$inc_ktai_header|smarty:nodefaults})
<div id="top"></div>
<font size="1">
<center><font color="orange">({$target_dengon_writer|t_body:'name'})さんの伝言板</font></center>
<hr>
({if $c_siteadmin})
({$c_siteadmin|smarty:nodefaults})
<hr>
({/if})
■ｺﾒﾝﾄを書く
({t_form m=ktai a=do_fh_dengon_insert_c_dengon_comment})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_member_id_to" value="({$target_c_member_id_to})">
<font color=red>({if $msg})({$msg})<br>({/if})</font>
<textarea name="body"></textarea><br>
<input type="submit" value="書き込む">
</form>


({if $c_dengon_comment})
<hr>
■ｺﾒﾝﾄ<br>
全({$total_num})件中、({$pager.start})～({$pager.end})件目を表示しています<br>
({foreach from=$c_dengon_comment item=c_dengon_comment_})
({if $c_dengon_comment_.nickname})<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$c_dengon_comment_.c_member_id_from})&amp;({$tail})">({$c_dengon_comment_.nickname|t_body:'name'})</a>({/if}) ({if $c_dengon_comment_.c_member_id_from == $u || $target_c_member_id_to==$u})
[<a href="({t_url m=ktai a=page_fh_dengon_delete_c_dengon_comment_confirm})&amp;target_c_dengon_comment_id=({$c_dengon_comment_.c_dengon_comment_id})&amp;({$tail})&amp;target_c_member_id_to=({$target_c_member_id_to})">削除</a>]
({/if})<br>
({$c_dengon_comment_.body|t_body:'kdengon'|default:"&nbsp;"})<br>
({$c_dengon_comment_.r_datetime|date_format:"%m/%d %H:%M"})
<br><br>

({/foreach})

({if $is_prev || $is_next})
({if $is_prev})<a href="({t_url m=ktai a=page_fh_dengon})&amp;target_c_member_id_to=({$target_c_member_id_to})&amp;page=({$page-1})&amp;({$tail})">前へ</a> ({/if})
({if $is_next})<a href="({t_url m=ktai a=page_fh_dengon})&amp;target_c_member_id_to=({$target_c_member_id_to})&amp;page=({$page+1})&amp;({$tail})">次へ</a>({/if})
({/if})
<br>
({/if})
<hr>
<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$target_c_member_id_to})&amp;({$tail})">({$target_dengon_writer|t_body:'name'})さんのhomeへ</a>
</font><br>
({$inc_ktai_footer|smarty:nodefaults})


({$inc_ktai_header|smarty:nodefaults})

<div align="center"><font color="orange">({if $keyword})日記検索結果({else})最新日記({/if})</font></div>
<hr>

({if $keyword})
「<font color="orange">({$keyword})</font>」の検索結果(({$c_diary_search_list_count|default:"0"}))<br>
<br>
({/if})

({foreach from=$new_diary_list item=item})
({$item.r_datetime|t_date})(({$item.c_member.nickname|t_body:'name'}))<br>
<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})&amp;c_diary_comment_count=({$item.comment_count})&amp;({$tail})">({$item.subject|t_truncate:36:".."|t_body:'title'})</a><div align="right"><font size="1" color="blue">(コメント:({$item.comment_count})|閲覧:({$item.etsuran_count}))</font>({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})&em_camera;({/if})</div>
({/foreach})

({if $is_prev || $is_next})
({if $is_prev})
<a href="({t_url m=ktai a=page_h_diary_list_all})&amp;keyword=({$keyword|to_sjis|escape:"url"})&amp;page=({$page})&amp;direc=-1&amp;({$tail})">前へ</a>&nbsp;
({/if})
({if $is_next})
<a href="({t_url m=ktai a=page_h_diary_list_all})&amp;keyword=({$keyword|to_sjis|escape:"url"})&amp;page=({$page})&amp;direc=1&amp;({$tail})">次へ</a>
({/if})
({/if})
<br>
({if $c_diary_search_list_count})
({$pager.start})件～({$pager.end})件を表示<br>
({/if})

({t_form _method=get m=ktai a=page_h_diary_list_all})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="text" name="keyword" value="({$keyword})">
<input type="submit" value="検索">
</form>

<hr>
({if $keyword})<a href="({t_url m=ktai a=page_h_diary_list_all})&amp;({$tail})">最新日記</a><br>({/if})

({$inc_ktai_footer|smarty:nodefaults})
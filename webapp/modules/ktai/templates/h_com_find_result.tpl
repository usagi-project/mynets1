({$inc_ktai_header|smarty:nodefaults})

ｺﾐｭﾆﾃｨ検索結果<br>
<hr>
({if $search_word})
「({$search_word})」の検索結果<br>
({/if})
(({$count_total})件)<br>

({foreach from=$c_commu_search_result item=commu})
<a href="({t_url m=ktai a=page_c_home})&amp;target_c_commu_id=({$commu.c_commu_id})&amp;({$tail})">({$commu.name|t_body:'title'})</a>(({$commu.count_commu_member}))<br>
({/foreach})

({if $is_prev || $is_next})
<br>
({if $is_prev})<a href="({t_url m=ktai a=page_h_com_find_result})&amp;target_c_member_id=({$target_member.c_member_id})&amp;page=({$page-1})&amp;search_word=({$search_word|to_sjis|escape:"url"})&amp;target_c_commu_category_id=({$target_c_commu_category_id})&amp;({$tail})">前へ</a> ({/if})
({if $is_next})<a href="({t_url m=ktai a=page_h_com_find_result})&amp;target_c_member_id=({$target_member.c_member_id})&amp;page=({$page+1})&amp;search_word=({$search_word|to_sjis|escape:"url"})&amp;target_c_commu_category_id=({$target_c_commu_category_id})&amp;({$tail})">次へ</a>({/if})

({/if})

({t_form _method=get m=ktai a=page_h_com_find_result})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="text" name="search_word" value="({$search_word})">
<br>
<select name="target_c_commu_category_id">
<option value="all">すべてのｶﾃｺﾞﾘ</option>
({foreach from=$c_commu_category_list item=item})
<option value="({$item.c_commu_category_id})" ({if $target_c_commu_category_id==$item.c_commu_category_id})selected({/if})>({$item.name})
({/foreach})
</select>
<br>
<input type="submit" value="検索">
</form>
<hr>
<a href="({t_url m=ktai a=page_h_com_find_all})&amp;({$tail})">ｺﾐｭﾆﾃｨ検索に戻る</a><br>

({$inc_ktai_footer|smarty:nodefaults})
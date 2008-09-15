({$inc_header|smarty:nodefaults})

<h2>SNS管理：画像リスト・管理</h2>

<form action="./" method="get">
<input type="hidden" name="m" value="({$module_name})">
<input type="hidden" name="a" value="page_({$hash_tbl->hash('list_c_image')})">
表示件数：
<select name="page_size">
<option value="20"({if $pager.page_size==20}) selected="selected"({/if})>20件</option>
<option value="50"({if $pager.page_size==50}) selected="selected"({/if})>50件</option>
<option value="100"({if $pager.page_size==100}) selected="selected"({/if})>100件</option>
<option value="500"({if $pager.page_size==500}) selected="selected"({/if})>500件</option>
</select>
<input type="submit" class="submit" value="変更">
<div class="caution">※表示件数を多くすると処理が重くなり、サーバーに負荷がかかります。</div>
</form>

<!-- pager_begin -->
<div class="pager">
({$pager.total_num}) 件中 ({$pager.start_num}) - ({$pager.end_num})件目を表示しています
<br>
({if $pager.prev_page})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_image')})&amp;page=({$pager.prev_page})&amp;page_size=({$pager.page_size})">前へ</a>&nbsp;
({/if})
({foreach from=$pager.disp_pages item=i})
({if $i == $pager.page})
&nbsp;<strong>({$i})</strong>&nbsp;
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_image')})&amp;page=({$i})&amp;page_size=({$pager.page_size})">&nbsp;({$i})&nbsp;</a>
({/if})
({/foreach})
({if $pager.next_page})
&nbsp;<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_image')})&amp;page=({$pager.next_page})&amp;page_size=({$pager.page_size})">次へ</a>
({/if})
</div>
<!-- pager_end -->


<table>
({foreach name=c_image from=$c_image_list item=item})
({if $smarty.foreach.c_image.iteration % 5 == 1})<tr>({/if})

<td style="font-size:10pt">
({$item.r_datetime|date_format:"%Y/%m/%d %H:%M"})
<div style="width:120px; height:120px">
<a href="({t_img_url filename=$item.filename})" target="_blank"
><img src="({t_img_url filename=$item.filename w=120 h=120})"
></a></div>
({if $item.filename|t_substr:0:2 == 'd_'})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_diary_data')})&amp;target_c_diary_id=({$item.filename|t_imagefile2getid})">日記</a>
({elseif $item.filename|t_substr:0:2 === 'dc'})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_diary_comment_data')})&amp;target_c_diary_comment_id=({$item.filename|t_imagefile2getid})">日記コメント</a>
({elseif $item.filename|t_substr:0:2 === 'ms'})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_message_data')})&amp;target_c_message_id=({$item.filename|t_imagefile2getid})">メッセージ</a>
({elseif $item.filename|t_substr:0:2 === 't_'})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_topic_data')})&amp;target_c_commu_topic_id=({$item.filename|t_imagefile2getid})">トピック</a>
({elseif $item.filename|t_substr:0:3 === 'tc_'})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_topic_comment_data')})&amp;target_c_commu_topic_comment_id=({$item.filename|t_imagefile2getid})">トピックコメント</a>
({elseif $item.filename|t_substr:0:3 === 'e_'})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_topic_comment_data')})&amp;target_c_commu_topic_comment_id=({$item.filename|t_imagefile2getid})">トピックコメント</a>
({elseif $item.filename|t_substr:0:2 === 'c_'})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_commu_data')})&amp;target_c_commu_id=({$item.filename|t_imagefile2getid})">コミュニティ</a>
({elseif $item.filename|t_substr:0:2 === 'm_'})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$item.filename|t_imagefile2getid})">メンバープロフ</a>
({/if})
<br>
({$item.filename})<br>
投稿者[<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$item.c_member_id})">ID=({$item.c_member_id})&nbsp;({$item.nickname})</a>]<br>
({if strpos($item.filename, 'skin_') !== 0 && strpos($item.filename, 'no_') !== 0})
[<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('delete_c_image_confirm')})&amp;target_c_image_id=({$item.c_image_id})">削除</a>]
({/if})
</td>

({if $smarty.foreach.c_image.iteration % 5 == 0})</tr>({/if})
({/foreach})
</table>


<!-- pager_begin -->
<div class="pager">
({$pager.total_num}) 件中 ({$pager.start_num}) - ({$pager.end_num})件目を表示しています
<br>
({if $pager.prev_page})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_image')})&amp;page=({$pager.prev_page})&amp;page_size=({$pager.page_size})">前へ</a>&nbsp;
({/if})
({foreach from=$pager.disp_pages item=i})
({if $i == $pager.page})
&nbsp;<strong>({$i})</strong>&nbsp;
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_image')})&amp;page=({$i})&amp;page_size=({$pager.page_size})">&nbsp;({$i})&nbsp;</a>
({/if})
({/foreach})
({if $pager.next_page})
&nbsp;<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_image')})&amp;page=({$pager.next_page})&amp;page_size=({$pager.page_size})">次へ</a>
({/if})
</div>
<!-- pager_end -->

<hr>

<h3>画像管理</h3>
<p><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_image')})">画像管理ページへ</a></p>

({$inc_footer|smarty:nodefaults})
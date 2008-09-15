({$inc_header|smarty:nodefaults})

<h2>作成されたトピックを閲覧します。</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})
<!--  絞り込み条件の設定 -->
<div id="serch-box">
<form method="post" action="./">
<p>
新規登録順<input name="keyword" type="text" value="({$keyword})"><br>
</p>
<input type="submit" value="メッセージ検索">
<input type="hidden" name="m" value="({$module_name})">
<input type="hidden" name="a" value="page_({$hash_tbl->hash('ext_topic_check')})">
<input type="hidden" name="page" value="1">
</form>
</div>
<!--  絞り込み条件の設定 終了 -->

<!-- pager_begin -->
<div class="pager">
({$pager.total_num}) 件中 ({$pager.start_num}) - ({$pager.end_num})件目を表示しています
<br>
({if $pager.prev_page})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_topic_check')})&amp;page=({$pager.prev_page})&amp;page_size=({$pager.page_size})">前へ</a>&nbsp;
({/if})
({foreach from=$pager.disp_pages item=i})
({if $i == $pager.page})
&nbsp;<strong>({$i})</strong>&nbsp;
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_topic_check')})&amp;page=({$i})&amp;page_size=({$pager.page_size})">&nbsp;({$i})&nbsp;</a>
({/if})
({/foreach})
({if $pager.next_page})
&nbsp;<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_topic_check')})&amp;page=({$pager.next_page})&amp;page_size=({$pager.page_size})">次へ</a>
({/if})
</div>
<!-- pager_end -->

<div id="">
    <table>
        <thead>
        <tr>
            <th>トピックID</th>
            <th>作成日時</th>
            <th>作成者ID</th>
            <th>作成者名</th>
            <th>題名</th>
            <th>内容</th>
            <th>画像</th>
            <th>削除対象</th>
        </tr>
        </thead>
        <tbody>
        ({foreach from=$topic_list item=item})
        <tr>
            <td class="idnumber"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_topic_data')})&amp;target_c_commu_topic_id=({$item.c_commu_topic_id})">({$item.c_commu_topic_id})</a></td>
            <td>({$item.r_datetime})</td>
            <td class="idnumber"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$item.c_member_id})">({$item.c_member_id})</a></td>
            <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$item.c_member_id})">({$item.nickname|t_body:'name'})</a></td>
            <td style="width:150px"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_topic_data')})&amp;target_c_commu_topic_id=({$item.c_commu_topic_id})">({$item.name|t_body:'title'})</a></td>
            <td style="width:300px">({$item.body|t_truncate:"120"|t_url2a})</td>
            <td>({if $item.image_filename1})
          <a href="({t_img_url filename=$item.image_filename1})" target="_blank">
          <img src="({t_img_url filename=$item.image_filename1 w=76 h=76})"></a>
          ({/if})

          ({if $item.image_filename2})
          <a href="({t_img_url filename=$item.image_filename2})" target="_blank">
          <img src="({t_img_url filename=$item.image_filename2 w=36 h=36})"></a>
          ({/if})

          ({if $item.image_filename3})
          <a href="({t_img_url filename=$item.image_filename3})" target="_blank">
          <img src="({t_img_url filename=$item.image_filename3 w=36 h=36})"></a>
          ({/if})

          ({if $item.image_filename1||$item.image_filename2||$item.image_filename3})
          <br>
          ({/if})
          </td>
            <td></td>
        </tr>
        ({/foreach})
        </tbody>
    </table>
</div>

({$inc_footer|smarty:nodefaults})

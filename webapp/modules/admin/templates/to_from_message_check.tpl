({$inc_header|smarty:nodefaults})

<h2>投稿されたメッセージを閲覧します。</h2>
<div class="contents">

({if $msg})
    <p class="actionMsg">({$msg})</p>
({/if})
<!-- pager_begin -->
<div class="pager">
    ({$pager.total_num}) 件中 ({$pager.start_num}) - ({$pager.end_num})件目を表示しています
    <br>
    ({if $pager.prev_page})
        <a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('to_from_message_check')})&amp;page=({$pager.prev_page})&amp;page_size=({$pager.page_size})&amp;c_member_id_from=({$c_member_id_from})&amp;c_member_id_to=({$c_member_id_to})">前へ</a>&nbsp;
    ({/if})
    ({foreach from=$pager.disp_pages item=i})
        ({if $i == $pager.page})
            &nbsp;<strong>({$i})</strong>&nbsp;
        ({else})
            <a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('to_from_message_check')})&amp;page=({$i})&amp;page_size=({$pager.page_size})&amp;c_member_id_from=({$c_member_id_from})&amp;c_member_id_to=({$c_member_id_to})">&nbsp;({$i})&nbsp;</a>
        ({/if})
    ({/foreach})
    ({if $pager.next_page})
        &nbsp;<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('to_from_message_check')})&amp;page=({$pager.next_page})&amp;page_size=({$pager.page_size})&amp;c_member_id_from=({$c_member_id_from})&amp;c_member_id_to=({$c_member_id_to})">次へ</a>
    ({/if})
</div>
<!-- pager_end -->

<div id="">
    <table>
        <thead>
        <tr>
            <th>メッセージID</th>
            <th>投稿日時</th>
            <th>投稿者ID</th>
            <th>投稿者名</th>
            <th>受信者ID</th>
            <th>受信者名</th>
            <th>題名</th>
            <th>内容</th>
            <th>画像</th>
            <th>削除対象</th>
        </tr>
        </thead>
        <tbody>
        ({foreach from=$message_list item=item})
        <tr>
            <td class="idnumber"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_message_data')})&amp;target_c_message_id=({$item.c_message_id})">({$item.c_message_id})</a></td>
            <td>({$item.r_datetime})</td>
            <td class="idnumber"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_message_data')})&amp;target_c_message_id=({$item.c_message_id})">({$item.c_member_id_from})</a></td>
            <td>({$item.from_nickname})</td>
            <td class="idnumber"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_message_data')})&amp;target_c_message_id=({$item.c_message_id})">({$item.c_member_id_to})</a></td>
            <td>({$item.to_nickname})</td>
            <td style="width:150px"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_message_data')})&amp;target_c_message_id=({$item.c_message_id})">({$item.subject|t_body:'title'})</a></td>
            <td style="width:300px">({$item.body|t_truncate:"120"|t_url2a})</td>
            <td>({if $item.image_filename_1})
          <a href="({t_img_url filename=$item.image_filename_1})" target="_blank">
          <img src="({t_img_url filename=$item.image_filename_1 w=76 h=76})"></a>
          ({/if})

          ({if $item.image_filename_2})
          <a href="({t_img_url filename=$item.image_filename_2})" target="_blank">
          <img src="({t_img_url filename=$item.image_filename_2 w=36 h=36})"></a>
          ({/if})

          ({if $item.image_filename_3})
          <a href="({t_img_url filename=$item.image_filename_3})" target="_blank">
          <img src="({t_img_url filename=$item.image_filename_3 w=36 h=36})"></a>
          ({/if})

          ({if $item.image_filename_1||$item.image_filename_2||$item.image_filename_3})
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

({$inc_header|smarty:nodefaults})

<h2>サイトインフォメーション管理</h2>
<div class="contents">

({if $msg})
<p class="caution">({$msg})</p>
({/if})
<!--更新-->
<form action="./" method="post">
<input type="hidden" name="m" value="({$module_name})">
<input type="hidden" name="a" value="do_({$hash_tbl->hash('update_information_data','do')})">
<input type="hidden" name="sessid" value="({$PHPSESSID})">
<input type="hidden" name="info_id" value="({$information_data.c_admin_information_id})">
カテゴリ<br>
<input type="text" name="category" value="({$information_data.category})"><br>
題名<br>
<input type="text" name="subject" value="({$information_data.subject})"><br>
<br>
内容<br>
<textarea cols="60" rows="5" name="body">({$information_data.body})</textarea><br>
<br>
<select name="view_flag">
<option value="0" ({if $information_data.c_view_flag == 0}) selected="selected" ({/if})>表示する</option>
<option value="9" ({if $information_data.c_view_flag == 9}) selected="selected" ({/if})>表示しない</option>
</select>
<br><br>
<input type="submit" class="submit" value="更新する">
</form>
<!--更新終わり-->
<!-- pager_begin -->
<div class="pager">
({$pager.total_num}) 件中 ({$pager.start_num}) - ({$pager.end_num})件目を表示しています
<br>
({if $pager.prev_page})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_information_check')})&amp;page=({$pager.prev_page})&amp;page_size=({$pager.page_size})">前へ</a>&nbsp;
({/if})
({foreach from=$pager.disp_pages item=i})
({if $i == $pager.page})
&nbsp;<strong>({$i})</strong>&nbsp;
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_information_check')})&amp;page=({$i})&amp;page_size=({$pager.page_size})">&nbsp;({$i})&nbsp;</a>
({/if})
({/foreach})
({if $pager.next_page})
&nbsp;<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_information_check')})&amp;page=({$pager.next_page})&amp;page_size=({$pager.page_size})">次へ</a>
({/if})
</div>
<!-- pager_end -->

<div id="data-list">
    <table>
        <thead>
        <tr>
            <th>information ID</th>
            <th>投稿日時</th>
            <th>カテゴリ</th>
            <th>題名</th>
            <th style="width:300px">内容</th>
            <th>処理</th>
            <th>削除</th>
        </tr>
        </thead>
        <tbody>
        ({foreach from=$information_list item=item})
        <tr>
            <td class="idnumber">({$item.c_admin_information_id})</td>
            <td>({$item.r_datetime})</td>
            <td>({$item.category})</td>
            <td>({$item.subject})</td>
            <td style="width:300px">({$item.body})</td>
            <td>({if $item.c_view_flag == '0'})<a href="?m=({$module_name})&amp;a=do_({$hash_tbl->hash('update_information','do')})&amp;target_c_information_id=({$item.c_admin_information_id})&amp;flg=9&amp;sessid=({$PHPSESSID})">表示中</a>({else})<a href="?m=({$module_name})&amp;a=do_({$hash_tbl->hash('update_information','do')})&amp;target_c_information_id=({$item.c_admin_information_id})&amp;flg=0&amp;sessid=({$PHPSESSID})">非表示</a>({/if})</td>
            <td><a href="?m=({$module_name})&amp;a=do_({$hash_tbl->hash('delete_information','do')})&amp;target_c_information_id=({$item.c_admin_information_id})&amp;sessid=({$PHPSESSID})">削除する</a></td>
        </tr>
        ({/foreach})
        </tbody>
    </table>
</div>

({$inc_footer|smarty:nodefaults})

({$inc_header|smarty:nodefaults})

<h2>退会者データをCSVで出力します。</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})

<p class="caution">※ダウンロードしてもデータは削除されません。削除する場合はphpMyAdminでc_delete_member_dataを削除してください。</p>

<h3 class="item">ダウンロード</h3>
<p>退会したメンバー情報CSVをダウンロードします。</p>
<p class="textBtn"><input type="button" value="ダウンロード" onClick="location.href='?m=({$module_name})&a=do_({$hash_tbl->hash('csv_delete_member','do')})&sessid=({$PHPSESSID})'"></p>
<hr>
<!--  絞り込み条件の設定 -->
<div id="serch-box">
<form method="post" action="./">
<p>
新規登録順<input name="keyword" type="text" value="({$keyword})"><br>
</p>
<input type="submit" value="退会者検索"><br>
<strong>退会者のニックネームを前方一致で検索します</strong>
<input type="hidden" name="m" value="({$module_name})">
<input type="hidden" name="a" value="page_({$hash_tbl->hash('ext_db_check')})">
<input type="hidden" name="page" value="1">
</form>
</div>
<!--  絞り込み条件の設定 終了 -->

<!-- pager_begin -->
<div class="pager">
({$pager.total_num}) 件中 ({$pager.start_num}) - ({$pager.end_num})件目を表示しています
<br>
({if $pager.prev_page})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_db_check')})&amp;page=({$pager.prev_page})&amp;page_size=({$pager.page_size})">前へ</a>&nbsp;
({/if})
({foreach from=$pager.disp_pages item=i})
({if $i == $pager.page})
&nbsp;<strong>({$i})</strong>&nbsp;
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_db_check')})&amp;page=({$i})&amp;page_size=({$pager.page_size})">&nbsp;({$i})&nbsp;</a>&nbsp;
({/if})
({/foreach})
({if $pager.next_page})
&nbsp;<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_db_check')})&amp;page=({$pager.next_page})&amp;page_size=({$pager.page_size})">次へ</a>
({/if})
</div>
<!-- pager_end -->
<div>
    <table>
        <thead>
        <tr>
            <th>登録時id</th>
            <th>退会日時</th>
            <th>ニックネーム</th>
            <th>PCメール</th>
            <th>携帯メール</th>
            <th>登録時メール</th>
            <th>区分</th>
            <th>紹介者ID</th>
            <th>紹介者名</th>
            <!--<th>処理</th>-->
        </tr>
        </thead>
        <tbody>
        ({foreach from=$member_data item=item})
        <tr>
            <td class="idnumber"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_delete_member_data')})&amp;target_c_delete_member_data_id=({$item.c_delete_member_data_id})">({$item.c_member_id})</a></td>
            <td>({$item.delete_datetime})</td>
            <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_delete_member_data')})&amp;target_c_delete_member_data_id=({$item.c_delete_member_data_id})">({$item.nickname|t_body:'name'})</a></td>
            <td>({$item.pc_address})</td>
            <td>({$item.ktai_address})</td>
            <td>({$item.regist_address})</td>
            <td>({if $item.delete_flag == 0})自主退会({else})強制退会({/if})</td>
            <td class="idnumber"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$item.c_member_id_invite})">({$item.c_member_id_invite})</a></td>
            <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$item.c_member_id_invite})">({$item.owner_nickname})</a></td>
            <!--<td><input type="checkbox" name="delete_chk[]" value="({$item.c_delete_member_data_id})">&nbsp;&nbsp;削除する</td>-->
        </tr>
        ({/foreach})
        </tbody>
    </table>
</div>
({$inc_footer|smarty:nodefaults})

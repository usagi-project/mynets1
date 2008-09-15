({$inc_header|smarty:nodefaults})

<h2>問い合わせ・通報メッセージを閲覧します。</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})
<!--  絞り込み条件の設定 -->
<div id="serch-box">
<form method="post" action="./">
<p>
<label>全体<input name="sort_no" type="radio" value="0" ({if $sort_no == 0})checked({/if})></label>
<label>問い合わせ<input name="sort_no" type="radio" value="1" ({if $sort_no == 1})checked({/if})></label>
<label>通報<input name="sort_no" type="radio" value="2" ({if $sort_no == 2})checked({/if})></label>
</p>
<p>
新規登録順<input name="keyword" type="text" value="({$keyword})"><br>
</p>
<input type="submit" value="メッセージ検索">
<input type="hidden" name="m" value="({$module_name})">
<input type="hidden" name="a" value="page_({$hash_tbl->hash('ext_inquiry_check')})">
<input type="hidden" name="page" value="1">
</form>
</div>
<!--  絞り込み条件の設定 終了 -->
<!-- pager_begin -->
<div class="pager">
({$pager.total_num}) 件中 ({$pager.start_num}) - ({$pager.end_num})件目を表示しています
<br>
({if $pager.prev_page})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_inquiry_check')})&amp;page=({$pager.prev_page})&amp;page_size=({$pager.page_size})">前へ</a>&nbsp;
({/if})
({foreach from=$pager.disp_pages item=i})
({if $i == $pager.page})
&nbsp;<strong>({$i})</strong>&nbsp;
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_inquiry_check')})&amp;page=({$i})&amp;page_size=({$pager.page_size})">&nbsp;({$i})&nbsp;</a>
({/if})
({/foreach})
({if $pager.next_page})
&nbsp;<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_inquiry_check')})&amp;page=({$pager.next_page})&amp;page_size=({$pager.page_size})">次へ</a>
({/if})
</div>
<!-- pager_end -->

<div id="data-list">
    <table>
        <thead>
        <tr>
            <th>メッセージID</th>
            <th>投稿日時</th>
            <th>投稿者ID</th>
            <th>投稿者名</th>
            <th>カテゴリ</th>
            <th>内容</th>
            <th>対象データ</th>
            <th>対象データID</th>
            <th>処理</th>
        </tr>
        </thead>
        <tbody>
        ({foreach from=$message_list item=item})
        <tr>
            <td class="idnumber"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_inquiry_data')})&amp;target_c_inquiry_id=({$item.c_inquiry_id})">({$item.c_inquiry_id})</a></td>
            <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_inquiry_data')})&amp;target_c_inquiry_id=({$item.c_inquiry_id})">({$item.r_datetime})</a></td>
            <td class="idnumber"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$item.c_member_id})">({$item.c_member_id})</a></td>
            <td class="idnumber"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$item.c_member_id})">({$item.nickname|t_body:'name'})</a></td>
            <td>({$item.category_flag})&nbsp;({if $item.category_flag == 1})問い合わせ({elseif $item.category_flag == 2})<font color="red"><b>通報</b></font>({/if})</td>
            <td style="width:300px">({$item.body})</td>
            <td>({if $item.data_flag == 0})問い合わせデータ({elseif $item.data_flag == 1})日記コメントデータ({elseif $item.data_flag == 2})メッセージ({/if})</td>
            <td>
            ({if $item.data_flag == 0})
            ({elseif $item.data_flag == 2})
            <a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_message_data')})&amp;target_c_message_id=({$item.data_id})">({$item.data_id})</a>
            ({elseif $item.data_flag == 1})
            <a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_diary_comment_data')})&amp;target_c_diary_comment_id=({$item.data_id})">({$item.data_id})</a>
            ({/if})
            </td>
            
            
            
            <td>確認</td>
        </tr>
        ({/foreach})
        </tbody>
    </table>
</div>

({$inc_footer|smarty:nodefaults})

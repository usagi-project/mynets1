({$inc_header|smarty:nodefaults})

<h2>メンバーを閲覧します。</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})
<!--  メンバー絞り込み条件の設定 -->
<div id="serch-box">
<form method="post" action="./">
<p>
<label>新規登録順<input name="sort_no" type="radio" value="0" ({if $sort_no == 0})checked({/if})></label>
<label>最新ログイン順<input name="sort_no" type="radio" value="1" ({if $sort_no == 1})checked({/if})></label>
<label>ID1から<input name="sort_no" type="radio" value="9" ({if $sort_no == 9})checked({/if})></label>
</p>
<label>ニックネーム<input name="keyword" type="text" value="({$keyword})"></label>
<input type="submit" value="条件変更">
<input type="hidden" name="m" value="({$module_name})">
<input type="hidden" name="a" value="page_({$hash_tbl->hash('ext_member_check')})">
<input type="hidden" name="page" value="1">
</form>
</div>
<!--  メンバー絞り込み条件の設定 終了 -->
<!-- pager_begin -->
<div class="pager">
({$pager.total_num}) 件中 ({$pager.start_num}) - ({$pager.end_num})件目を表示しています
<br>
({if $pager.prev_page})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_member_check')})&amp;page=({$pager.prev_page})&amp;page_size=({$pager.page_size})&amp;sort_no=({$sort_no})">前へ</a>&nbsp;
({/if})
({foreach from=$pager.disp_pages item=i})
({if $i == $pager.page})
&nbsp;<strong>({$i})</strong>&nbsp;
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_member_check')})&amp;page=({$i})&amp;page_size=({$pager.page_size})&amp;sort_no=({$sort_no})">&nbsp;({$i})&nbsp;</a>
({/if})
({/foreach})
({if $pager.next_page})
&nbsp;<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_member_check')})&amp;page=({$pager.next_page})&amp;page_size=({$pager.page_size})&amp;sort_no=({$sort_no})">次へ</a>
({/if})
</div>
<!-- pager_end -->

<div id="data-view">
    <table>
        <thead>
        <tr>
            <th>c_member_id</th>
            <th>
            ({if $sort_no === 1})最新アクセス日時
            ({else})登録日時
            ({/if})
            </th>
            <th>ニックネーム</th>
            <th>紹介者ID</th>
            <th>紹介者ニックネーム</th>
            <th>登録時メール</th>
            <th>画像</th>
            <th>削除対象</th>
        </tr>
        </thead>
        <tbody>
        ({foreach from=$member_list item=item})
        <tr>
            <td class="idnumber"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$item.c_member_id})">({$item.c_member_id})</a></td>
            <td>
            ({if $sort_no === 1})({$item.access_date})
            ({else})({$item.r_date})
            ({/if})
            </td>
            <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$item.c_member_id})">({$item.nickname|t_body:'name'})</a></td>
            <td class="idnumber"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$item.c_member_id_invite})">({$item.c_member_id_invite})</a></td>
            
            <td style="width:150px"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$item.c_member_id_invite})">({$item.owner_nickname|t_body:'name'})</a></td>
            <td style="width:300px">({$item.regist_address})</td>
            <td>({if $item.image_filename})
          <a href="({t_img_url filename=$item.image_filename})" target="_blank">
          <img src="({t_img_url filename=$item.image_filename w=76 h=76})"></a>
          ({/if})</td>
            <td></td>
        </tr>
        
        ({/foreach})
        </tbody>
    </table>
    
</div>

({$inc_footer|smarty:nodefaults})

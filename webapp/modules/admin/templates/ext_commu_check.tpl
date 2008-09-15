({$inc_header|smarty:nodefaults})

<h2>作成されたコミュニティを閲覧します。</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})
<!-- pager_begin -->
<div class="pager">
({$pager.total_num}) 件中 ({$pager.start_num}) - ({$pager.end_num})件目を表示しています
<br>
({if $pager.prev_page})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_commu_check')})&amp;page=({$pager.prev_page})&amp;page_size=({$pager.page_size})">前へ</a>&nbsp;
({/if})
({foreach from=$pager.disp_pages item=i})
({if $i == $pager.page})
&nbsp;<strong>({$i})</strong>&nbsp;
({else})
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_commu_check')})&amp;page=({$i})&amp;page_size=({$pager.page_size})">&nbsp;({$i})&nbsp;</a>
({/if})
({/foreach})
({if $pager.next_page})
&nbsp;<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_commu_check')})&amp;page=({$pager.next_page})&amp;page_size=({$pager.page_size})">次へ</a>
({/if})
</div>
<!-- pager_end -->

<div id="">
    <table>
        <thead>
        <tr>
            <th>コミュニティID</th>
            <th>作成日時</th>
            <th>作成者ID</th>
            <th>作成者名</th>
            <th>題名</th>
            <th>内容</th>
            <th>公開状況</th>
            <th>画像</th>
            <th>削除対象</th>
        </tr>
        </thead>
        <tbody>
        ({foreach from=$commu_list item=item})
        <tr>
            <td class="idnumber"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_commu_data')})&amp;target_c_commu_id=({$item.c_commu_id})">({$item.c_commu_id})</a></td>
            <td>({$item.r_datetime})</td>
            <td class="idnumber"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$item.c_member_id_admin})">({$item.c_member_id_admin})</a></td>
            <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$item.c_member_id_admin})">({$item.nickname|t_body:'name'})</a></td>
            <td style="width:150px"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_commu_data')})&amp;target_c_commu_id=({$item.c_commu_id})">({$item.name|t_body:'title'})</a></td>
            <td style="width:300px">({$item.info|t_truncate:"120"|t_url2a})</td>
            <td>
            ({if $item.public_flag == 'public'})
            SNSで公開（だれでも自由に参加できる）
            ({elseif $item.public_flag == 'auth_sns'})
            管理人の承認が必要(公開)
            ({elseif $item.public_flag == 'auth_commu_member'})
            管理人の承認が必要(非公開)
            ({elseif $item.public_flag == 'auth_public'})
            外部へ公開（公開掲示板）
            ({/if})
            </td>
            <td>({if $item.image_filename})
          <a href="({t_img_url filename=$item.image_filename})" target="_blank">
          <img src="({t_img_url filename=$item.image_filename w=76 h=76})"></a>
          ({/if})
          </td>
            <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('del_commu_confirm')})&amp;target_c_commu_id=({$item.c_commu_id})">削除する</a></td>
        </tr>
        ({/foreach})
        </tbody>
    </table>
</div>

({$inc_footer|smarty:nodefaults})

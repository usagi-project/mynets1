({$inc_header|smarty:nodefaults})

<h2>コミュニティを削除</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({else})

<div id="dataview">
<table style="width: 680px">
    <tr>
        <td style="width:180px" class="dataview">c_commu_id</td>
        <td style="width:500px">({$commu_data.c_commu_id})</td>
    </tr>
    <tr>
        <td class="dataview">作成日時</td>
        <td>({$commu_data.r_datetime})</td>
    </tr>
    <tr>
        <td class="dataview">作成者名（ID）</td>
        <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$commu_data.c_member_id_admin})">({$commu_data.nickname|t_body:'name'})</a>(id:({$commu_data.c_member_id_admin}))</td>
    </tr>
    <tr>
        <td class="dataview">内容</td>
        <td>({$commu_data.info|t_body:'diary'})</td>
    </tr>
    <tr>
        <td class="dataview">参加人数</td>
        <td>({$commu_data.member_num})</td>
    </tr>
    <tr>
        <td class="dataview">画像</td>
        <td>({if $commu_data.image_filename})<a href="({t_img_url filename=$commu_data.image_filename})" target="_blank">
          <img src="({t_img_url filename=$commu_data.image_filename w=120 h=120})"></a>&nbsp;({/if})
        </td>
    </tr>
    <tr>
        <td class="dataview">処理</td>
        <td><form method="post" action="./">
        <input type="hidden" name="m" value="({$module_name})">
        <input type="hidden" name="a" value="do_({$hash_tbl->hash('del_commu_confirm')})">
        <input type="hidden" name="target_c_commu_id" value="({$commu_data.c_commu_id})">
        <input type="hidden" name="sessid" value="({$PHPSESSID})">
        <input type="submit" value="削除する"></form></td>
    </tr>
</table>
</div>
({/if})
({$inc_footer|smarty:nodefaults})

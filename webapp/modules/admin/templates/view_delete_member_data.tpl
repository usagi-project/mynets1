({$inc_header|smarty:nodefaults})

<div class="contents">
({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})
<h2>Member</h2>
<table style="width: 680px">
    <tr>
        <th style="width:110px" class="style1"><strong>退会時会員ID</strong></th>
        <td style="width:230px" class="style2">({$member_data.c_member_id})</td>
        <th style="width:110px" class="style1"><strong>退会日時</strong></th>
        <td style="width:230px" class="style2">({$member_data.delete_datetime})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>ニックネーム</strong></th>
        <td style="width:230px" class="style2">({$member_data.nickname|t_body:'name'})</td>
        <th style="width:110px" class="style1"><strong>登録日時</strong></th>
        <td style="width:230px" class="style2">({$member_data.regist_datetime})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>PCアドレス</strong></th>
        <td class="style2" colspan="3">({$member_data.pc_address})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>携帯アドレス</strong></th>
        <td class="style2" colspan="3">({$member_data.ktai_address})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>登録時アドレス</strong></th>
        <td class="style2" colspan="3">({$member_data.regist_address})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>ユーザーエージェント</strong></th>
        <td class="style2" colspan="3">({$member_data.user_agent})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>IPアドレス</strong></th>
        <td class="style2" colspan="3">({$member_data.ip_address})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>退会時コメント</strong></th>
        <td class="style2" colspan="3">({$member_data.delete_comment})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>退会状況</strong></th>
        <td style="width:230px" class="style2">
        ({if $member_data.delete_flag == 0})
        自主退会
        ({else})
        強制退会
        ({/if})
        </td>
        <th style="width:110px" class="style1"><strong>紹介者</strong></th>
        <td style="width:230px" class="style2">id:<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$member_data.c_member_id_invite})">({$member_data.c_member_id_invite})</a>&nbsp;&nbsp;
        <a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$member_data.c_member_id_invite})">({$owner_nickname|t_body:'name'})</a></td>
    </tr>
</table>
<br>
<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_db_check')})">退会者一覧へ</a>
</div>
({$inc_footer|smarty:nodefaults})

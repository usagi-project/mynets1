({$inc_header|smarty:nodefaults})

<h2>投稿されたメッセージを閲覧します。</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})

<div id="dataview">
<table style="width: 680px">
    <tr>
        <td style="width:180px" class="dataview">c_message_id</td>
        <td style="width:500px">({$message_data.c_message_id})</td>
    </tr>
    <tr>
        <td class="dataview">投稿日時</td>
        <td>({$message_data.r_datetime})</td>
    </tr>
    <tr>
        <td class="dataview">投稿者名（ID）</td>
        <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$message_data.c_member_id_from})">({$message_data.from_nickname|t_body:'name'})</a>&nbsp;(id:({$message_data.c_member_id_from}))</td>
    </tr>
    <tr>
        <td class="dataview">受信者名（ID）</td>
        <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$message_data.c_member_id_to})">({$message_data.to_nickname|t_body:'name'})</a>&nbsp;(id:({$message_data.c_member_id_to}))</td>
    </tr>
    <tr>
        <td class="dataview">題名</td>
        <td>({$message_data.subject|t_body:'title'})</td>
    </tr>
    <tr>
        <td class="dataview">内容</td>
        <td>({$message_data.body|t_body:'diary'})</td>
    </tr>
    <tr>
        <td class="dataview">画像</td>
        <td>({if $message_data.image_filename_1})<a href="({t_img_url filename=$message_data.image_filename_1})" target="_blank">
          <img src="({t_img_url filename=$message_data.image_filename_1 w=120 h=120})"></a>&nbsp;({/if})
        ({if $message_data.image_filename_2})<a href="({t_img_url filename=$message_data.image_filename_2})" target="_blank">
          <img src="({t_img_url filename=$message_data.image_filename_2 w=120 h=120})"></a>&nbsp;({/if})
        ({if $message_data.image_filename_3})<a href="({t_img_url filename=$message_data.image_filename_3})" target="_blank">
          <img src="({t_img_url filename=$message_data.image_filename_3 w=120 h=120})"></a>({/if})
        </td>
    </tr>
    <tr>
        <td class="dataview">処理</td>
        <td>&nbsp;</td>
    </tr>
</table>
<br>
<ul>
    <li><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('to_from_message_check')})&amp;c_member_id_from=({$message_data.c_member_id_from})&amp;c_member_id_to=({$message_data.c_member_id_to})">送信者・受信者でのメッセージ送信履歴</a></li>
    <li>一覧へ戻る</li>
</ul>
</div>

({$inc_footer|smarty:nodefaults})

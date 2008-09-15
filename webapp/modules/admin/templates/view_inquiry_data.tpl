({$inc_header|smarty:nodefaults})

<h2>投稿されたメッセージを閲覧します。</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})

<div id="dataview">
<table style="width: 680px">
    <tr>
        <td style="width:180px" class="dataview">c_inquiry_id</td>
        <td style="width:500px">({$message_data.c_inquiry_id})</td>
    </tr>
    <tr>
        <td class="dataview">投稿日時</td>
        <td>({$message_data.r_datetime})</td>
    </tr>
    <tr>
        <td class="dataview">投稿者名（ID）</td>
        <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$message_data.c_member_id})">({$message_data.nickname|t_body:'name'})</a>&nbsp;(id:({$message_data.c_member_id}))</td>
    </tr>
    <tr>
        <td class="dataview">カテゴリ</td>
        <td>({$message_data.category_flag})&nbsp;({if $message_data.category_flag == 1})問い合わせ({elseif $message_data.category_flag == 2})通報({/if})</td>
    </tr>
    <tr>
        <td class="dataview">内容</td>
        <td>({$message_data.body|t_body:'diary'})</td>
    </tr>
    <tr>
        <td class="dataview">データ区分</td>
        <td>({if $message_data.category_flag == 1})問い合わせデータ({elseif $message_data.category_flag == 2})メッセージ({/if})</td>
    </tr>
    <tr>
        <td class="dataview">データID</td>
        <td>({if $message_data.data_flag == 2})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_message_data')})&amp;target_c_message_id=({$message_data.data_id})">({$message_data.data_id})：&nbsp;メッセージ確認({/if})</a></td>
    </tr>
    <tr>
        <td class="dataview">処理</td>
        <td></td>
    </tr>
</table>
<br>
</div>

({$inc_footer|smarty:nodefaults})

({$inc_header|smarty:nodefaults})

<h2>作成されたトピックを閲覧します。</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})

<div id="dataview">
<table style="width: 680px">
    <tr>
        <td style="width:180px" class="dataview">c_commu_topic_id</td>
        <td style="width:500px">({$topic_comment_data.c_commu_topic_id})</td>
    </tr>
    <tr>
        <td class="dataview">作成日時</td>
        <td>({$topic_comment_data.r_datetime})</td>
    </tr>
    <tr>
        <td class="dataview">作成者名（ID）</td>
        <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$topic_comment_data.c_member_id})">({$topic_comment_data.nickname|t_body:'name'})</a>(id:({$topic_comment_data.c_member_id}))</td>
    </tr>
    <tr>
        <td class="dataview">トピック・イベント</td>
        <td>({if $topic_comment_data.event_flag == 1})イベント
        ({else})
        トピック
        ({/if})
        </td>
    </tr>
    <tr>
        <td class="dataview">内容</td>
        <td>({$topic_comment_data.body|t_body:'diary'})</td>
    </tr>
    <tr>
        <td class="dataview">トピック名</td>
        <td>({$topic_comment_data.name})</td>
    </tr>
    <tr>
        <td class="dataview">コミュニティ名</td>
        <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_commu_data')})&amp;target_c_commu_id=({$topic_comment_data.c_commu_id})">({$topic_comment_data.communame})</a>/c_commu_id：({$topic_comment_data.c_commu_id})</td>
    </tr>
    <tr>
        <td class="dataview">画像</td>
        <td>({if $topic_comment_data.image_filename1})<a href="({t_img_url filename=$topic_comment_data.image_filename1})" target="_blank">
          <img src="({t_img_url filename=$topic_comment_data.image_filename1 w=120 h=120})"></a>&nbsp;({/if})
        ({if $topic_comment_data.image_filename2})<a href="({t_img_url filename=$topic_comment_data.image_filename2})" target="_blank">
          <img src="({t_img_url filename=$topic_comment_data.image_filename2 w=120 h=120})"></a>&nbsp;({/if})
        ({if $topic_comment_data.image_filename3})<a href="({t_img_url filename=$topic_comment_data.image_filename3})" target="_blank">
          <img src="({t_img_url filename=$topic_comment_data.image_filename3 w=120 h=120})"></a>({/if})
        </td>
    </tr>
    <tr>
        <td class="dataview">処理</td>
        <td>&nbsp;</td>
    </tr>
</table>
</div>

({$inc_footer|smarty:nodefaults})

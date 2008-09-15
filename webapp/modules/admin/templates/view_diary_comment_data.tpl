({$inc_header|smarty:nodefaults})

<h2>投稿された日記コメントを閲覧します。</h2>
<div class="contents">

({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})

<div id="dataview">
<table style="width: 680px">
    <tr>
        <td style="width:180px" class="dataview">c_diary_comment_id</td>
        <td style="width:500px">({$diary_data.c_diary_comment_id})</td>
    </tr>
    <tr>
        <td class="dataview">投稿日時</td>
        <td>({$diary_data.r_datetime})</td>
    </tr>
    <tr>
        <td class="dataview">投稿者名（ID）</td>
        <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$diary_data.c_member_id})">({$diary_data.nickname|t_body:'name'})</a>(({$diary_data.c_member_id}))</td>
    </tr>
    <tr>
        <td class="dataview">内容</td>
        <td>({$diary_data.body|t_body:'diary'|t_geocode})</td>
    </tr>
    <tr>
        <td class="dataview">元の日記</td>
        <td><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_diary_data')})&amp;target_c_diary_id=({$diary_data.c_diary_id})">({$diary_data.ownersubject})</a>&nbsp;&nbsp;<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$diary_data.ownermemberid})">({$diary_data.ownernickname|t_body:'name'})さん</a>の日記</td>
    </tr>
    <tr>
        <td class="dataview">画像</td>
        <td>({if $diary_data.image_filename_1})<a href="({t_img_url filename=$diary_data.image_filename_1})" target="_blank">
          <img src="({t_img_url filename=$diary_data.image_filename_1 w=120 h=120})"></a>&nbsp;({/if})
        ({if $diary_data.image_filename_2})<a href="({t_img_url filename=$diary_data.image_filename_2})" target="_blank">
          <img src="({t_img_url filename=$diary_data.image_filename_2 w=120 h=120})"></a>&nbsp;({/if})
        ({if $diary_data.image_filename_3})<a href="({t_img_url filename=$diary_data.image_filename_3})" target="_blank">
          <img src="({t_img_url filename=$diary_data.image_filename_3 w=120 h=120})"></a>({/if})
        </td>
    </tr>
    <tr>
        <td class="dataview">公開範囲</td>
        <td>({if $diary_data.public_flag == 'open'})OPEN
        ({elseif $diary_data.public_flag == 'public'})全体に公開
        ({elseif $diary_data.public_flag == 'public'})フレンドまで公開
        ({else})非公開
        ({/if})
        </td>
    </tr>
    <tr>
        <td class="dataview">処理</td>
        <td>&nbsp;</td>
    </tr>
</table>
</div>

({$inc_footer|smarty:nodefaults})

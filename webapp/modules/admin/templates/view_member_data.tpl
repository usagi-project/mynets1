({$inc_header|smarty:nodefaults})

<div class="contents">
({if $msg})
<p class="actionMsg">({$msg})</p>
({/if})
<h2>Member</h2>
<table style="width: 680px">
    <tr>
        <th style="width:110px" class="style1"><strong>会員ID</strong></th>
        <td style="width:230px" class="style2">({$member_data.c_member_id})</td>
        <th style="width:110px" class="style1"><strong>登録日時</strong></th>
        <td style="width:230px" class="style2">({$member_data.r_date})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>ニックネーム</strong></th>
        <td style="width:230px" class="style2">({$member_data.nickname|t_body:'name'})</td>
        <th style="width:110px" class="style1"><strong>最新ログイン</strong></th>
        <td style="width:230px" class="style2">({$member_data.access_date})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>生年月日</strong></th>
        <td style="width:230px" class="style2">({$member_data.birth_year})-({$member_data.birth_month})-({$member_data.birth_day})</td>
        <th style="width:110px" class="style1"><strong>紹介者ID</strong></th>
        <td style="width:230px" class="style2">({$member_data.c_member_id_invite})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>日記公開状況</strong></th>
        <td style="width:230px" class="style2">({$member_data.public_flag_diary})</td>
        <th style="width:110px" class="style1"><strong>紹介者名</strong></th>
        <td style="width:230px" class="style2"><a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_member_data')})&amp;target_c_member_id=({$member_data.c_member_id_invite})">({$member_data.owner_nickname|t_body:'name'})</a></td>
    </tr>
    <!--プロフデータのループ-->
    ({foreach from=$member_data.profile item=profile})
    <tr>
        <th style="width:110px" class="style1"><strong>({$profile.caption})</strong></th>
        <td style="width:570px" class="style2" colspan="3">({$profile.value|default:"未登録"})</td>
        <!--<th style="width:110px" class="style1"><strong>&nbsp;</strong></th>
        <td style="width:230px" class="style2">&nbsp;</td>-->
    </tr>
    ({/foreach})
    <!--プロフデータのループ終わり-->
    <tr>
        <th style="width:110px" class="style1"><strong>pc_address</strong></th>
        <td class="style2" colspan="3">({$member_data.secure.pc_address|default:"未登録"})</td>
        </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>ktai_address</strong></th>
        <td class="style2" colspan="3">({$member_data.secure.ktai_address|default:"未登録"})</td>
        </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>登録時address</strong></th>
        <td class="style2" colspan="3">({$member_data.secure.regist_address})</td>
        </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>プロフィール画像</strong></th>
        <td class="style2" colspan="3">
        ({if $member_data.image_filename_1})<a href="({t_img_url filename=$member_data.image_filename_1})" target="_blank"><img src="({t_img_url filename=$member_data.image_filename_1 w=180 h=180})"></a>({/if})
        ({if $member_data.image_filename_2})<a href="({t_img_url filename=$member_data.image_filename_2})" target="_blank"><img src="({t_img_url filename=$member_data.image_filename_2 w=180 h=180})"></a>({/if})
        ({if $member_data.image_filename_3})<a href="({t_img_url filename=$member_data.image_filename_3})" target="_blank"><img src="({t_img_url filename=$member_data.image_filename_3 w=180 h=180})"></a>({/if})
        </td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>ログインReject回数</strong></th>
        <td style="width:230px" class="style2">({$member_data.is_login_reject|default:"0"})</td>
        <th style="width:110px" class="style1"><strong>忍び足Flag</strong></th>
        <td style="width:230px" class="style2">({if $member_data.is_shinobiashi == 1})忍び足設定あり({else})忍び足なし({/if})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>あしあとカウント総数</strong></th>
        <td style="width:230px" class="style2">({$member_data.ashiato_count_log})件&nbsp;(あしあと切り番設定：({$member_data.ashiato_mail_num}))</td>
        <th style="width:110px" class="style1"><strong>日記コメントメール受信設定</strong></th>
        <td style="width:230px" class="style2">({if $member_data.is_diary_comment_mail})日記コメントを携帯受信設定中({else})未設定({/if})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>携帯表示画面</strong></th>
        <td style="width:230px" class="style2">({$member_data.mobile_display})</td>
        <th style="width:110px" class="style1"><strong>PC表示画面</strong></th>
        <td style="width:230px" class="style2">({$member_data.pc_display})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>メッセージ送信回数</strong></th>
        <td style="width:230px" class="style2">受信:({$member_data.message_to.count})回&nbsp;({if $member_data.message_to.count > 0})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_message_data')})&amp;target_c_message_id=({$member_data.message_to.mid})">最新の送信メッセージ</a>({/if})</td>
        <th style="width:110px" class="style1"><strong>メッセージ受信回数</strong></th>
        <td style="width:230px" class="style2">送信:({$member_data.message_from.count})回&nbsp;({if $member_data.message_from.count > 0})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_message_data')})&amp;target_c_message_id=({$member_data.message_from.mid})">最新の受信メッセージ</a>({/if})</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>日記投稿回数</strong></th>
        <td style="width:230px" class="style2">({$member_data.diary_add.count})回</td>
        <th style="width:110px" class="style1"><strong>最新投稿日記</strong></th>
        <td style="width:230px" class="style2">({if $member_data.diary_add.count > 0})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_diary_data')})&amp;target_c_diary_id=({$member_data.diary_add.did})">({$member_data.diary_add.r_date})の日記</a>
        ({else})
        日記投稿がありません。
        ({/if})
        </td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>コメント投稿回数</strong></th>
        <td style="width:230px" class="style2">({$member_data.diary_comment_add.count})回</td>
        <th style="width:110px" class="style1"><strong>最新投稿コメント</strong></th>
        <td style="width:230px" class="style2">({if $member_data.diary_comment_add.count > 0})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_diary_comment_data')})&amp;target_c_diary_comment_id=({$member_data.diary_comment_add.did})">({$member_data.diary_comment_add.r_date})のコメント</a>
        ({else})
        コメント投稿がありません。
        ({/if})
        </td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>参加コミュニティ数</strong></th>
        <td style="width:230px" class="style2">({$member_data.commu_count})件</td>
        <th style="width:110px" class="style1"><strong>フレンドリンク数</strong></th>
        <td style="width:230px" class="style2">({$member_data.friend_count})人</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>ブロック数</strong></th>
        <td style="width:230px" class="style2">({$member_data.block_count})人</td>
        <th style="width:110px" class="style1"><strong>被ブロック数</strong></th>
        <td style="width:230px" class="style2">({$member_data.block_count_from})人</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>トピック投稿数</strong></th>
        <td style="width:230px" class="style2">({$member_data.topic_comment_add.count})回</td>
        <th style="width:110px" class="style1"><strong>最新投稿トピック</strong></th>
        <td style="width:230px" class="style2">({if $member_data.topic_comment_add.count > 0})<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_topic_comment_data')})&amp;target_c_commu_topic_comment_id=({$member_data.topic_comment_add.tid})">({$member_data.topic_comment_add.r_date})のコメント</a>
        ({else})
        コメント投稿がありません。
        ({/if})
        </td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>イベント参加数</strong></th>
        <td style="width:230px" class="style2">({$member_data.event_count})回</td>
        <th style="width:110px" class="style1"><strong>&nbsp;</strong></th>
        <td style="width:230px" class="style2">&nbsp;</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>投稿画像数</strong></th>
        <td class="style2" colspan="3">({$member_data.image_count})件の画像投稿</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>管理人からのメッセージ送信</strong></th>
        <td class="style2" colspan="3">&nbsp;現在は通常の<a href="?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_member')})&amp;mail_address=({if $member_data.secure.pc_address})({$member_data.secure.pc_address})({else})({$member_data.secure.ktai_address})({/if})">メンバー管理から送信</a>してください。</td>
    </tr>
    <tr>
        <th style="width:110px" class="style1"><strong>&nbsp;</th>
        <td style="width:230px" class="style2">&nbsp;</td>
        <th style="width:110px" class="style1"><strong>&nbsp;</th>
        <td style="width:230px" class="style2">&nbsp;</td>
    </tr>
</table>
<br>
<a href="">会員一覧へ</a>
</div>
({$inc_footer|smarty:nodefaults})

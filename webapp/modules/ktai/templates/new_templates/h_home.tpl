({$inc_ktai_header|smarty:nodefaults})
({counter name="aa" start=0 print=0})({counter name="bb" start=1 print=0})
<div id="top"></div>
<table border="0" width="240">
  <tr>
    <td align="center" bgcolor="#E7E7E7"><font color="#0000FF">({$c_member.nickname|t_body:'name'})さんMyTOP</font>
    </td>
  </tr>
</table>
<font size="1">
<marquee loop="infinity">({$oneword})</marquee>
&em_pen;<a href="({t_url m=ktai a=page_h_one_word_write})&amp;({$tail})">({$smarty.const.QUICK_SERVICE_NAME})を投稿する</a>
<table border="0" width="240" bgcolor="#FFFFFF">
    <tr>
    <td bgcolor="#E7E7E7" width="90" align="center"><font size=1>
            ({*if $c_member.image_filename*})
            <img src="({t_img_url filename=$c_member.image_filename w=76 h=76 f=jpg noimg=no_image_small})"><br>
            &em_camera;<a href="({t_url m=ktai a=page_h_config_image})&amp;({$tail})">写真変更</a><br>({$isType3GC})
            </font>
            </td>
        <td width="150"><font size=1>
            &em_face_goody;<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$c_member.c_member_id})&amp;({$tail})">プロフィール</a><br>
            &em_mail;<a href="({t_url m=ktai a=page_h_message_box})&amp;({$tail})">メッセージ</a>
            ({if $num_message_not_is_read})
            | <a href="({t_url m=ktai a=page_h_message_box})&amp;({$tail})"><font color="red">(未読({$num_message_not_is_read})件)</font></a>
            ({/if})
            <br>
            &em_foot;<a href="({t_url m=ktai a=page_h_ashiato})&amp;({$tail})">あしあと</a><br>
            日記チェック&em_search;
            <div align="right"><a href="({t_url m=ktai a=page_fh_diary_list})&amp;({$tail})">自分</a>|<a href="({t_url m=ktai a=page_h_diary_list_friend})&amp;({$tail})">({$WORD_FRIEND_HALF})</a>|<a href="({t_url m=ktai a=page_h_diary_list_all})&amp;({$tail})">全体</a><br>
        &em_pen;<a href="({t_url m=ktai a=page_h_diary_edit})&amp;({$tail})">日記を書く</a></div><div align="right"><!--<a href="({t_url m=ktai a=page_h_diary_edit2})&amp;({$tail})">足跡帳を作成する</a>--></div>
            &em_memo;<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$c_member.c_member_id})&amp;({$tail})">伝言板へGO</a><br>
            &em_book;<a href="({t_url m=ktai a=page_h_calendar_day})&amp;({$tail})">Myスケジュール</a><br>
            <!--□ｺﾒﾝﾄ履歴
            <div align="right"><a href="#d_comment">日記</a>|<a href="({t_url m=ktai a=page_h_dengon_rireki})&amp;({$tail})">伝言板</a></div>-->
            &em_key;<a href="#config">設定メニュー</a>
            </font>
        </td>
    </tr>
</table>
({if $birthday_flag})
☆Happy Birthday☆<br>
お誕生日おめでとうございます
({/if})
<hr>

<table border="0"  width="240" bgcolor="#FEFFEC">
  <tr>
    <td width="100%"><font size="1">
    ({if $c_siteadmin})
    ({$c_siteadmin|t_body:'kadmin'})<br>
    ({/if})
    ({if $num_f_confirm_list})
    <a href="({t_url m=ktai a=page_h_confirm_list})&amp;({$tail})"><font color="red">★承認待ちのメンバー({$num_f_confirm_list})名</font></a><br>
    ({/if})
    ({if $num_diary_not_is_read})
    <a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$first_diary_read})&amp;({$tail})"><font color="red">★({$num_diary_not_is_read})件日記に新着コメント</font></a><br>
    ({/if})
    ({if $num_h_confirm_list })
    <a href="({t_url m=ktai a=page_h_confirm_list})&amp;({$tail})"><font color="red">★コミュニティ参加承認待ち({$num_h_confirm_list})名</font></a><br>
    ({/if})
    ({if $anatani_c_commu_admin_confirm_list})
    <a href="({t_url m=ktai a=page_h_confirm_list})&amp;({$tail})"><font color="red">★コミュニティ管理人交代依頼({$num_anatani_c_commu_admin_confirm_list})件</font></a><br>
    ({/if})
    ({if $anatani_c_commu_admin_confirm_list||$num_f_confirm_list||$num_message_not_is_read||$num_diary_not_is_read||$num_h_confirm_list||$anatani_c_commu_admin_confirm_list})
    <br>
    ({/if})
    </font>
    </td>
  </tr>
</table>
<hr color="blue">

&em_1square;({if $c_diary_friend_list})<a href="#fdiary" accesskey="1"><font color="blue">ﾌﾚﾝﾄﾞ日記</font></a>({else})ﾌﾚﾝﾄﾞ日記({/if})|&em_2square;({if $c_diary_my_comment_list})<a href="#rdiary" accesskey="2"><font color="blue">日記ｺﾒﾝﾄ履歴</font></a>({else})日記ｺﾒﾝﾄ履歴({/if})|&em_3square;
({if $c_commu_topic_list})<a href="#rcommu" accesskey="3"><font color="blue">ﾄﾋﾟｯｸ更新</font></a>({else})ﾄﾋﾟｯｸ更新({/if})|&em_4square;({if $c_commu_list})<a href="({t_url m=ktai a=page_fh_com_list})&amp;({$tail})" accesskey="4"><font color="blue">ｺﾐｭﾆﾃｨﾘｽﾄ</font></a>({else})ｺﾐｭﾆﾃｨﾘｽﾄ({/if})|
&em_5square;<a href="#mfriend" accesskey="5"><font color="blue">Myﾌﾚﾝﾄﾞ</font></a>|&em_6square;<a href="({t_url m=ktai a=page_fh_dengon})&amp;target_c_member_id_to=({$c_member.c_member_id})&amp;({$tail})" accesskey="6"><font color="blue">My伝言板</font></a>|&em_7square;
<a href="({t_url m=ktai a=page_h_config})&amp;({$tail})" accesskey="7"><font color="blue">設定変更</font></a>|&em_8square;<a href="({t_url m=ktai a=page_h_calendar_day})&amp;({$tail})" accesskey="8">ｽｹｼﾞｭｰﾙ</a><br>
<a name="fdiary"></a>
<table border="1"  bordercolor="#C0C0C0" width="240" bgcolor="#E7E7E7">  <tr>
    <td width="100%" align="center"><font color="green" size="1">[({$WORD_FRIEND_HALF})最新日記]</font></td>
  </tr>
</table>
({if $c_diary_friend_list})
({foreach from=$c_diary_friend_list item=item})
({$item.r_date|t_date})(({$item.nickname|t_truncate:36:""|t_body:'name'}))<br>
<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})&amp;({$tail})">({$item.subject|t_truncate:36:".."|t_body:'title'})</a>(ｺﾒﾝﾄ({$item.comment_count})|閲覧({$item.etsuran_count}))({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})&em_camera;({/if})<br>
({/foreach})
<div align="right"><a href="({t_url m=ktai a=page_h_diary_list_friend})&amp;({$tail})">→もっと見る</a></div>
({/if})
<a name="rdiary"></a>
<table border="1" bordercolor="#C0C0C0" width="240" bgcolor="#E7E7E7">
  <tr>
    <td width="100%" align="center"><font color="green" size="1">[日記コメント記入履歴]</font>
    </td>
  </tr>
</table>
({if $c_diary_my_comment_list})
({foreach from=$c_diary_my_comment_list item=item})
({$item.e_datetime|t_date})(({$item.nickname|t_truncate:36:""|t_body:'name'}))<br>
<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$item.c_diary_id})&amp;({$tail})">({$item.subject|t_truncate:36:".."|t_body:'title'})</a>(ｺﾒﾝﾄ({$item.comment_count})|閲覧({$item.etsuran_count}))({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})&em_camera;({/if})<br>
({/foreach})
<div align="right">
<a href="({t_url m=ktai a=page_h_diary_comment_list})&amp;({$tail})">→もっと見る</a></div>
<div align="right"><a href="#top">↑ページ先頭へ</a></div>
({/if})
<a name="rcommu"></a>
<table border="1"  bordercolor="#C0C0C0" width="240" bgcolor="#E7E7E7">  <tr>
    <td width="100%" align="center"><font color="green" size="1">[コミュニティ最新書き込み]</font></td>
  </tr>
</table>
({if $c_commu_topic_list})
({foreach from=$c_commu_topic_list item=item})
({$item.e_datetime|t_date})(({$item.c_commu_name|t_truncate:36:""|t_body:'name'}))<br>
<a href="({t_url m=ktai a=page_c_bbs})&amp;target_c_commu_topic_id=({$item.c_commu_topic_id})&amp;({$tail})">({$item.c_commu_topic_name|t_truncate:36:".."|t_body:'title'})</a>(書込数({$item.number}))({if $item.image_filename_1 || $item.image_filename_2 || $item.image_filename_3})&em_camera;({/if})<br>
({/foreach})
<div align="right"><a href="({t_url m=ktai a=page_h_com_comment_list})&amp;({$tail})">→もっと見る</a></div>
<hr color="green">
<div align="right"><a href="#top">↑ページ先頭へ</a></div>
({/if})
<a name="mfriend"></a>
<table border="1"  bordercolor="#C0C0C0" width="240" bgcolor="#E7E7E7">  <tr>
    <td width="100%" align="center"><font color="green" size="1">[({$WORD_FRIEND_HALF})リスト]</font></td>
  </tr>
</table>
({if $c_friend_list})
({foreach from=$c_friend_list item=friend})
<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$friend.c_member_id_to})&amp;({$tail})">({$friend.nickname|t_body:'name'})</a>（({$friend.count_friend})）<br>
({/foreach})
&em_book;<a href="({t_url m=ktai a=page_fh_intro})&amp;({$tail})">紹介文を見る</a><br>
<div align="right"><a href="({t_url m=ktai a=page_fh_friend_list})&amp;({$tail})">→もっと見る</a></div>
<div align="right"><a href="({t_url m=ktai a=page_h_manage_friend})&amp;({$tail})">→({$WORD_MY_FRIEND_HALF})管理</a><br>
({else})
({$WORD_FRIEND_HALF})登録はありません<br>
({/if})
</div>
<hr color="green">
<div align="center"><font color="green">({$WORD_FRIEND_HALF})を探すには、コチラで検索しよう</font></div>
&em_search;<a href="({t_url m=ktai a=page_h_friend_find_all})&amp;({$tail})">登録メンバー検索</a><br>
&em_search;<a href="({t_url m=ktai a=page_h_diary_list_all})&amp;({$tail})">登録メンバー最新日記</a><br>
&em_crown;<a href="({t_url m=ktai a=page_h_ranking})&amp;({$tail})">ランキング</a><br>
&em_tennis;<a href="({t_url m=ktai a=page_h_com_find_all})&amp;({$tail})">コミュニティ検索</a><br>
<br>
({if $smarty.const.IS_USER_INVITE && ($smarty.const.OPENPNE_REGIST_FROM != $smarty.const.OPENPNE_REGIST_FROM_NONE)})
<div align="center">&em_mail;<a href="({t_url m=ktai a=page_h_invite})&amp;({$tail})">友人を招待</a>&em_mail;<br>
あなたのお友達を({$smarty.const.SNS_NAME})へ誘ってみよう♪</div>
({/if})
<a name="config"></a>
<table border="1"  bordercolor="#C0C0C0" width="240" bgcolor="#E7E7E7">
  <tr>
    <td width="100%" align="right"><font size="1"><a href="({t_url m=ktai a=page_h_config_prof})&amp;({$tail})">プロフィール変更</a><br>
    <a href="({t_url m=ktai a=page_h_config_image})&amp;({$tail})">プロフィール写真変更</a><br>
    <a href="({t_url m=ktai a=page_h_config})&amp;({$tail})">設定変更</a><br>
    <a href="({t_url m=ktai a=page_fh_com_list})&amp;({$tail})">参加コミュニティ</a><br>
    <a href="({t_url m=ktai a=page_h_bookmark_list})&amp;({$tail})">お気に入り</a><br>
    <a href="({t_url m=ktai a=page_h_confirm_list})&amp;({$tail})">承認待ちリスト</a><br>
    </font>
    </td>
  </tr>
</table>
<a href="({t_url m=ktai a=page_o_sns_kiyaku})">利用規約</a><br>
<a href="({t_url m=ktai a=page_o_sns_privacy})">プライバシーポリシー</a><br>
<div align="right"><a href="#top">↑ページ先頭へ</a></div>
</font>
({$inc_ktai_footer|smarty:nodefaults})
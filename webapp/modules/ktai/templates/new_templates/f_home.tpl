({$inc_ktai_header|smarty:nodefaults})

<div id="top"></div>

<div align="center">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="240">
  <tr>
    <td width="100%" align="center" bgcolor="#E7E7E7"><font color="#0000FF">({$target_c_member.nickname|t_body:'name'})さんのﾎｰﾑ</font><br>(ID=({$target_c_member.c_member_id}))</td>
    </tr>
    <tr>
    <td>
    <marquee loop="infinity">({$oneword})</marquee>
    </td>
  </tr>
</table>
</div>
<font size="1">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="240">
  <tr>
    <td width="90" valign="top" bgcolor="#E6FFFF" align="center"><font size="1">
            ({if $target_c_member.image_filename})
            <img src="({t_img_url filename=$target_c_member.image_filename w=76 h=76 f=jpg noimg=no_image_small})">
            <br><a href="({t_url m=ktai a=page_f_show_image})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">写真を確認</a>
            ({else})
            <img src="({t_img_url filename=$target_c_member.image_filename w=76 h=76 f=jpg noimg=no_image_small})">
            ({/if})
            <br>
            ({$target_c_member.last_login})
            </font>
            </td>
        <td width="150" valign="top" bgcolor="#FFFFFF"><font size="1">
            ({if $page_flag})
            &em_mail;<a href="({t_url m=ktai a=page_h_message_box})&amp;({$tail})">メッセージBOX</a><br>
            ({else})
            ♪<a href="({t_url m=ktai a=page_f_message_send})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">メッセージ送信</a><br>
            ({/if})
            ({if $relation.friend||$target_c_member.public_flag_diary=="public"||$target_c_member.public_flag_diary=="open"})
            &em_pen;<a href="({t_url m=ktai a=page_fh_diary_list})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">日記を読む</a><br>
            ({else})
            ◆日記は公開されていません<br>
            ({/if})
            &em_face_goody;<a href="({t_url m=ktai a=page_fh_intro})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">紹介文を見る</a><br>
            <a href="({t_url m=ktai a=page_fh_com_list})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">参加ｺﾐｭﾆﾃｨ</a><br>
            ({if $page_flag})
            ({else})
            ◆<a href="({t_url m=ktai a=do_f_bookmark_add_insert_c_bookmark})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">お気に入りに追加</a>
            <br>
            ({/if})
            ({if $page_flag})
            ({else})
            ({if $relation.friend==0})
            ({if $relation.wait==0})
            ({if $target_c_member_id !== $u})
            <a href="({t_url m=ktai a=page_f_link_request})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">({$WORD_MY_FRIEND_HALF})に加える</a>
            ({/if})
            ({/if})
            ({/if})
            ({/if})
            <br>
            </font>
        </td>
  </tr>
</table>

({if $days_birthday == 0})({* 誕生日当日 *})
<a href="({t_url m=ktai a=page_f_message_send})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">☆Happy Birthday☆
<br>お誕生日にメッセージを送りましょう</a>
<hr>
({elseif $days_birthday <= 3})({* 誕生日3日以内 *})
<a href="({t_url m=ktai a=page_f_message_send})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">☆もうすぐ誕生日です！☆
<br>お誕生日にはメッセージを送りましょう</a>
<hr>
({/if})

({if $c_siteadmin})
({$c_siteadmin|t_body:'kadmin'})
<hr>
({/if})

({if $relation.wait==1})
現在、({$WORD_FRIEND_HALF})承認待ちです<br>
<br>
({/if})

<table border="" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#E7E7E7" width="240">
  <tr>
    <td width="100%" bgcolor="#C0C0C0" align="center"><font size="1">({$target_c_member.nickname|t_body:'name'})さんのプロフィール</font></td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#E7E7E7">
    <font size="1">
    ニックネーム：({$target_c_member.nickname|t_body:'name'})<br>
    ({if $target_c_member.age !== NULL})年齢：({$target_c_member.age})歳<br>({/if})
    誕生日：({$target_c_member.birth_month})月({$target_c_member.birth_day})日<br>
    </font>
    </td>
  </tr>
</table>
    <div align="center">
({if $page_flag})
<a href="({t_url m=ktai a=page_h_config_prof})&amp;({$tail})">プロフィールを更新する</a>
({else})
<a href="({t_url m=ktai a=page_f_home2})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">詳細プロフィール</a>
({/if})
</div>
<a name="dengon"></a>
<!--伝言板をここに入れる-->
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="240" bgcolor="#006600">
  <tr>
    <td width="100%"><font color="#FFFFFF" size="1">[伝言板]</font></td>
  </tr>
</table>
({foreach from=$c_dengon_comment item=c_dengon})
({$c_dengon.r_datetime|date_format:"%m/%d %H:%M"}) |
({if $c_dengon.nickname})<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$c_dengon.c_member_id_from})&amp;({$tail})">({$c_dengon.nickname|t_body:'name'})</a>({/if})
({if $item.mobile == 'mobile'})
({if $ua==1})&#xE688;({elseif $ua==2})<IMG LOCALSRC="161">({else})<img src='img/moji/161.jpg' width=12>({/if})
({/if})
<table border="0" width="240">
  <tr bgcolor="({cycle values="#eeeeee,#d0d0d0"})">
    <td width="20" align="center"><font size="1">
    ({*if $c_dengon.image_filename*})
    <img src="({t_img_url filename=$c_dengon.image_filename w=36 h=36 noimg=no_image_mini})">
    ({*/if*})
</font>
    </td>
    <td width="220"><font size="1">
    <font size="1">({$c_dengon.body|t_body:'kdengon'|default:"&nbsp;"})
    ({if $c_dengon.c_member_id_from == $u || $page_flag})
[<a href="({t_url m=ktai a=page_fh_dengon_delete_c_dengon_comment_confirm})&amp;target_c_dengon_comment_id=({$c_dengon.c_dengon_comment_id})&amp;({$tail})&amp;target_c_member_id_to=({$c_dengon.c_member_id_to})">削除</a>]
({/if})
    </font>
　  </td>
  </tr>
</table>
({/foreach})
<a href="({t_url m=ktai a=page_fh_dengon})&amp;target_c_member_id_to=({$target_c_member.c_member_id})&amp;({$tail})">伝言板に書込みを残す</a><hr>
<!--伝言板ココまで-->
<div align="right"><a href="#top">↑ページ先頭へ</a></div>
({if $relation.friend||$target_c_member.public_flag_diary=="public"||$target_c_member.public_flag_diary=="open"})
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="240" bgcolor="#006600">
  <tr>
    <td width="100%"><font color="#FFFFFF" size="1">[最新日記]</font></td>
  </tr>
</table>
({foreach from=$c_diary_list item=c_diary})
({$c_diary.r_date|date_format:"%y/%m/%d"})-<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$c_diary.c_diary_id})&amp;({$tail})">({$c_diary.subject|t_body:'title'})</a>(コメント:({$c_diary.comment_count})|閲覧:({$c_diary.etsuran_count}))<br>
({/foreach})
<a href="({t_url m=ktai a=page_fh_diary_list})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">→もっと読む</a><br>
<br>
({/if})
({if $c_friend_list})
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="240" bgcolor="#006600">
  <tr>
    <td width="100%"><font color="#FFFFFF" size="1">[({$WORD_FRIEND_HALF})リスト]</font></td>
  </tr>
</table>
({foreach from=$c_friend_list item=friend})
<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$friend.c_member_id_to})&amp;({$tail})">({$friend.nickname|t_body:'name'})</a>（({$friend.count_friend})）<br>
({/foreach})
<div align="right"><a href="({t_url m=ktai a=page_fh_friend_list})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">→もっと見る</a></div>
({else})
({$WORD_FRIEND_HALF})リストなし<br>
({/if})

({if $relation.friend})
<div align="center">＞
<a href="({t_url m=ktai a=page_f_intro_edit})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">紹介文を書く</a>＜
</div>
({/if})
({if !$page_flag})
<div align="right"><a href="({t_url m=ktai a=page_h_block})&amp;block_member_id=({$target_c_member.c_member_id})&amp;({$tail})"><font color="red">この人をﾌﾞﾛｯｸする</font></a></div>
({/if})
<!--ココに伝言板を表示します。-->
<div align="right"><a href="#top">↑ページ先頭へ</a></div>
<hr>
</font>
({$inc_ktai_footer|smarty:nodefaults})

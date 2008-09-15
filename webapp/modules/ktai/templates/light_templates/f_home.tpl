({$inc_ktai_header|smarty:nodefaults})

<center><font color="orange">({$target_c_member.nickname|t_body:'name'})さんのﾎｰﾑ(ID=({$target_c_member.c_member_id}))</font></center>
<hr>
({if $page_flag})
他の人があなたのﾍﾟｰｼﾞを
開いたらこのように表示
されます
({else})
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
({if $target_c_member.image_filename})
&em_camera;<a href="({t_url m=ktai a=page_f_show_image})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">写真を見る</a><br>
<br>
({/if})

({if $relation.wait==1})
現在、({$WORD_FRIEND_HALF})承認待ちです<br>
<br>
({/if})

&em_book;<a href="({t_url m=ktai a=page_f_message_send})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">ﾒｯｾｰｼﾞを送る</a><br>
&em_pen;<a href="({t_url m=ktai a=do_f_bookmark_add_insert_c_bookmark})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">お気に入りに追加</a><br>
({if $relation.friend})
&em_pen;<a href="({t_url m=ktai a=page_f_intro_edit})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">紹介文を書く</a><br>
({/if})
<br>

({if $relation.friend==0})
({if $relation.wait==0})
&em_face_goody;<a href="({t_url m=ktai a=page_f_link_request})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">({$WORD_MY_FRIEND_HALF})に加える</a><br>
<br>
({/if})
({/if})
({/if})
<hr color="green">
<a name="dengon"></a>
<font color="green">[伝言板]</font><br>
({foreach from=$c_dengon_comment item=c_dengon})
({$c_dengon.r_datetime|date_format:"%m/%d %H:%M"})|({if $c_dengon.nickname})<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$c_dengon.c_member_id_from})&amp;({$tail})">({$c_dengon.nickname|t_body:'name'})</a>({/if})
({if $item.mobile == 'mobile'})
|&em_ktai;<br>
({/if})
({$c_dengon.body|nl2br|default:"&nbsp;"|t_body:'name'})
    ({if $c_dengon.c_member_id_from == $u || $page_flag})
[<a href="({t_url m=ktai a=page_fh_dengon_delete_c_dengon_comment_confirm})&amp;target_c_dengon_comment_id=({$c_dengon.c_dengon_comment_id})&amp;({$tail})&amp;target_c_member_id_to=({$c_dengon.c_member_id_to})">削除</a>]
({/if})
<br>
({/foreach})
<br>
<a href="({t_url m=ktai a=page_fh_dengon})&amp;target_c_member_id_to=({$target_c_member.c_member_id})&amp;({$tail})">→もっと見る・入力</a><hr>
<!--伝言板ココまで-->
({if $c_diary_list})
&em_book;日記<br>
({foreach from=$c_diary_list item=c_diary})
({$c_diary.r_date|date_format:"%y/%m/%d"})-<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$c_diary.c_diary_id})&amp;({$tail})">({$c_diary.subject|t_body:'name'})</a>(({$c_diary.comment_count}))<br>
({/foreach})
<a href="({t_url m=ktai a=page_fh_diary_list})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">→もっと読む</a><br>
<br>
({/if})
&em_face_goody;({$WORD_FRIEND_HALF})ﾘｽﾄ<br>
({foreach from=$c_friend_list item=c_friend})
<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$c_friend.c_member_id_to})&amp;({$tail})">({$c_friend.nickname|t_body:'name'})</a>(({$c_friend.count_friend}))<br>
({/foreach})
<a href="({t_url m=ktai a=page_fh_friend_list})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">→すべて表示</a><br>
<a href="({t_url m=ktai a=page_fh_intro})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">紹介文を見る</a><br>
<br>
&em_tennis;参加ｺﾐｭﾆﾃｨ<br>
({foreach from=$c_commu_list item=c_commu})
<a href="({t_url m=ktai a=page_c_home})&amp;target_c_commu_id=({$c_commu.c_commu_id})&amp;({$tail})">({$c_commu.name|t_body:'name'})</a>(({$c_commu.count_members}))<br>
({/foreach})
<a href="({t_url m=ktai a=page_fh_com_list})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">→すべて表示</a><br>
<br>
[&em_memo;ﾌﾟﾛﾌｨｰﾙ]<br>
({strip})
({capture name="nick"})
ﾆｯｸﾈｰﾑ：({$target_c_member.nickname|t_body:'name'})<br>
({/capture})
({capture name="birth"})
({if $target_c_member.age !== NULL})年齢：({$target_c_member.age})歳<br>({/if})
誕生日：({$target_c_member.birth_month})月({$target_c_member.birth_day})日<br>
({/capture})

({foreach from=$target_c_member.profile key=key item=item})

({if !$_cnt_nick && $profile_list[$key].sort_order >= $smarty.const.SORT_ORDER_NICK
  && !$_cnt_birth && $profile_list[$key].sort_order >= $smarty.const.SORT_ORDER_BIRTH})
({counter assign="_cnt_nick"})
({counter assign="_cnt_birth"})
({if $smarty.const.SORT_ORDER_NICK > $smarty.const.SORT_ORDER_BIRTH})
({$smarty.capture.birth|smarty:nodefaults})
({$smarty.capture.nick|smarty:nodefaults|t_body:'name'})
({else})
({$smarty.capture.nick|smarty:nodefaults})
({$smarty.capture.birth|smarty:nodefaults|t_body:'name'})
({/if})
({/if})

({if !$_cnt_nick && $profile_list[$key].sort_order >= $smarty.const.SORT_ORDER_NICK})
({counter assign="_cnt_nick"})
({$smarty.capture.nick|smarty:nodefaults|t_body:'name'})
({/if})

({if !$_cnt_birth && $profile_list[$key].sort_order >= $smarty.const.SORT_ORDER_BIRTH})
({counter assign="_cnt_birth"})
({$smarty.capture.birth|smarty:nodefaults})
({/if})

({if $item.value})
({$item.caption})：

({if $item.form_type == 'textarea'})
    <br>({$item.value|nl2br|t_body:'kdiary'})
({elseif $item.form_type == 'checkbox'})
    ({$item.value|@t_implode:", "})
({else})
    ({$item.value})
({/if})
<br>
({/if})
({/foreach})

({if !$_cnt_nick && !$_cnt_birth})
({if $smarty.const.SORT_ORDER_NICK > $smarty.const.SORT_ORDER_BIRTH})
({$smarty.capture.birth|smarty:nodefaults})
({$smarty.capture.nick|smarty:nodefaults|t_body:'name'})
({else})
({$smarty.capture.nick|smarty:nodefaults|t_body:'name'})
({$smarty.capture.birth|smarty:nodefaults})
({/if})
({else})
({if !$_cnt_nick})({$smarty.capture.nick|smarty:nodefaults|t_body:'name'})({/if})
({if !$_cnt_birth})({$smarty.capture.birth|smarty:nodefaults})({/if})
({/if})

({/strip})
({if !$page_flag})
<hr>
<div align="right">&em_foot;<a href="({t_url m=ktai a=page_h_block})&amp;block_member_id=({$target_c_member.c_member_id})&amp;({$tail})"><font color="red">この人をﾌﾞﾛｯｸする</font></a></div>
({/if})
<hr>
({$inc_ktai_footer|smarty:nodefaults})
({**@author Hirohisa Seta UsagiProject**})

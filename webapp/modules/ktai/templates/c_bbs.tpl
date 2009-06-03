({if $MyDisplayTemplate})
        ({ext_include file="$MyDisplayTemplate/c_bbs.tpl"})
({else})

({$inc_ktai_header|smarty:nodefaults})

<center><font color="orange">
ｺﾐｭﾆﾃｨ：({$c_commu.name|t_body:'name'})<br>
</font></center>
<hr>
({if $c_commu_topic})
<a href="#1">▼</a>&nbsp;&nbsp;<a href="#comment">&em_memo;</a>
<center>({$c_commu_topic.name|t_body:'title'})<br>
<a href="({t_url m=ktai a=page_c_bbs})&amp;target_c_commu_topic_id=({$c_commu_topic.c_commu_topic_id})&amp;({$tail})">新着順</a>|<a href="({t_url m=ktai a=page_c_bbs})&amp;target_c_commu_topic_id=({$c_commu_topic.c_commu_topic_id})&amp;sort_order=1&amp;({$tail})">投稿順</a>|<a href="({t_url m=ktai a=page_c_bbs})&amp;target_c_commu_topic_id=({$c_commu_topic.c_commu_topic_id})&amp;sort_order=2&amp;({$tail})">最初から</a>
</center>

<hr>

({if $c_commu_topic.event_flag != 1})

<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$c_commu_topic.c_member_id})&amp;({$tail})">({$c_commu_topic.nickname|t_body:'name'|default:"&nbsp;"})</a>
<br>
({$c_commu_topic.body|bbcode2html|t_body:'kbbs'|default:"&nbsp;"})<br>
({if $c_commu_topic.image_filename1})画像：[<a href="({t_img_url filename=$c_commu_topic.image_filename1 w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$c_commu_topic.image_filename1 w=360 h=360 f=jpg})">大</a>]<br>({/if})
({if $c_commu_topic.image_filename2})画像：[<a href="({t_img_url filename=$c_commu_topic.image_filename2 w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$c_commu_topic.image_filename2 w=360 h=360 f=jpg})">大</a>]<br>({/if})
({if $c_commu_topic.image_filename3})画像：[<a href="({t_img_url filename=$c_commu_topic.image_filename3 w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$c_commu_topic.image_filename3 w=360 h=360 f=jpg})">大</a>]<br>({/if})
({$c_commu_topic.r_datetime|date_format:"%m/%d %H:%M"})
<br>
({if $c_commu_topic.c_member_id==$u || $is_admin})
<a href="({t_url m=ktai a=page_c_topic_edit})&amp;target_c_commu_topic_id=({$c_commu_topic_id})&amp;({$tail})">編集</a><br>
<a href="mailto:({$mail_address2})">メールで編集</a><br>
(画像も添付できます)<br>
({if $gps_address2})
({if $gps_type=='docomo'})
<a href="({$gps_address2})" lcs>
({else})
<a href="({$gps_address2})">
({/if})
GPS情報を取得して&em_mail;で編集</a><br>
GPS機能を持つ携帯でマップ付きで編集できます<br>
({/if})
({/if})

({else})

<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$c_commu_topic.c_member_id})&amp;({$tail})">({$c_commu_topic.nickname|t_body:'name'|default:"&nbsp;"})</a> <br>
開催日時：<br>
({$c_commu_topic.open_date|date_format:"%Y年%m月%d日"}) ({$c_commu_topic.open_date_comment})<br>
開催場所：<br>
({$c_commu_topic.pref}) ({$c_commu_topic.open_pref_comment})<br>
({if $c_commu_topic.invite_period != '0000-00-00'})
募集期限：<br>
({$c_commu_topic.invite_period|date_format:"%Y年%m月%d日"})<br>
({/if})
詳細：<br>
({$c_commu_topic.body|bbcode2html|t_body:'kbbs'|default:"&nbsp;"})<br>
({if $c_commu_topic.image_filename1})画像：[<a href="({t_img_url filename=$c_commu_topic.image_filename1 w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$c_commu_topic.image_filename1 w=360 h=360 f=jpg})">大</a>]<br>({/if})
({if $c_commu_topic.image_filename2})画像：[<a href="({t_img_url filename=$c_commu_topic.image_filename2 w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$c_commu_topic.image_filename2 w=360 h=360 f=jpg})">大</a>]<br>({/if})
({if $c_commu_topic.image_filename3})画像：[<a href="({t_img_url filename=$c_commu_topic.image_filename3 w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$c_commu_topic.image_filename3 w=360 h=360 f=jpg})">大</a>]<br>({/if})
({$c_commu_topic.r_datetime|date_format:"%m/%d %H:%M"})<br>

<a href="({t_url m=ktai a=page_c_event_member_list})&amp;target_c_commu_topic_id=({$c_commu_topic.c_commu_topic_id})&amp;({$tail})">参加者リスト</a><br>
({if $is_c_event_admin})
<a href="({t_url m=ktai a=page_c_event_mail})&amp;target_c_commu_topic_id=({$c_commu_topic.c_commu_topic_id})&amp;({$tail})">一括メッセージを送る</a><br>
({/if})
({if $is_c_event_admin || $is_admin})
<a href="({t_url m=ktai a=page_c_event_edit})&amp;target_c_commu_topic_id=({$c_commu_topic_id})&amp;({$tail})">編集</a><br>
({/if})

({/if})

({/if})

({if $is_c_commu_view})

<hr>
({foreach from=$c_commu_topic_comment_list item=item name=list})
  <a name="({$smarty.foreach.list.iteration})" href="#({if $smarty.foreach.list.last})({if $is_prev || $is_next})pager({else})comment({/if})({else})({$smarty.foreach.list.iteration+1})({/if})">▼</a>
({if $item.number != 0})
    ({$item.number}).({if $item.nickname})<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$item.c_member_id})&amp;({$tail})">({$item.nickname|t_body:'name'})</a>
({/if})
<br>
({$item.body|bbcode2html|t_body:'kbbs'|default:"&nbsp;"})<br>
({if $item.image_filename1})画像：[<a href="({t_img_url filename=$item.image_filename1 w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$item.image_filename1 w=360 h=360 f=jpg})">大</a>]<br>({/if})
({if $item.image_filename2})画像：[<a href="({t_img_url filename=$item.image_filename2 w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$item.image_filename2 w=360 h=360 f=jpg})">大</a>]<br>({/if})
({if $item.image_filename3})画像：[<a href="({t_img_url filename=$item.image_filename3 w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$item.image_filename3 w=360 h=360 f=jpg})">大</a>]<br>({/if})
({$item.r_datetime|date_format:"%m/%d %H:%M"})
<br>
({if ($item.c_member_id == $u || $target_diary_writer==$u || $is_admin) && $item.number != 0})
[<a href="({t_url m=ktai a=page_c_bbs_delete_c_commu_topic_comment_confirm})&amp;c_commu_topic_comment_id=({$item.c_commu_topic_comment_id})&amp;target_c_commu_topic_id=({$c_commu_topic_id})&amp;({$tail})">削除</a>]<br>
({/if})
<br>
({/if})
({/foreach})

({if $is_prev || $is_next})
<a name="pager"></a>
({if $is_prev})<a href="({t_url m=ktai a=page_c_bbs})&amp;target_c_commu_topic_id=({$c_commu_topic_id})&amp;page=({$page-1})&amp;sort_order=({$sort_order})&amp;({$tail})">前へ</a> ({/if})
({if $is_next})<a href="({t_url m=ktai a=page_c_bbs})&amp;target_c_commu_topic_id=({$c_commu_topic_id})&amp;page=({$page+1})&amp;sort_order=({$sort_order})&amp;({$tail})">次へ</a>({/if})
<br>
({/if})
({/if})

({if $is_c_commu_member})
<hr>
({if $msg})
<font color="red">({$msg})</font><br>
<br>
({/if})
<a name="comment"></a>

({t_form m=ktai a=do_c_bbs_insert_c_commu_topic_comment})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_commu_topic_id" value="({$c_commu_topic_id})">
<textarea name="body"></textarea><br>
({if $c_commu_topic.event_flag})
({if !$is_c_event_admin})
({if !$is_c_event_member})
<input name="join_event" type="submit" value="イベントに参加する"><br>
({else})
<input name="cancel_event" type="submit" value="参加をキャンセルする"><br>
({/if})
({/if})
<input name="write_comment" type="submit" value="コメントのみ書き込む">
({else})
<input type="submit" value="書き込む">
({/if})
</form><br>
<a href="mailto:({$mail_address})">メール投稿</a><br>
画像も添付できます。<br>
({if $gps_address})
({if $gps_type=='docomo'})
<a href="({$gps_address})" lcs>
({else})
<a href="({$gps_address})">
({/if})
GPS情報を取得して&em_mail;で投稿</a><br>
GPS機能を持つ携帯でマップ付きコメントを投稿できます<br>
({/if})
({/if})
<hr>

<a href="({t_url m=ktai a=page_c_home})&amp;target_c_commu_id=({$c_commu.c_commu_id})&amp;({$tail})">ｺﾐｭﾆﾃｨﾄｯﾌﾟ</a><br>

({$inc_ktai_footer|smarty:nodefaults})
({/if})

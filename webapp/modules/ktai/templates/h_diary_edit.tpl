({$inc_ktai_header|smarty:nodefaults})

<center><font color="orange">日記を書く</font></center>
<hr>
({if !$target_c_diary.c_diary_id})
<a href="mailto:({$blog_address})">&em_mail;で投稿</a><br>
画像を添付すると&em_camera;付き日記になります<br>
※絵文字は文字化けします。<br>
({if $gps_address})
({if $gps_type=='docomo'})
<a href="({$gps_address})" lcs>
({else})
<a href="({$gps_address})">
({/if})
GPS情報を取得して&em_mail;で投稿</a><br>
GPS機能を持つ携帯でマップ付き日記を投稿できます<br>
({/if})
<hr>
({/if})
({if $msg})<font color="red">({$msg})</font><br>({/if})

({t_form m=ktai a=do_h_diary_edit_insert_c_diary})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
({if $target_c_diary.c_diary_id})<input type="hidden" name="target_c_diary_id" value="({$target_c_diary.c_diary_id})">({/if})
ﾀｲﾄﾙ:<br>
<input size="14" name="subject" value="({$target_c_diary.subject})"><br>
本文:<br>
<textarea name="body" rows="6" cols="14">({$target_c_diary.body})</textarea><br>
公開範囲:<br>
<input type="radio" name="public_flag" value="open"({if $target_c_diary.public_flag == "open"}) checked="checked"({/if})>外部に公開<br>
<input type="radio" name="public_flag" value="public"({if $target_c_diary.public_flag == "public"}) checked="checked"({/if})>全員に公開<br>
<input type="radio" name="public_flag" value="friend"({if $target_c_diary.public_flag == "friend"}) checked="checked"({/if})>({$WORD_MY_FRIEND_HALF})まで公開<br>
<input type="radio" name="public_flag" value="private"({if $target_c_diary.public_flag == "private"}) checked="checked"({/if})>公開しない<br>
<input type="submit" value="送信">
</form>

<hr>
<a href="({t_url m=ktai a=page_fh_diary_list})&amp;({$tail})">日記ﾘｽﾄ</a><br>

({$inc_ktai_footer|smarty:nodefaults})
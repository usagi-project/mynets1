({$inc_ktai_header|smarty:nodefaults})
<font size="1">
<table border="0" width="240">
  <tr>
    <td align="center" bgcolor="#E7E7E7"><font color="#0000FF" size="1"><a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$target_diary_writer.c_member_id})&amp;({$tail})">({$target_diary_writer.nickname|t_body:'title'})さん</a>の日記</font>
    </td>
  </tr>
  <tr><td>
  <marquee loop="infinity"><a href="({t_url m=ktai a=page_f_one_word_list})&amp;target_c_member_id=({$target_diary_writer.c_member_id})&amp;({$tail})">({$oneword})</a></marquee>
  </td></tr>
</table>

({if $c_siteadmin})
({$c_siteadmin|t_body:'kadmin'})
({/if})
({$target_c_diary.r_datetime|date_format:"%y/%m/%d %H:%M"})<br>
({$target_c_diary.subject|t_body:'title'})
<div align="right">
({if $type == "h"})
  ({strip})
  ({if $target_c_diary.public_flag == "oepn"})
    <font color="blue">外部に公開</font>
  ({elseif $target_c_diary.public_flag == "public"})
    <font color="blue">全員に公開</font>
  ({elseif $target_c_diary.public_flag == "friend"})
    <font color="red">({$WORD_MY_FRIEND_HALF})まで公開</font>
  ({elseif $target_c_diary.public_flag == "private"})
    <font color="red">公開しない</font>
  ({/if})
  ({/strip})
({/if})
({if $type !== "h"})
  ({strip})
  ({if $target_c_diary.public_flag == "oepn"})
    <font color="blue">外部に公開</font>
  ({elseif $target_c_diary.public_flag == "public"})
    <font color="blue">全員に公開</font>
  ({elseif $target_c_diary.public_flag == "friend"})
    <font color="red">({$WORD_MY_FRIEND_HALF})まで公開</font>
  ({/if})
  ({/strip})
({/if})<br>
<font color="blue">(閲覧:({$target_c_diary.etsuran_count})件)</font><br>
({if $target_c_diary.c_diary_id_prev})
<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$target_c_diary.c_diary_id_prev})&amp;({$tail})">&lt;&lt;前の日記</a>
({/if})
({if $target_c_diary.c_diary_id_next})
<a href="({t_url m=ktai a=page_fh_diary})&amp;target_c_diary_id=({$target_c_diary.c_diary_id_next})&amp;({$tail})"> 次の日記&gt;&gt;</a>
({/if})
<br>
<a href="#1"><font size="1" color="green">▼コメントへ</font></a>
</div>
<br>
({$target_c_diary.body|bbcode2html|t_replace_d|t_body:'kdiary'})<br>
<br>
({if $target_c_diary.image_filename_1})
<img src="({t_img_url filename=$target_c_diary.image_filename_1 w=76 h=76 noimg=no_image_small})">
<br>[<a href="({t_img_url filename=$target_c_diary.image_filename_1 w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$target_c_diary.image_filename_1 w=360 h=360 f=jpg})">大</a>]<br>
({/if})
({if $target_c_diary.image_filename_2})
画像2を見る:[<a href="({t_img_url filename=$target_c_diary.image_filename_2 w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$target_c_diary.image_filename_2  w=360 h=360 f=jpg})">大</a>]<br>
({/if})
({if $target_c_diary.image_filename_3})
画像3を見る:[<a href="({t_img_url filename=$target_c_diary.image_filename_3 w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$target_c_diary.image_filename_3  w=360 h=360 f=jpg})">大</a>]<br>
({/if})
({if $target_diary_writer.c_member_id==$u})
[<a href="({t_url m=ktai a=page_h_diary_edit})&amp;target_c_diary_id=({$target_c_diary.c_diary_id})&amp;({$tail})">日記を編集</a>]<br>
[<a href="({t_url m=ktai a=page_h_diary_edit_image})&amp;target_c_diary_id=({$target_c_diary.c_diary_id})&amp;({$tail})">画像を編集</a>]<br>
[<a href="({t_url m=ktai a=page_fh_diary_delete_c_diary_confirm})&amp;target_c_diary_id=({$target_c_diary.c_diary_id})&amp;({$tail})">日記を削除</a>]<br>
({/if})
({counter name="aa" start=0 print=0})({counter name="bb" start=1 print=0})
<hr>
<a name="comment"></a>
■ｺﾒﾝﾄを書く
({t_form m=ktai a=do_fh_diary_insert_c_diary_comment})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_diary_id" value="({$target_c_diary.c_diary_id})">
<font color=red>({if $msg})({$msg})<br>({/if})</font>
<textarea name="body"></textarea><br>
<input type="submit" value="書き込む">
</form><br>
<a href="mailto:({$mail_address})">メール投稿</a><br>
(画像も添付できます)
<hr>
■ｺﾒﾝﾄ
({if $c_diary_comment})
[({$total_num})]件<hr>
<div align="center">({$page_link|smarty:nodefaults})</div>
<hr>
({foreach from=$c_diary_comment item=c_diary_comment_})
  <a name="({counter name="aa"})"></a>
  <a href="#({counter name="bb"})">▼</a>
  ({$c_diary_comment_.r_datetime|date_format:"%m/%d %H:%M"})<br>
  <b><a href="({t_url m=ktai a=page_fh_diary_insert_comment_add})&amp;target_c_diary_id=({$target_c_diary.c_diary_id})&amp;({$tail})&amp;body=&gt;&gt;({$c_diary_comment_.comment_number})({$c_diary_comment_.nickname})さん">({$c_diary_comment_.comment_number})</a></b>&nbsp;({if $c_diary_comment_.nickname})
  <a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$c_diary_comment_.c_member_id})&amp;({$tail})">({$c_diary_comment_.nickname|t_body:'name'})</a>({/if}) ({if $c_diary_comment_.c_member_id == $u || $target_diary_writer.c_member_id==$u})
  [<a href="({t_url m=ktai a=page_fh_diary_delete_c_diary_comment_confirm})&amp;target_c_diary_comment_id=({$c_diary_comment_.c_diary_comment_id})&amp;({$tail})&amp;target_c_diary_id=({$target_c_diary.c_diary_id})">削除</a>]
  ({/if})<br>
  ({$c_diary_comment_.body|bbcode2html|t_replace_d|t_body:'kdiary'|default:"&nbsp;"})
  <br>
  ({if $c_diary_comment_.image_filename_1})
<img src="({t_img_url filename=$c_diary_comment_.image_filename_1 w=76 h=76 noimg=no_image_small})">
<br><a href="({t_img_url filename=$c_diary_comment_.image_filename_1 w=360 h=360 f=jpg})">大</a>]<br>
({/if})
  ({if $c_diary_comment_.image_filename_2})
  画像2を見る:[<a href="({t_img_url filename=$c_diary_comment_.image_filename_2 w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$c_diary_comment_.image_filename_2 w=360 h=360 f=jpg})">大</a>]<br>
  ({/if})
  ({if $c_diary_comment_.image_filename_3})
  画像3を見る:[<a href="({t_img_url filename=$c_diary_comment_.image_filename_3 w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$c_diary_comment_.image_filename_3 w=360 h=360 f=jpg})">大</a>]<br>
  ({/if})
  <br>
({/foreach})
<hr>
<div align="center">({$page_link|smarty:nodefaults})</div><hr>

<div align="right">({t_form m=ktai a=page_fh_diary})
表示件数</font><select name="page_size">
<option value="3"({if $page_size == "3"}) selected ({/if})>3件</option>
<option value="5"({if $page_size == "5"}) selected ({/if})>5件</option>
<option value="7"({if $page_size == "7"}) selected ({/if})>7件</option>
<option value="10"({if $page_size == "10"}) selected ({/if})>10件</option>
</select><input type="submit" value="変更">
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_diary_id" value="({$target_c_diary.c_diary_id})">
</form>
</div>
({/if})
<font size="1">
<div align="right"><a href="#comment">△コメント入力</a></div>
<hr>
<a href="({t_url m=ktai a=page_fh_diary_list})&amp;target_c_member_id=({$target_diary_writer.c_member_id})&amp;({$tail})">({$target_diary_writer.nickname|t_body:'name'})さんの日記ﾘｽﾄ</a><br>
</font>
({$inc_ktai_footer|smarty:nodefaults})

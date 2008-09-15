({$inc_ktai_header|smarty:nodefaults})

<center><font color="orange">コメントの登録</font></center>
<hr>
<font color="red">({$msg})<br></font>
<div><font color="blue">■以下の内容で登録します</font></div>
({t_form m=ktai a=page_fh_diary_insert_comment_confirm})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_diary_id" value="({$target_c_diary_id})">
<textarea name="body">({$body})</textarea><br>
<div align="center"><input type="submit" value="書き込む"></div></form>
<div align="center">({t_form m=ktai a=page_fh_diary})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_diary_id" value="({$target_c_diary_id})">
<input type="submit" value="日記に戻る"></form></div>
<hr>
({$inc_ktai_footer|smarty:nodefaults})

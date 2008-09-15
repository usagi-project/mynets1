({$inc_ktai_header|smarty:nodefaults})

<center><font color="orange">コメントの確認</font></center>
<hr>
<div><font color="blue">■以下の内容で登録します</font></div>
({$body|t_body:'kdiary'|default:"&nbsp;"})<br>
({t_form m=ktai a=do_fh_diary_insert_c_diary_comment})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_diary_id" value="({$target_c_diary_id})">
<input type="hidden" name="body" value="({$body})">
<div align="center"><input type="submit" value="登録する"></div>
</form>
({t_form m=ktai a=page_fh_diary})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_diary_id" value="({$target_c_diary_id})">
<div align="center"><input type="submit" value="日記に戻る"></div>
</form>
({t_form m=ktai a=page_fh_diary_insert_comment_add})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_diary_id" value="({$target_c_diary_id})">
<input type="hidden" name="body" value="({$body})">
<div align="center"><input type="submit" value="修正する"></div>
</form>

<hr>
({$inc_ktai_footer|smarty:nodefaults})

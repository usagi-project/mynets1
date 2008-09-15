({$inc_ktai_header|smarty:nodefaults})

<center><font color="orange">画像削除</font></center>
<hr>
<br>
画像({$del_img})[<a href="({t_img_url filename=$image_filename w=120 h=120 f=jpg})">小</a>/<a href="({t_img_url filename=$image_filename w=360 h=360 f=jpg})">大</a>]を削除しますか？<br>
<br>
({t_form m=ktai a=do_h_diary_edit_delete_image})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_diary_id" value="({$target_c_diary_id})">
<input type="hidden" name="del_img" value="({$del_img})">
<input type="submit" value="削除">
</form>
<br>
[<a href="({t_url m=ktai a=page_h_diary_edit_image})&amp;target_c_diary_id=({$target_c_diary_id})&amp;({$tail})">ｷｬﾝｾﾙして戻る</a>]<br>
<br>
({$inc_ktai_footer|smarty:nodefaults})
({$inc_ktai_header|smarty:nodefaults})

<center><font color="orange">伝言板コメント削除確認</font></center>
<hr>
本当に削除しますか？<br>

({t_form m=ktai a=do_fh_dengon_delete_c_dengon_comment})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="target_c_dengon_comment_id" value="({$target_c_dengon_comment_id})">
<input type="hidden" name="target_c_member_id_to" value="({$target_c_member_id_to})">
<input type="submit" value="削除">
</form>

<hr>
<a href="({t_url m=ktai a=page_fh_dengon})&amp;target_c_member_id_to=({$target_c_member_id_to})&amp;({$tail})">ｷｬﾝｾﾙして戻る</a><br>

({$inc_ktai_footer|smarty:nodefaults})

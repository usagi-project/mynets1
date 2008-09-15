({$inc_ktai_header|smarty:nodefaults})

<div align="center">ｱｸｾｽﾌﾞﾛｯｸ</div>
<hr>

({$block_member.nickname})を<font color="red">ｱｸｾｽﾌﾞﾛｯｸ</font>しますか？
<br>
({t_form m=ktai a=do_h_block_insert})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="block_member_id" value="({$block_member.c_member_id})">
<input type="radio" name="block_check" value="1">ﾌﾞﾛｯｸする<br>
<input type="radio" name="block_check" value="0" checked="checked">ﾌﾞﾛｯｸしない<br>
<input type="submit" value="送信">
</form>
<br>
<a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$block_member.c_member_id})&amp;({$tail})">({$block_member.nickname})のﾍﾟｰｼﾞ</a>へ<br>
<hr>
({$inc_ktai_footer|smarty:nodefaults})
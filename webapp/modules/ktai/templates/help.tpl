({$inc_ktai_header|smarty:nodefaults})
({if $msg})
<font color="red">({$msg})</font><br>
<br>
({/if})
({$inc_ktai_help|smarty:nodefaults})
<br>
前ﾍﾟｰｼﾞは&em_ktai;ﾊﾞｯｸﾎﾞﾀﾝで戻ってください。<br>
({t_form m=ktai a=do_help_mail})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
<input type="hidden" name="page" value="({$page})">
<input type="submit" value="このﾍﾙﾌﾟを&em_mail;で送信">
</form>
({$inc_ktai_footer|smarty:nodefaults})

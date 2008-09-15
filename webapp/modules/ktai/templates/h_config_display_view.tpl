({$inc_ktai_header|smarty:nodefaults})

<center><font color="orange">携帯画面デザイン変更</font></center>
<hr>
◆携帯電話の画面デザインを変更することが出来ます。<br>
<font color="red">※ﾉｰﾏﾙ画面以外は、機種によって正常に表示されないｹｰｽがあります。ご注意ください。</font><br>
<br>
({t_form m=ktai a=do_h_config_display_view_update})
<input type="hidden" name="ksid" value="({$PHPSESSID})">
現在のﾃﾞｻﾞｲﾝ：<br>
({$mydisplay.c_display_name})<br>
希望するﾃﾞｻﾞｲﾝ：<br>
<select name="c_display_view_id">
<option value="0">選択してください</option>
({foreach from=$ok_templates item=item})
<option value="({$item.c_display_view_id})">({$item.c_display_name})</option>
({/foreach})
</select><br>
<input type="submit" value="変更する"><br>
</form>

<hr>
<a href="({t_url m=ktai a=page_h_config})&amp;({$tail})">設定変更ﾒﾆｭｰへ</a><br>

({$inc_ktai_footer|smarty:nodefaults})
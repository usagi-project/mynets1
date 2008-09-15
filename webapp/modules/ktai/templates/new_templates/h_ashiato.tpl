({$inc_ktai_header|smarty:nodefaults})
<font size="1">
<center><font color="orange">あしあと</font></center>
<hr>

あなたのページを訪れた人たちです。<br>
<br>
総ｱｸｾｽ数: ({$c_ashiato_num})ｱｸｾｽ<br>

({foreach from=$c_ashiato_list item=item})
({$item.r_datetime|date_format:"%m/%d %H:%M"})
({if $item.mobile == 'mobile'})
&em_telephone;
({/if})
<table border="0" width="240">
  <tr bgcolor="({cycle values="#eeeeee,#d0d0d0"})">
    <td width="20" align="center"><font size="1">
    ({*if $item.image_filename*})
    <img src="({t_img_url filename=$item.image_filename w=36 h=36 f=jpg noimg=no_image_mini})">
    ({*else*})
    ({*/if*})
</font>
    </td>
    <td width="220"><font size="1">
    ({if $item.nickname|t_body:'name'})
    <a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$item.c_member_id_from})&amp;({$tail})">({$item.nickname|t_body:'name'})</a>({/if})
    ({if $item.is_mobile == 'mobile'})
&em_ktai;
({else})
&em_pc;
({/if})

    </font>
　  </td>
  </tr>
</table>
({/foreach})
</font>
({$inc_ktai_footer|smarty:nodefaults})
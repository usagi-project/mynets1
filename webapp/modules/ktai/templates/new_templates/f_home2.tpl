({$inc_ktai_header|smarty:nodefaults})

<div id="top"></div>

<table border="" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#E7E7E7" width="240">
  <tr>
    <td width="100%" bgcolor="#C0C0C0" align="center"><font size="1">({$target_c_member.nickname|t_body:'name'})さんのプロフィール</font></td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#E7E7E7">
    <font size="1">
    ({strip})
    ({capture name="nick"})
    ニックネーム：({$target_c_member.nickname|t_body:'name'})<br>
    ({/capture})
    ({capture name="birth"})
    ({if $target_c_member.age !== NULL})年齢：({$target_c_member.age})歳<br>({/if})
    誕生日：({$target_c_member.birth_month})月({$target_c_member.birth_day})日<br>
    ({/capture})
    <hr size="1" color="#E7E7E7">
    ({foreach from=$target_c_member.profile key=key item=item})

    ({if !$_cnt_nick && $profile_list[$key].sort_order >= $smarty.const.SORT_ORDER_NICK
      && !$_cnt_birth && $profile_list[$key].sort_order >= $smarty.const.SORT_ORDER_BIRTH})
    ({counter assign="_cnt_nick"})
    ({counter assign="_cnt_birth"})
    ({if $smarty.const.SORT_ORDER_NICK > $smarty.const.SORT_ORDER_BIRTH})
    ({$smarty.capture.birth|smarty:nodefaults})
    ({$smarty.capture.nick|smarty:nodefaults})
    ({else})
    ({$smarty.capture.nick|smarty:nodefaults})
    ({$smarty.capture.birth|smarty:nodefaults})
    ({/if})
    ({/if})

    ({if !$_cnt_nick && $profile_list[$key].sort_order >= $smarty.const.SORT_ORDER_NICK})
    ({counter assign="_cnt_nick"})
    ({$smarty.capture.nick|smarty:nodefaults})
    ({/if})

    ({if !$_cnt_birth && $profile_list[$key].sort_order >= $smarty.const.SORT_ORDER_BIRTH})
    ({counter assign="_cnt_birth"})
    ({$smarty.capture.birth|smarty:nodefaults})
    ({/if})

    ({if $item.value})
    ({$item.caption})：

    ({if $item.form_type == 'textarea'})
        <br>({$item.value|nl2br|t_body:'kdiary'})
    ({elseif $item.form_type == 'checkbox'})
        ({$item.value|@t_implode:", "})
    ({else})
        ({$item.value})
    ({/if})
    <hr size="1" color="#FFFFFF">
    ({/if})
    ({/foreach})

    ({if !$_cnt_nick && !$_cnt_birth})
    ({if $smarty.const.SORT_ORDER_NICK > $smarty.const.SORT_ORDER_BIRTH})
    ({$smarty.capture.birth|smarty:nodefaults})
    ({$smarty.capture.nick|smarty:nodefaults})
    ({else})
    ({$smarty.capture.nick|smarty:nodefaults})
    ({$smarty.capture.birth|smarty:nodefaults})
    ({/if})
    ({else})
    ({if !$_cnt_nick})({$smarty.capture.nick|smarty:nodefaults})({/if})
    ({if !$_cnt_birth})({$smarty.capture.birth|smarty:nodefaults})({/if})
    ({/if})

    ({/strip})
    </font>
    </td>
  </tr>
</table>
<font size="1">
<div align="right"><a href="({t_url m=ktai a=page_f_home})&amp;target_c_member_id=({$target_c_member.c_member_id})&amp;({$tail})">({$target_c_member.nickname|t_body:'name'})さんのページへ</a></div></font>
<hr>
({$inc_ktai_footer|smarty:nodefaults})

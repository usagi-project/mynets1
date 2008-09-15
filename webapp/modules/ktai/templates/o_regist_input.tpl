({$inc_ktai_header|smarty:nodefaults})({strip})

<center>({$smarty.const.SNS_NAME})登録</center>
({if $ses_vars.errors})
<hr>
<font color="red">エラー</font>
<hr>
({foreach from=$ses_vars.errors item=item})
({$item|smarty:nodefaults})<br>
({/foreach})
({/if})
<hr>
以下の項目を入力して、登録を完了してください。<br>
<br>

({*t_form m=ktai a=do_o_insert_c_member _attr='utn'*})
<form method="post" action="./?m=ktai&amp;a=do_o_insert_c_member&amp;guid=ON">
<input type="hidden" name="ses" value="({$ses})">
<input type="hidden" name="regist_ksid" value="({$regist_ksid})">

({capture name="nick"})
<font color="red">*</font>ニックネーム<br>
<input type="text" name="nickname" value="({$ses_vars.prof.nickname})"><br>
({/capture})
({capture name="birth"})
<font color="red">*</font>生まれた年<br>
<input type="text" name="birth_year" size="4" maxlength="4" istyle="4" mode="numeric" value="({$ses_vars.prof.birth_year})">年<br>
<select name="public_flag_birth_year">
    ({foreach from=$public_flags key=key item=item})
    <option value="({$key})"({if $ses_vars.prof.public_flag_birth_year == $key}) selected="selected"({/if})>({$item})
    ({/foreach})
</select><br>

<font color="red">*</font>誕生日<br>
<select name="birth_month">
    <option value=""({if !$ses_vars.prof.birth_month}) selected="selected"({/if})>--
    ({foreach from=$month_list item=item})
    <option value="({$item})"({if $ses_vars.prof.birth_month==$item}) selected="selected"({/if})>({$item})
    ({/foreach})
</select>月<br>
<select name="birth_day">
    <option value=""({if !$ses_vars.prof.birth_day}) selected="selected"({/if})>--
    ({foreach from=$day_list item=item})
    <option value="({$item})"({if $ses_vars.prof.birth_day==$item}) selected="selected"({/if})>({$item})
    ({/foreach})
</select>日<br>
({/capture})

({foreach from=$profile_list item=profile})

({if !$_cnt_nick && $profile.sort_order >= $smarty.const.SORT_ORDER_NICK
  && !$_cnt_birth && $profile.sort_order >= $smarty.const.SORT_ORDER_BIRTH})
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

({if !$_cnt_nick && $profile.sort_order >= $smarty.const.SORT_ORDER_NICK})
({counter assign="_cnt_nick"})
({$smarty.capture.nick|smarty:nodefaults})
({/if})

({if !$_cnt_birth && $profile.sort_order >= $smarty.const.SORT_ORDER_BIRTH})
({counter assign="_cnt_birth"})
({$smarty.capture.birth|smarty:nodefaults})
({/if})

({if $profile.disp_regist})

    ({if $profile.is_required})<font color="red">*</font>({/if})
    ({$profile.caption})<br>

    ({if $profile.form_type == 'text'})
        <input type="text" name="profile[({$profile.name})]"  value="({$ses_vars.profile_list[$profile.name].value})">
    ({elseif $profile.form_type == 'textarea'})
        <textarea name="profile[({$profile.name})]">({$ses_vars.profile_list[$profile.name].value})</textarea>
    ({elseif $profile.form_type == 'select' || $profile.form_type == 'radio'})
        <select name="profile[({$profile.name})]">
            <option value="">選択してください
            ({foreach item=item from=$profile.options})
            <option value="({$item.c_profile_option_id})"({if $ses_vars.profile_list[$profile.name].value == $item.value}) selected="selected"({/if})>({$item.value|default:"--"})
            ({/foreach})
        </select>
    ({elseif $profile.form_type == 'checkbox'})
        <input type="hidden" name="profile[({$profile.name})][]" value="0">
        ({foreach item=item from=$profile.options name=check})
        <input type="checkbox" name="profile[({$profile.name})][]" value="({$item.c_profile_option_id})"({if $ses_vars.profile_list[$profile.name].value && in_array($item.value|smarty:nodefaults, $ses_vars.profile_list[$profile.name].value)}) checked="checked"({/if})>({$item.value|default:"--"})
        ({/foreach})
    ({/if})
    <br>

    ({if $profile.public_flag_edit})
    <select name="public_flag[({$profile.name})]">
        ({foreach from=$public_flags key=key item=item})
        ({if !$ses_vars.profile_list[$profile.name].public_flag})
        <option value="({$key})"({if $profile.public_flag_default==$key}) selected="selected"({/if})>({$item})
        ({else})
        <option value="({$key})"({if $ses_vars.profile_list[$profile.name].public_flag==$key}) selected="selected"({/if})>({$item})
        ({/if})
        ({/foreach})
    </select>
    <br>
    ({/if})

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

<br>
<font color="red">*</font>パスワード<br>
<input type="text" name="password" maxlength="12" istyle="3" mode="alphabet"><br>
<font color="red">※パスワードは6-12文字の半角英数で入力してください</font><br>

<br>
<font color="red">*</font>秘密の質問<br>
<select name="c_password_query_id">
    <option value="0">選択してください
    ({foreach from=$password_query_list key=key item=item})
    <option value="({$key})">({$item})
    ({/foreach})
</select><br>

<font color="red">*</font>秘密の質問の答え<br>
<input type="text" name="password_query_answer" value=""><br>
※パスワードを忘れた場合の確認に使用します。<br>
<br>
<input type="checkbox" name="easy_access" value="1" checked="checked">簡単ログインを有効にする
<br><br>

<input type="submit" value=" 登録 ">
</form>

({/strip})({$inc_ktai_footer|smarty:nodefaults})

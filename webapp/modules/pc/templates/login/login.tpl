<div id="container_login">
<div id="banner">
({$top_banner_html_before|smarty:nodefaults})
</div>

({* Login Form *})
({t_form _attr='name="login"' m=pc a=do_o_login})
<input type="hidden" name="login_params" value="({$requests.login_params})">
<input type="text" tabindex="1" name="username" id="username" class="text">
<input type="password" tabindex="2" name="password" id="password" class="text">
<div class="msg">
<input type="checkbox" tabindex="3" name="is_save" id="is_save" value="1" class="no_bg"><label for="is_save">次回から自動的にログイン</label><br>
<span class="password_query"><a href="({t_url m=pc a=page_o_password_query})">&gt;パスワードを忘れた方はこちらへ</a></span>
({if $SSL_SELECT_URL})
<br><a href="({$SSL_SELECT_URL})">({if $HTTPS})標準(http)({else})SSL(https)({/if})はこちら</a>
({/if})
</div>
<input type="image" tabindex="4" name="submit" src="./skin/dummy.gif" border="0" id="button_login" alt="ログイン">

({if !$IS_CLOSED_SNS && (($smarty.const.OPENPNE_REGIST_FROM) & ($smarty.const.OPENPNE_REGIST_FROM_PC))})
<a href="({t_url m=pc a=page_o_public_invite})" id="button_new_regist"><img src="./skin/dummy.gif" alt="新規登録"></a>
({/if})
</form>
</div>({* end of login_container *})

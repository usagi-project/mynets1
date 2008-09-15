            <h2 class="green style1">&nbsp;</h2>
                <form action="./" method="post" name="login" id="login">
                    <input type="hidden" name="m" value="pc" />
                    <input type="hidden" name="a" value="do_o_login" />
                    <input type="hidden" name="login_params" value="({$requests.login_params})">
                    <p>
                    <label>E-mail</label>
                    <input name="username" tabindex="1" value="" type="text" />
                    <label>Password</label>
                    <input name="password" tabindex="2" value="" type="password" />
                    <br />
                    <input type="checkbox" tabindex="3" name="is_save" id="is_save" value="1" class="check" />
            次回から自動的にログイン<br />
                    <input class="button" type="submit" value="Login" /><br />
                    </p>
                    <a href="({t_url m=pc a=page_o_password_query})">パスワードを忘れた方 &raquo;</a>
                </form>
                ({if !$smarty.const.IS_CLOSED_SNS && (($smarty.const.OPENPNE_REGIST_FROM) & ($smarty.const.OPENPNE_REGIST_FROM_PC))})
                <a href="({t_url m=pc a=page_o_public_invite})" id="button_new_regist">新規登録</a>
                ({/if})

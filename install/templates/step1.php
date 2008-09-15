<table cellspacing="2" cellpadding="1" style="margin: 20px;vertical-align:middle;width:480px">
    <tbody>
    <tr>
        <td colspan="2" style="text-align:center;">
        <h1>module &amp; parmission chk</h1></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center;">
        <p class="style2">必要なモジュールとパーミッションをチェックします。</p></td>
    </tr>
    <tr>
        <td style="text-align:right;width:120px">
        モジュール:</td>
        <td style="text-align:left;width:360px">
        <p>
        <? print $parm_err['GD']['msg']; ?><br />
        <? print $parm_err['mb_string']['msg']; ?><br />
        <? print $parm_err['mysql']['msg']; ?></p>
        </td>
    </tr>
    <tr>
        <td style="text-align:center" colspan="2">
        <p class="style2">パーミッションをチェックします。</p></td>
    </tr>
    <tr>
        <td style="text-align:right;whitespace:nowrap;width:120px;vertical-align:text-top;">
        書き込み権限が必要なフォルダー:</td>
        <td style="text-align:left;width:360px">
        <DIV style="background-color:#FFFFFF;
            height:350px;
            width:100%;
            overflow:auto;
            scrollbar-arrow-color:#800000;
            scrollbar-face-color:#FFFFFF;
            scrollbar-shadow-color:#800000;
            scrollbar-darkshadow-color:#800000;
            scrollbar-track-color:#800000;
            scrollbar-3dlight-color:#800000;
            scrollbar-highlight-color:#800000;">
        <? print $parm_err['dir']['msg']; ?>
        </div>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center;padding-top:10px;">
        
        <?php
        if ($parm_err['flag']) {
        ?>
        <form name="login_form" method="post" action="step2.php" target="_parent">
        <input type="hidden" name="task" value="step1" />
        <input type="hidden" name="set_language" value="<?= $set_language ?>" />
        <p class="GREEN fsxl">インストールできます。</p>
        <p class="style2">※インストーラーを中止する場合はブラウザを閉じて、手動で設定を行ってください。</p>
        <input type="button" value="次のステップへ" onclick="javascript:document.login_form.submit();" class="button" onmouseover="javascript:this.className='button_mo';" onmouseout="javascript:this.className='button';" style="width:100px;" />
        </form>
        </td>
    </tr>
        <?php
        } else {
        ?>
        <tr>
        <td colspan="2" style="text-align:center;padding-top:10px;">
        <form name="check_form" method="post" action="step1.php" target="_parent">
        <input type="hidden" name="task" value="step1" />
        <input type="hidden" name="set_language" value="<?= $set_language ?>" />
        <span class="style2">必須モジュールがないか、必要なディレクトリに書き込み権限がないため、このままではインストールできません。確認後インストーラーを実行してください。
        </span><br /><input type="submit" value="再実行" class="button" onmouseover="javascript:this.className='button_mo';" onmouseout="javascript:this.className='button';" style="width:100px;" />
        </form>
        </td>
    </tr>
        <?php
        }
        ?>
    </tbody>
</table>

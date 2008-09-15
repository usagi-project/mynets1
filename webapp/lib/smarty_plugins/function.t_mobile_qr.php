<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @project    UsagiProject 2006-2008
 * @package    MyNETS
 * @author     KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  KUNIHARU Tsujioka <author member ad http://usagi.mynets.jp/member.html>
 * @copyright  2006-2008 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS v 1.2.0
 * @chengelog  [2008/07/29] Ver1.2.0Nighty package
 * ========================================================================
 */

/**
 * モバイルのメールアドレス登録がない場合、空メール送信用のQR画像を表示する
 * @return string HTML
 */
function smarty_function_t_mobile_qr($params, &$smarty)
{
    if (! $params['view'])
    {
        return ;
    }
    $mail_address = "mbentry"."@".MAIL_SERVER_DOMAIN;
    $mail_address = urlencode(MAIL_ADDRESS_PREFIX) . $mail_address;
    $mobile_qrdata = $mail_address;
    return t_mobile_qr_gen($mobile_qrdata);
}

function t_mobile_qr_gen($mobile_qrdata)
{
    $html = <<<QRDOC
<!--
<div style="padding:3px;margin:1px;" class="bg_06">
    <img src="({t_img_url_skin filename=icon_title_1})" alt="メニューアイコンボタン" align="absmiddle">
        <span class="b_b c_00">メニューバー名</span>
</div>
-->
<table border="0" cellspacing="0" cellpadding="0" style="width:270px;margin:0px auto;" class="border_07" id="main_image_and_name">
    <tr>
        <td style="width:7px;height:7px;" class="bg_05">
            <img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy">
        </td>
        <td style="width:254px;height:7px;" class="bg_05">
            <img src="./skin/dummy.gif" style="width:254px;height:7px;" class="dummy">
        </td>
        <td style="width:7px;height:7px;" class="bg_05">
            <img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy">
        </td>
    </tr>
    <tr>
        <td class="bg_05">
            <img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy">
        </td>
        <td align="center" class="bg_02">
            <table border="0" cellspacing="0" cellpadding="0" style="width:252px;">
                <tr>
                    <td style="line-height:120%;">
                        <div class="border_01 bg_02 padding_s" align="left">
                            <img src="qr_img.php?d=({$mobile_qrdata})&amp;t=J&amp;s=3" align="left">
                            携帯アドレスをぜひ登録してください。<br>移動中などに携帯でSNSをご利用いただけます。<br>
                            QRを読み込んで空メールを送ってください<br>
                            <a href="./?m=pc&amp;a=page_h_config">設定画面</a>からでも携帯を登録できます。
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td class="bg_05"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    </tr>
    <tr>
        <td class="bg_05"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td class="bg_05"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
        <td class="bg_05"><img src="./skin/dummy.gif" style="width:7px;height:7px;" class="dummy"></td>
    </tr>
</table>
QRDOC;
return $html;
}
?>

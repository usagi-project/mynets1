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
 * アンケート結果表示プラグイン
 * @return string HTML
 */
function smarty_function_t_sns_question($params, &$smarty)
{
    return t_sns_question();
}

function t_sns_question()
{
    $html = <<<QUESDOC
<div style="padding:3px;margin:1px;" class="bg_06">
    <img src="./skin/default/img/icon_title_1.gif" alt="メニューアイコンボタン" align="absmiddle">
        <span class="b_b c_00">アンケート</span>
</div>
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
                    <td style="line-height:120%;width:50%;">
                        アンケートの内容
                    </td>
                    <td style="line-height:120%;text-align:left;">
                        <div>現在実施中のアンケート</div>
                        <div>アンケート題名</div>
                        <ul>
                            <li>すばらしい:100件</li>
                            <li>まあまあ:10件</li>
                            <li>いまいち:1件</li>
                            <li>だめじゃん:0件</li>
                        </ul>
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
QUESDOC;
return $html;
}
?>

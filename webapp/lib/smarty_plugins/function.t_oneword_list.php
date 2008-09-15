<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @category   Application of MyNETS
 * @project    UsagiProject 2006-2007
 * @package    MyNETS
 * @author     Naoya Shimada <info@usagi.mynets.jp>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  Naoya Shimada <author member ad http://usagi.mynets.jp/member.html>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.1.1
 * @since      File available since Release 1.1.1 Nighty
 * @chengelog  [2007/11/26] Ver1.1.1Nighty package
 * ========================================================================
 */

function smarty_function_t_oneword_list($params, &$smarty)
{
    require_once OPENPNE_WEBAPP_DIR . "/components/one_word.class.php";
    $oneword = new OneWord();

    $result = $oneword->getList();
    // 指定されたSmarty変数にセットして返す
    $smarty->assign('oneword_list', $result);
}
?>

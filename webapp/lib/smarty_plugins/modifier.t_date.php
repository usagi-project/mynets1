<?php

/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @project    OpenPNE UsagiProject 2006-2008
 * @package    MyNETS
 * @author     KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @chengelog  [2008/07/07]
 * ========================================================================
 */
/**
 * Smarty t_date modifier plugin
 *
 */
require_once $smarty->_get_plugin_filepath('shared','make_timestamp');
function smarty_modifier_t_date($string)
{
    //
    //日付を比較して、本日の場合は時間を、本日以前の場合は月日を表示する
    $today = date('Y-m-d 00:00:00', time());
    if ($string >= $today)
    {
        $format = '%H時%M分';
    }
    else
    {
        $format = '%m月%d日';
    }

    $default_date = null;
    if ($ts = smarty_make_timestamp($string)) {
        // UTF-8 日本語対応
        return preg_replace_callback('/\%[a-z\%]/iu',
                    create_function('$res', 'return strftime($res[0], '.$ts.');'),
                    $format);
    } elseif (!empty($default_date) && $ts = smarty_make_timestamp($default_date)) {
        return preg_replace_callback('/\%[a-z\%]/iu',
                    create_function('$res', 'return strftime($res[0], '.$ts.');'),
                    $format);
    } else {
        return;
    }

}

?>

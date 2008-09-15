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
 * @project    OpenPNE UsagiProject 2006-2007
 * @package    MyNETS
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ========================================================================
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */


/**
 * Smarty {ext_include} function plugin
 * 組み込み関数 include のextディレクトリ対応版
 *
 *   {include file="**"}
 *  なる部分を
 *   {ext_include file="**"}
 *  とすればOK
 */
function smarty_function_ext_include($params, &$smarty)
{
    $place = '';
    $template = $smarty->templates_dir . '/' . $params['file'];

    // 拡張ファイルチェック
    if (!$tpl = $smarty->ext_search($template, $place)) {
        $smarty->trigger_error('ext_include: tpl file not found. '.$template);
        return;
    }
    $tpl = 'file:' . $tpl;

    $params['smarty_include_tpl_file'] = $tpl;
    $params['smarty_include_vars'] = array();
    $smarty->_smarty_include($params);
    return;
}

?>

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
 * Smarty {t_loop}{/t_loop} block plugin
 * substitute for {foreach}{/foreach}
 * 
 * @param array $params
 *     from : array
 *     start: int
 *     max  : int
 *     item : text
 * @param  string $content
 * @param  object &$smarty
 * @param  bool   &$repeat
 * @return string
 */
function smarty_block_t_loop($params, $content, &$smarty, &$repeat)
{
    static $i = 0;

    // start
    if (intval($params['start']) > 0) {
        $start = intval($params['start']);
    } else {
        $start = 0;
    }

    // item
    if (empty($params['item'])) {
        $item = 'item';
    } else {
        $item = $params['item'];
    }

    // main
    if (is_null($content)) { // initialize
        $i = $start;

        if (!isset($params['from'][$i])) {
            $repeat = false;
        } else {
            $smarty->assign($item, $params['from'][$i++]);
            $repeat = true;
        }
    } else {
        $max = $start + $params['num'];

        if ($i >= $max) {
            $repeat = false;
            if ($i > $max) $content = '';
            unset($i);
        } else {
            $repeat = true;
            // assign the next one
            $smarty->assign($item, $params['from'][$i++]);
        }
        return $content;
    }
}

?>

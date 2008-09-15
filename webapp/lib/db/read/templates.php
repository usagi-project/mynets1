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
 *             [2007/03/03]
 * ========================================================================
 */

/*
 * 現在利用できるテンプレートファイル名を取得する
 * @param Ktai or pc
 * @return array
 */

if (! function_exists('getDisplayMobileTemplate'))
{
    function getDisplayMobileTemplate() {
        $sql = "SELECT * FROM " . MYNETS_PREFIX_NAME . "c_display_view WHERE is_pc = '0' ORDER BY c_display_view_id";
        return db_get_all($sql);
    }
}


if (! function_exists('getMyDisplay'))
{
    function getMyDisplay($c_display_view_id){
        $sql = "SELECT * from " . MYNETS_PREFIX_NAME . "c_display_view WHERE c_display_view_id = ?";
        return db_get_row($sql,array(intval($c_display_view_id)));
    }
}
?>

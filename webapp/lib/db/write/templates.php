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
 * 画面テンプレートを変更する　keitai
 * @param c_member_id
 * @param mobile_view
 * @return
 */

if (! function_exists('setDisplayViewMobile'))
{
    function setDisplayViewMobile($c_member_id,$mobile_view = 0)
    {
        $sql = "update " . MYNETS_PREFIX_NAME . "c_member set mobile_view='".intval($mobile_view)."'";
        $sql .= " WHERE c_member_id = ?";
        $params = intval($c_member_id);
        db_query($sql,array($params));
        return true;
    }
}
?>

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

/*
 * 日記のコメント番号を保存
 * @param c_diary_comment_id
 * @return true
 */

if (! function_exists('set_diary_comment_number4c_diary_comment_number'))
{
    function set_diary_comment_number4c_diary_comment_number($c_diary_comment_id) {

        $sql = "UPDATE " . MYNETS_PREFIX_NAME . "c_diary_coment "
             . "SET comment_number = " .get_diary_comment_number4c_diary_comment_number($c_diary_comment_id) ;
        $sql .= " WHERE c_diary_comment_id = ?";
        $params = intval($c_diary_comment_id);
        return db_query($sql, $params);
    }
}

?>

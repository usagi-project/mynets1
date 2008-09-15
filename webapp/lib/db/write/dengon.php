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
 * dengonコメント追加
 *
 * @param  int    $c_member_id_from
 * @param  int    $c_member_id_to
 * @param  string $body
 * @return int    insert_id
 */
if (! function_exists('db_dengon_insert_c_dengon_comment'))
{
    function db_dengon_insert_c_dengon_comment($c_member_id_from, $c_member_id_to, $body)
    {
        $data = array(
            'c_member_id_from' => intval($c_member_id_from),
            'c_member_id_to' => intval($c_member_id_to),
            'body' => $body,
            'r_datetime' => db_now(),
        );
        return db_insert(MYNETS_PREFIX_NAME . 'c_dengon_comment', $data);
    }
}

/**
 * でんごんコメント削除
 *
 * @param   int $c_dengon_comment_id
 * @param   int $u  : 削除しようとしている人の c_member_id_from
 */
if (! function_exists('db_dengon_delete_c_dengon_comment'))
{
    function db_dengon_delete_c_dengon_comment($c_dengon_comment_id, $u)
    {
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_dengon_comment WHERE c_dengon_comment_id = ?';
        $params = array(intval($c_dengon_comment_id));
        return db_query($sql, $params);
    }
}

?>

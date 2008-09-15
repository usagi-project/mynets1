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
 *             [2007/02/28] Tabele Prefix
 * ========================================================================
 */

/*
 * 日記の最大のコメント番号を取得する
 * @param c_diary_id
 * @return int comment_number
 */

if (! function_exists('getDiaryCommentNumber'))
{
    function getDiaryCommentNumber($c_diary_id) {
        $sql = "SELECT MAX(comment_number) FROM ".MYNETS_PREFIX_NAME."c_diary_comment";
        $sql .= " WHERE c_diary_id = ?";

        $params = intval($c_diary_id);
        return  db_get_one($sql,$params) ;
    }
}


/**
 * 次の書き込み番号取得
 *
 * @param  int $c_commu_topic_id
 * @return int 次の書き込み番号
 */
if (! function_exists('getDiaryCommentMaxNumber'))
{
    function getDiaryCommentMaxNumber($c_diary_id)
    {
        return getDiaryCommentNumber($c_diary_id) + 1;
    }
}

?>

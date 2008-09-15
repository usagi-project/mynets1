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

//会員退会時、データを保存する
//2007/05/01 KT

/**
 * 退会者のデータを保存する
 *@param c_member_id       退会者の会員ID
 *@param delete_comment     退会時のコメント
 *@param delete_flag        自主退会＝０、強制退会＝１
 */
if (! function_exists('setDeleteMemberData'))
{
    function setDeleteMemberData($c_member_id,$delete_comment,$delete_flag = 0)
    {
        //退会者の情報を取得
        $delete_member = db_common_c_member4c_member_id($c_member_id,true);
        $ip_address = $_SERVER[SERVER_IP_KEY];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $delete_datetime = db_now();

        $data = array(
            'c_member_id' => intval($c_member_id),
            'nickname' => $delete_member['nickname'],
            'pc_address' => $delete_member['secure']['pc_address'],
            'ktai_address' => $delete_member['secure']['ktai_address'],
            'easy_access_id' => $delete_member['secure']['easy_access_id'],
            'regist_address' => $delete_member['secure']['regist_address'],
            'delete_flag' => intval($delete_flag),
            'delete_datetime' => db_now(),
            'regist_datetime' => $delete_member['r_date'],
            'delete_comment' => $delete_comment,
            'ip_address' => $ip_address,
            'user_agent' => $user_agent,
            'c_member_id_invite' => intval($delete_member['c_member_id_invite']),
        );

        return db_insert(MYNETS_PREFIX_NAME . 'c_delete_member_data', $data);
    }
}


?>

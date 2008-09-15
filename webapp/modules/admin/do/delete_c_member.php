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

// メンバー強制退会
class admin_do_delete_c_member extends OpenPNE_Action
{
    function execute($requests)
    {
        //強制退会の場合の退会者データ保存
        if (!$requests['comment']) {
            $comment = "管理者による強制退会処理";
        } else {
            $comment = $requests['comment'];
        }
        
        setDeleteMemberData($requests['target_c_member_id'],$comment,1);
        db_common_delete_c_member($requests['target_c_member_id']);

        admin_client_redirect('top', 'メンバーの強制退会を完了しました');
    }
}

?>

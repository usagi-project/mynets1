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

// 強制参加させるコミュニティ情報追加
class admin_do_update_c_commu_is_regist_join extends OpenPNE_Action
{
    function handleError($errors)
    {
        admin_client_redirect('manage_c_commu', '正しく入力してください');
    }

    function execute($requests)
    {
        db_commu_update_is_regist_join($requests['target_c_commu_id'], $requests['value']);
        admin_client_redirect('manage_c_commu', 'コミュニティ一覧を更新しました');
    }
}

?>

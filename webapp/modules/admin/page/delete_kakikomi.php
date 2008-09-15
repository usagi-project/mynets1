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

// 書き込み削除
class admin_page_delete_kakikomi extends OpenPNE_Action
{
    function handleError($errors)
    {
        admin_client_redirect('delete_kakikomi', '正しく入力してください');
    }

    function execute($requests)
    {
        $v = array();

        if ($requests['target_c_diary_id']) {
            $v['c_diary'] = db_diary_get_c_diary4id($requests['target_c_diary_id']);
        }

        if ($requests['target_c_commu_id']) {
            $v['c_commu'] = _db_c_commu4c_commu_id($requests['target_c_commu_id']);
        }

        if ($requests['target_c_commu_topic_id']) {
            $v['c_commu_topic'] = c_topic_detail_c_topic4c_commu_topic_id($requests['target_c_commu_topic_id']);
        }

        $this->set($v);
        return 'success';
    }
}

?>

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

require_once OPENPNE_WEBAPP_DIR . "/components/count/commu/count_commu_count.class.php";

/**
 * コミュニティ作成
 */
class pc_do_h_com_add_insert_c_commu extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $name = $requests['name'];
        $c_commu_category_id = $requests['c_commu_category_id'];
        $body = $requests['body'];
        $public_flag = $requests['public_flag'];
        $open_flag = $requests['open_flag'];
        $tmpfile = $requests['tmpfile'];
        // ----------

        // コミュニティ作成
        $c_commu_id = db_commu_insert_c_commu($u, $name, $c_commu_category_id, $body,
                                                $public_flag, $open_flag);

        if ($tmpfile) {
            $filename = image_insert_c_image4tmp("c_{$c_commu_id}", $tmpfile, $u);
            t_image_clear_tmp(session_id());

            // 画像更新
            if ($filename) {
                db_commu_update_c_commu_image_filename($c_commu_id, $filename);
            }
        }

        //作成者をコミュメンバーにする
        do_inc_join_c_commu($c_commu_id, $u);

        //2008-03-11 DiaryCount処理を追加 kuniharu Tsujioka
        $datacount = new Commu_Count('commu_count', $u);
        $datacount->addCount();
        //**************************************************

        $p = array('target_c_commu_id' => $c_commu_id);
        openpne_redirect('pc', 'page_c_home', $p);
    }
}

?>

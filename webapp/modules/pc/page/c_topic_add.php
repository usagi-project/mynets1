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

class pc_page_c_topic_add extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_commu_id = $requests['target_c_commu_id'];
        $title = $requests['title'];
        $body = $requests['body'];
        $event_flag = $requests['event_flag'];
        $open_flag = $requests['open_flag'];
        $err_msg = $requests['err_msg'];
        // ----------

        if ($event_flag == 1) {
            $p = array('target_c_commu_id' => $c_commu_id);
            openpne_redirect('pc', 'page_c_event_add', $p);
        }

        //--- 権限チェック
        //コミュニティメンバー
        if (!_db_is_c_commu_member($c_commu_id, $u)) {
            $_REQUEST['target_c_commu_id'] = $c_commu_id;
            $_REQUEST['msg'] = "トピック作成を行うにはコミュニティに参加する必要があります";
            openpne_forward('pc', 'page', "c_home");
            exit;
        }

        $this->set('inc_navi', fetch_inc_navi("c", $c_commu_id));
        $c_commu = p_c_home_c_commu4c_commu_id($c_commu_id);
        $this->set("c_commu", $c_commu);
        //--- 権限チェック
        //このコミュのトピック作成権限がどうなっているのか
        switch ($c_commu['topic_authority_role'])
        {
            case 1:             //指定のユーザーおよび管理者が作成可能
                if (_db_is_c_commu_topic_admin($c_commu_id, $u) < 1
                    && _db_is_c_commu_admin($c_commu_id, $u) < 1 )
                {
                    $_REQUEST['target_c_commu_id'] = $c_commu_id;
                    $_REQUEST['msg'] = "トピック作成を行うには管理者から指定されたメンバーしか行えません";
                    openpne_forward('pc', 'page', "c_home");
                    exit;
                }
                break;
            case 99:            //管理者のみ作成可能 2008-09-01 KUNIHARU Tsujioka update intval()での評価へ
                if (intval($c_commu['c_member_id_admin']) !== intval($u))
                {
                    $_REQUEST['target_c_commu_id'] = $c_commu_id;
                    $_REQUEST['msg'] = "トピック作成を行うには管理者しか行えません";
                    openpne_forward('pc', 'page', "c_home");
                    exit;
                }
                break;
            default:            //メンバーであればだれでも作成可能
                break;
        }

        $this->set('err_msg', $err_msg);

        $this->set('title', $title);
        $this->set('body', $body);
        $this->set('open_flag', $open_flag);

        return 'success';
    }
}

?>

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

class pc_page_h_com_add extends OpenPNE_Action
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
        $err_msg = $requests['err_msg'];
        // ----------

        $form_val=array(
            'name'=>$name,
            'c_commu_category_id'=>$c_commu_category_id,
            'body'=>$body,
            'public_flag'=>$public_flag,
            'open_flag' => $open_flag,
        );

        $this->set('inc_navi', fetch_inc_navi('h'));

        $c_commu_category_list = _db_c_commu_category4null();
        $this->set("c_commu_category", $c_commu_category_list);

        $public_flag_list=
        array(
            'public' =>'参加：誰でも参加可能、掲示板：全員に公開',
            'auth_sns' =>'参加：管理者の承認が必要、掲示板：全員に公開',
            'auth_commu_member' =>'参加：管理者の承認が必要、掲示板：コミュニティ参加者にのみ公開',
        );

        $this->set("c_commu_category_list", $c_commu_category_list);
        $this->set("public_flag_list", $public_flag_list);
        $this->set("form_val", $form_val);

        $this->set('err_msg', $err_msg);

        /////AA local var samples AA//////////////////////////
        return 'success';
    }
}

?>

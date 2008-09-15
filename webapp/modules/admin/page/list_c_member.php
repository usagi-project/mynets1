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

// メンバー情報のリスト表示・強制退会
class admin_page_list_c_member extends OpenPNE_Action
{
    function execute($requests)
    {
        $cond = substr($_REQUEST['cond'], 1);
        $temp_list = explode('&', $cond);
        foreach ($temp_list as $value) {
            $temp_list2 = explode('=', $value);
            $_REQUEST[$temp_list2[0]] = $temp_list2[1];
        }

        $v = array();
        $pager = array();

        //絞り込み条件作成
        $cond_list = validate_cond($_REQUEST);
        $v['cond_list'] = $cond_list;

        $cond = '';
        foreach ($cond_list as $key => $value) {
            $cond .= '&'.$key.'='.$value;
        }

        $v['cond'] = $cond;

        //絞り込みのための年
        $v['years'] = get_int_assoc(1901, 2001);

        //絞り込みのドロップダウンを作る用
        $v['profile_list'] = db_common_c_profile_list();;

        //開始年が終了年より大きい
        if ( !empty($cond_list['s_year']) && !empty($cond_list['e_year']) && ($cond_list['s_year'] > $cond_list['e_year']) ) {
            $v['msg'] = '※開始年は終了年より小さくして下さい';
        }

        $v['SNS_NAME'] = SNS_NAME;
        $v['c_profile_list'] = db_common_c_profile_list4null();
        if ($requests['mail_address']) {
            $v['c_member_list'] = db_admin_c_member4mail_address($requests['mail_address']);
        } else {
            $v['c_member_list'] = _db_admin_c_member_list($requests['page'], $requests['page_size'], $pager, $cond_list);
        }
        foreach ($v['c_member_list'] as $key => $value) {
            $v['c_member_list'][$key]['c_member_invite'] =
                db_common_c_member4c_member_id_LIGHT($value['c_member_id_invite']);
        }

        $v['pager'] = $pager;
        $this->set($v);
        return 'success';
    }
}

?>

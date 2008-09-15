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
 *             [2007/07/30] 
 * ========================================================================
 */


class qrentry_page_qr_regist extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }
    
    function execute($requests)
    {
        //時間の取得
        $limittime = $requests['ltime'];
        //紹介者のID取得
        $c_member_id_invite = $requests['iu'];
        //有効時間（分）の取得
        $check_minit = $requests['ct'];
        $ses = $requests['ses'];

        //有効時間のチェック
        $dtime = time() - intval($limittime);
        if ($dtime < intval($check_minit*60)) {
            $msg = "";
            do_insert_c_member_ktai_pre($ses, "", $c_member_id_invite);
        } else {
            $msg = "有効時間を過ぎています。";
        }
        $this->set("msg",$msg);
        $this->set("c_member_id_invite",$c_member_id_invite);
        $this->set("ses",$ses);
        
        return 'success';

    }
}

?>

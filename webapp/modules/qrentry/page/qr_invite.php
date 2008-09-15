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
 *             [2007/09/12] 
 * ========================================================================
 */


class qrentry_page_qr_invite extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        if (!IS_USER_INVITE) {
            ktai_display_error(SNS_NAME . 'では、メンバーによる招待は行えません');
        }
        //時間の設定
        //接続先URL qr_regist.php
        $chktime = 30;
        $session = create_hash();
        $ses = $session;
        $src = OPENPNE_URL."?m=qrentry&a=page_qr_regist&iu=".$u."&ltime=".time()."&ct=".$chktime."&ses=".$ses;
        $this->set("linkurl",$src);
        //QR接続の種別
        //1は新規登録,2はフレンドリンク,3はコミュニティ初期登録付きの新規登録
        $this->set("qrparam","1");
        return 'success';

    }
}

?>

<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @category   MyNETS
 * @project    UsagiProject 2006-2008
 * @package    [[パッケージ名またはスクリプト名]]
 * @author     KUNIHARU Tsujioka <author@example.com>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  KUNIHARU Tsujioka
 * @copyright  2006-2008 UsagiProject <author member ad  http://usagi.mynets.jp/member.html>
 * @version
 * @chengelog
 * ========================================================================
 */

/**
 * [[機能説明]]
 *
 * @access  public
 */

//require_once '';

class ktai_page_o_regist_mobileaddress_end extends OpenPNE_Action
{
    /**
     * 認証を行わない
     */
    function isSecure()
    {
        return false;
    }

    function execute($requests)
    {

        //=======================================
        //request parameters get
        //=======================================
        //ここでリクエストパラメータを取得する
        $end_msg  = '携帯アドレスの設定を完了しました。<br>';
        $end_msg .= '携帯ログイン画面からログインしてください。<br>';
        $end_msg .= '尚簡単ログインIDは設定していませんので、設定変更＞簡単ログインID設定を行ってください。<br><br>';
        $end_msg .= '<a href="./">'.SNS_NAME.' ログイン画面へ移動する</a>';

        //=======================================
        //logic block
        //=======================================
        //ここでビジネスロジックを記述する


        //=======================================
        //template assign block
        //=======================================
        //ここでテンプレートへ変数をセットする
        //$this->set('[[パラメータ名]]', [[セットするパラメータ変数]]);
        $this->set('end_msg', $end_msg);
        return 'success';

    }
}
?>

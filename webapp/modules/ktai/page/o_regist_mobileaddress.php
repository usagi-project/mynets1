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
 * @author     KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  KUNIHARU Tsujioka
 * @copyright  2006-2008 UsagiProject <author member ad  http://usagi.mynets.jp/member.html>
 * @version
 * @chengelog  2008-08-01
 * ========================================================================
 */

/**
 * QRを読み込んで自分の携帯アドレスを登録する機能
 *
 * @access  public
 */

//require_once '';

class ktai_page_o_regist_mobileaddress extends OpenPNE_Action
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

        $from_address = $requests['from_address'];
        $kad          = $requests['kad'];
        //=======================================
        //logic block
        //=======================================
        //ここでビジネスロジックを記述する
        $ktaiad = t_decrypt($kad);
        $error = array();
        if (!is_ktai_mail_address($ktaiad))
        {
            $error['address_error'] = 'アドレスが携帯のアドレスでは無いか、または取得できませんでした';
        }
        //すでに登録されているかどうかをチェック
        else if ( (bool)_db_c_member_id4ktai_address_encrypted($ktaiad))
        {
            $error['address_ismember'] = 'その携帯アドレスは既に登録されています';
        }
        //=======================================
        //template assign block
        //=======================================
        //ここでテンプレートへ変数をセットする
        //$this->set('[[パラメータ名]]', [[セットするパラメータ変数]]);
        $this->set('error', $error);
        if (! $from_address)
        {
            $this->set('from_address', $ktaiad);
        }
        else
        {
            $this->set('from_address', $from_address);
        }

        return 'success';

    }
}
?>

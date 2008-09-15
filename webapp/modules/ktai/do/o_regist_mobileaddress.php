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
 * @chengelog  2008-08-01
 * ========================================================================
 */

/**
 * PCID、パスワードを認証し携帯アドレスをセットする
 *
 * @access  public
 */

//require_once '';

class ktai_do_o_regist_mobileaddress extends OpenPNE_Action
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
        $username = $requests['username'];
        $password = $requests['password'];

        //=======================================
        //logic block
        //=======================================
        //ここでビジネスロジックを記述する
        $p = array();
        $msg = '';
        if (! $from_address)
        {
            $msg = '携帯アドレスが取得できませんでした';
        }
        if (! $username)
        {
            $msg .= 'ID(PCアドレス)が未入力です<br>';
        }
        if (! $password)
        {
            $msg .= 'パスワードが未入力です';
        }
        //アカウントをチェックする

        if ($msg)
        {
            $p['msg'] = $msg;
            openpne_redirect('ktai', 'page_o_regist_mobileaddress', $p);
        }

        //携帯のアドレスを登録する
        $c_member_id = $this->_checkUser($username, $password);
        if ($c_member_id >= 1)
        {
            k_do_update_ktai_address($c_member_id, $from_address);
        }
        else
        {
            $p['msg'] = '携帯アドレスの設定に失敗しました。もう一度行ってください。';
            openpne_redirect('ktai', 'page_o_regist_mobileaddress', $p);
        }
        //=======================================
        //template assign block
        //=======================================
        //ここでテンプレートへ変数をセットする
        //$this->set('[[パラメータ名]]', [[セットするパラメータ変数]]);


        //リダイレクトする先を記述
        openpne_redirect('ktai', 'page_o_regist_mobileaddress_end');

    }

    function _checkUser($username, $password)
    {
        $sql = "SELECT "
                    . "c_member_id "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_member_secure "
             . "WHERE "
                    . "pc_address = ? "
             . "AND "
                    . "hashed_password = ? ";
        $params = array(strval(t_encrypt($username)), strval(md5($password)));
        $result = db_get_one($sql, $params);
        if ($result >= 1)
        {
            return $result;
        }
        else
        {
            return FALSE;
        }
    }
}
?>

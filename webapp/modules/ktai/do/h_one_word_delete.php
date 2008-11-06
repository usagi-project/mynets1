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

require_once OPENPNE_WEBAPP_DIR . '/components/one_word.class.php';

class ktai_do_h_one_word_delete extends OpenPNE_Action
{

    function execute($requests)
    {

        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        //=======================================
        //request parameters get
        //=======================================
        //ここでリクエストパラメータを取得する
        $c_one_word_id = $requests['c_one_word_id'];

        //=======================================
        //logic block
        //=======================================
        //ここでビジネスロジックを記述する
        $error = '';

        if ( ! $c_one_word_id)
        {
            $error = 'IDが不正です';
        }
        else
        {
            $oneword = new OneWord();
            //存在確認
            if ( ! $oneword->getWord($c_one_word_id))
            {
                $error = '指定のデータが見つかりません';
            }
            else
            {
                $oneword->setUid($u);
                $oneword->setOid($c_one_word_id);
                $oneword->delete();
            }
        }
        //=======================================
        //template assign block
        //=======================================
        //ここでテンプレートへ変数をセットする
        //$this->set('[[パラメータ名]]', [[セットするパラメータ変数]]);

        //リダイレクトする先を記述
        if (! $error)
        {
            openpne_redirect('ktai', 'page_h_one_word_write');
            //一言のトップへ戻すように変更
        }
        else
        {
            $p = array(
                'msg' => urlencode($error),
            );
            openpne_redirect('ktai', 'page_h_one_word_write', $p);
        }
    }
}
?>

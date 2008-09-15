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

class ktai_page_h_one_word_write extends OpenPNE_Action
{

    function execute($requests)
    {

        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];
        $msg = urldecode($requests['msg']);

        //=======================================
        //request parameters get
        //=======================================
        //ここでリクエストパラメータを取得する

        //=======================================
        //logic block
        //=======================================
        //ここでビジネスロジックを記述する
        //ONE_WORDを取得する。（じぶんの分と、フレンドの分）
        $oneword = new OneWord();
        $oneword->setUid($u);
        $my_word = $oneword->get();
        $other_word = $oneword->getList();
        //=======================================
        //template assign block
        //=======================================
        //ここでテンプレートへ変数をセットする
        //$this->set('[[パラメータ名]]', [[セットするパラメータ変数]]);
        $this->set('my_word', $my_word);
        $this->set('other_word', $other_word);
        $this->set('msg', $msg);
        return 'success';

    }
}
?>

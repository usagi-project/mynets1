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


class pc_do_h_inquiry_add_confirm extends OpenPNE_Action
{
    function execute($requests)
    {

        $u = $GLOBALS['AUTH']->uid();

        //変数の受け取り
        $data_id = $requests['data_id'];
        $data_flag = $requests['data_flag'];
        $target_c_member_id = $requests['target_c_member_id'];
        $category_flag = $requests['category_flag'];
        $body = $requests['body'];
        // ----------

        if (is_null($body) || $body === '') {
           $p = array(
                'target_c_member_id' => $target_c_member_id,
                'data_id' => $data_id,
                'data_flag' => $data_flag,
                'category_flag' => $category_flag,
                'msg' => "本文を入力してください。",
            );
            openpne_redirect("pc","page_h_inquiry",$p);
        }
        //通報・問い合わせデータを登録する
        setInquiryData($data_id, $data_flag, $category_flag, $body, $u);
        openpne_redirect('pc', 'page_h_inquiry_end');
    }
}

?>

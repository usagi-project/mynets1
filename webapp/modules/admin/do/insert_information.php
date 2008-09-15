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

// インフォメーション追加
class admin_do_insert_information extends OpenPNE_Action
{
    function handleError($errors)
    {
        admin_client_redirect('ext_information_check', array_shift($errors));
    }

    function execute($requests)
    {
        $day   = $requests['day'];
        $month = $requests['month'];
        $year  = $requests['year'];
        $subject   = $requests['subject'];
        $body      = $requests['body'];
        $view_flag = $requests['view_flag'];
        $category = $requests['category'];

        if (!$year) {
            $year = date('Y');
        }
        if (!$month) {
            $month = date('m');
        }
        if (!$day) {
            $day = date('d');
        }

        $msg = array();
        if (!$subject) {
            admin_client_redirect('ext_information_check', "題名または内容を入力してください。");
        }
        if (!$body) {
            admin_client_redirect('ext_information_check', "題名または内容を入力してください。");
        }

        //インフォメーションの登録
        $data = array(
                'subject'     => strval($subject),
                'body'        => strval($body),
                'category'    => strval($category),
                'r_datetime'  => db_now(),
                'c_view_flag' => intval($view_flag),
                //'public_flag' => intval($option['public_flag']),
                'view_date'   => date($year."-".$month."-".$day),
        );
        $info = new admin_Information();
        $info->addData($data);

        admin_client_redirect('ext_information_check', 'インフォメーションを追加しました');
    }
}

?>

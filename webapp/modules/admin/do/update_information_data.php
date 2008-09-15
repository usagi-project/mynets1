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

class admin_do_update_information_data extends OpenPNE_Action
{
    function execute($requests)
    {
        $info_id   = $requests['info_id'];
        $view_flag = $requests['view_flag'];
        $subject   = $requests['subject'];
        $body      = $requests['body'];
        $category  = $requests['category'];

        if (!$info_id) {
            admin_client_redirect('ext_information_check', 'インフォメーションIDが不正です');
        }
        $info = new admin_Information();
        //$info->setId($information_id);
        //$info->chgData($flg);
        $data = array(
                'c_view_flag'      => intval($view_flag),
                'subject'        => strval($subject),
                'body'           => strval($body),
                'category'       => strval($category),
        );
        $where = array(
            'c_admin_information_id' => intval($info_id),
        );
        if ($info->chgInfoData($data, $where))
        {
            admin_client_redirect('ext_information_check', 'infomationの表示を変更しました。');
        }
        else
        {
            admin_client_redirect('ext_information_check', 'データが正常に保存できませんでした。');
        }
        exit;

    }
}

?>

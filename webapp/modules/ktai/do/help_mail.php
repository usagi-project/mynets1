<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class ktai_do_help_mail extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $page = $requests['page'];
        // ----------
        if (do_common_send_ktai_help_mail($u, $page)) {
            $msg = 102;
        } else {
            $msg = 103;
        }
        $p = array('page' => $page, 'msg' => $msg);
        openpne_redirect('ktai', 'page_help', $p);
    }
}

?>

<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class ktai_do_h_config_message_contents_receive_update extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $is_receive_contents = $requests['is_receive_contents'];
        // ----------

        MEMBER_setMemberConfig($u, 'message_contents_receive_flag',$is_receive_contents);

        $p = array('msg' => 101);
        openpne_redirect('ktai', 'page_h_config', $p);
    }
}

?>

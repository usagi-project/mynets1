<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class ktai_page_h_config_message_contents_receive extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        $is_receive_contents = MEMBER_getMemberConfig($u,'message_contents_receive_flag');
        //メンバ情報
        $this->set('is_receive_contents', $is_receive_contents);

        return 'success';
    }
}

?>

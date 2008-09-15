<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 *
 * @copyright 2007 Kei Kubo
 */


class diary_page_home_rss extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function execute($requests)
    {
        //最新日記
        $list_set = p_public_diary_list_diary_list4c_member_id('', 20, 1);
        $this->set('c_diary_list', $list_set[0]);
        return 'success';
    }

}

?>

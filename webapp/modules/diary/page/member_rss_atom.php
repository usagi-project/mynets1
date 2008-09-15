<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 *
 * @copyright 2007 Kei Kubo
 */


class diary_page_member_rss_atom extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function handleError()
    {
        openpne_redirect('diary', 'page_home_rss_atom');
    }

    function execute($requests)
    {
        $target_c_member_id = $requests['target_c_member_id'];
        $this->set('target_c_member_id', $target_c_member_id);

        //最新日記
        $list_set = p_public_diary_list_diary_list4c_member_id($target_c_member_id, 20, 1);
        $this->set('c_diary_list', $list_set[0]);
        return 'success';
    }

}

?>

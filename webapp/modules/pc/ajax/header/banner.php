<?php

class pc_ajax_header_banner extends OpenPNE_Action
{
    function execute($requests)
    {
        $this->set('PHPSESSID', md5(session_id()));
        $this->set('INC_PAGE_HEADER', db_banner_get_top_banner(true));
        $this->set('top_banner_html_after', p_common_c_siteadmin4target_pagename('top_banner_html_after'));
        return 'success';
    }
}
?>

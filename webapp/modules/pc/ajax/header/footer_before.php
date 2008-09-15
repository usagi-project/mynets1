<?php

class pc_ajax_header_footer_before extends OpenPNE_Action
{
    function execute($requests)
    {
        $this->set('inc_page_footer',
            p_common_c_siteadmin4target_pagename('inc_page_footer_before'));
        return 'success';
    }
}
?>

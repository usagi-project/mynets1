<?php

class pc_ajax_header_header_before extends OpenPNE_Action
{
    function execute($requests)
    {
        if (SNS_TITLE) {
            $this->set('title', SNS_TITLE);
        } else {
            $this->set('title', SNS_NAME);
        }
        $this->set('inc_html_head', p_common_c_siteadmin4target_pagename('inc_html_head'));
        $this->set('inc_custom_css', p_common_c_siteadmin4target_pagename('inc_custom_css'));
        $result = db_select_c_sns_config();
        $inc_border_color = array();
        $inc_bg_color = array();
        foreach($result as $key => $item) {
            if( preg_match('/^border_\d\d$/',$key) )
                $inc_border_color[$key] = $item;
            if( preg_match('/^bg_\d\d$/',$key) )
                $inc_bg_color[$key] = $item;
        }
        $this->set('inc_border_color', $inc_border_color);
        $this->set('inc_bg_color', $inc_bg_color);
        $this->set('inc_color', db_select_c_sns_config());
        return 'success';
    }
}
?>

<?php

class pc_ajax_home_navibar2 extends OpenPNE_Action
{
    function execute($requests)
    {
        $this->set('navi_h', util_get_c_navi('h'));
        return 'success';
    }
}
?>
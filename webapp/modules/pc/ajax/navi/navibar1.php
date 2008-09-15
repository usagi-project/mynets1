<?php

class pc_ajax_navi_navibar1 extends OpenPNE_Action
{
    function execute($requests)
    {
        $this->set('PHPSESSID', md5(session_id()));
        $this->set('navi_global', util_get_c_navi('global'));
        return 'success';
    }
}
?>

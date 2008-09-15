<?php

class pc_ajax_home_searchbar extends OpenPNE_Action
{
    function execute($requests)
    {
        $this->set('PHPSESSID', md5(session_id()));
        return 'success';
    }
}
?>

<?php

class pc_ajax_home_navibar extends OpenPNE_Action
{
    function execute($requests)
    {
        $this->set('navi2', "Nabibar2");

        return 'success';
    }
}
?>

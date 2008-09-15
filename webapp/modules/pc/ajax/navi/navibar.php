<?php

class pc_ajax_navi_navibar extends OpenPNE_Action
{
    function execute($requests)
    {
        $this->set('navi1', "Nabibar1");

        return 'success';
    }
}
?>

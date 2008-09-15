<?php

class pc_ajax_header_header extends OpenPNE_Action
{
    function execute($requests)
    {
        if (SNS_TITLE) {
            $this->set('title', SNS_TITLE);
        } else {
            $this->set('title', SNS_NAME);
        }

        return 'success';
    }
}
?>

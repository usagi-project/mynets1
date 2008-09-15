<?php

class pc_ajax_dengon_list extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $_SESSION['GVAL']['c_member']['c_member_id'];

    //伝言板
        list ($c_dengon_comment_list, $is_prev, $is_next, $total_num, $total_page_num)
            = k_p_fh_dengon_c_dengon_comment_list4c_member_id_to($u, 5,1);

        $this->set("c_dengon_comment", array_reverse($c_dengon_comment_list));
        $this->set("target_c_member_id",$u);

        return 'success';
    }
}
?>

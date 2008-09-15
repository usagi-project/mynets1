<?php

/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable 
 *              to obtain it through the world-wide-web, please send a note to 
 *              license@php.net so we can mail you a copy immediately.  
 *
 * @category   Application of MyNETS
 * @project    OpenPNE UsagiProject 2006-2007
 * @package    MyNETS
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ======================================================================== 
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

class ktai_do_h_config_image_delete_image extends OpenPNE_Action
{
    function execute($requests)
    {
        $tail = $GLOBALS['KTAI_URL_TAIL'];
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];

        $img_num = $requests['img_num'];

        $c_member = db_common_c_member4c_member_id($u);
        if (!$img_num) {
            if ($c_member['image_filename'] == $c_member['image_filename_1']) {
                $img_num = 1;
            } elseif ($c_member['image_filename'] == $c_member['image_filename_2']) {
                $img_num = 2;
            } elseif ($c_member['image_filename'] == $c_member['image_filename_3']) {
                $img_num = 3;
            }
        }

        image_data_delete($c_member['image_filename_'.$img_num]);
        do_h_config_image_delete_c_member_image_new($u, $img_num);

        if ($c_member['image_filename'] == $c_member['image_filename_'.$img_num]) {
            do_h_config_image_change_c_member_main_image($u, 1);
        }

        openpne_redirect('ktai', 'page_h_config_image');
    }
}

?>

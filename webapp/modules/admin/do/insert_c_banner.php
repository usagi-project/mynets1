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

// バナー追加
class admin_do_insert_c_banner extends OpenPNE_Action
{
    function execute($requests)
    {
        //c_banner insert
        $c_banner_id = db_admin_insert_c_banner($requests['a_href'], $requests['type'], $requests['nickname']);
        //c_banner insert

        //c_image delete && insert
        $ext = t_check_image_format($_FILES['upfile']);
        $c_banner['image_filename'] = "b_{$c_banner_id}_".time().".{$ext}";
        admin_insert_c_image($_FILES['upfile'], $c_banner['image_filename']);
        //c_image delete && insert

        //c_banner update
        db_admin_update_c_banner($c_banner_id, $c_banner);
        //c_banner update

        admin_client_redirect('edit_c_banner', 'バナーを追加しました');
    }
}

?>

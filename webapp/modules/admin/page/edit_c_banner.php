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

// c_image に画像を登録、削除
class admin_page_edit_c_banner extends OpenPNE_Action
{
    function execute($requests)
    {
        $v = array();

        $v['SNS_NAME'] = SNS_NAME;
        $v['is_image'] = db_admin_is_c_image4filename($requests['filename']);

        $v['c_banner_top_list'] = db_admin_c_banner_list4null('TOP');
        $v['c_banner_side_list'] = db_admin_c_banner_list4null('SIDE');

        $v['cnt_c_banner_top_list'] = count($v['c_banner_top_list']);

        $v['top_banner_html_before'] = p_common_c_siteadmin4target_pagename('top_banner_html_before');
        $v['top_banner_html_after'] = p_common_c_siteadmin4target_pagename('top_banner_html_after');
        $v['side_banner_html_before'] = p_common_c_siteadmin4target_pagename('side_banner_html_before');
        $v['side_banner_html_after'] = p_common_c_siteadmin4target_pagename('side_banner_html_after');

        $this->set($v);
        return 'success';
    }
}

?>

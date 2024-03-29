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
 * @author     UsagiProject <info@usagi-project.org>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi-project.org/member.html>
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

// プロフィール項目編集
class admin_do_update_c_profile extends OpenPNE_Action
{
    function handleError($errors)
    {
        admin_client_redirect('update_c_profile', array_shift($errors),
            'c_profile_id='.$this->requests['c_profile_id']);
    }

    function execute($requests)
    {
        $id = db_admin_c_profile_name_exists($requests['name']);
        if ($id && ($id != $requests['c_profile_id'])) {
            admin_client_redirect('update_c_profile', 'その識別名は既に登録されています',
                'c_profile_id='.$requests['c_profile_id']);
        }

        db_admin_update_c_profile($requests['c_profile_id'],
            $requests['name'],
            $requests['caption'],
            $requests['is_required'],
            $requests['public_flag_edit'],
            $requests['public_flag_default'],
            $requests['form_type'],
            $requests['sort_order'],
            $requests['disp_regist'],
            $requests['disp_config'],
            $requests['disp_search'],
            $requests['val_type'],
            $requests['val_regexp'],
            $requests['val_min'],
            $requests['val_max']);

        admin_client_redirect('edit_c_profile', 'プロフィール項目を編集しました');
    }
}

?>

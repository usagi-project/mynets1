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

function smarty_resource_db_source($tpl_name, &$tpl_source, &$smarty)
{
    $sql = 'SELECT source FROM ' . MYNETS_PREFIX_NAME . 'c_template WHERE name = ?';
    $params = array(strval($tpl_name));
    if ($res = db_get_one($sql, $params)) {
        $tpl_source = $res;
        return true;
    } else {
        return false;
    }
}

function smarty_resource_db_timestamp($tpl_name, &$tpl_timestamp, &$smarty)
{
    $sql = 'SELECT r_datetime FROM ' . MYNETS_PREFIX_NAME . 'c_template WHERE name = ?';
    $params = array(strval($tpl_name));
    if ($res = db_get_one($sql, $params)) {
        $tpl_timestamp = strtotime($res);
        return true;
    } else {
        return false;
    }
}

function smarty_resource_db_secure($tpl_name, &$smarty)
{
    return true;
}

function smarty_resource_db_trusted($tpl_name, &$smarty)
{
}

?>

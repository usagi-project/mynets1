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

function xmlrpc_002_get_member_point($message)
{
    $param = $message->getParam(0);
    if (!XML_RPC_Value::isValue($param)) {
        return false;
    }
    $params = XML_RPC_decode($param);

    if (empty($params['c_member_id'])) {
        return false;
    }

    $point = get_point($params['c_member_id']);
    return xmlrpc_get_response($point);
}

function get_point($c_member_id)
{
    $sql = 'SELECT c_profile_id FROM ' . MYNETS_PREFIX_NAME . 'c_profile WHERE name = \'PNE_POINT\'';
    if (!$c_profile_id = db_get_one($sql)) {
        return 0;
    }

    $sql = 'SELECT value FROM ' . MYNETS_PREFIX_NAME . 'c_member_profile WHERE c_member_id = ? AND c_profile_id = ?';
    $params = array(intval($c_member_id), intval($c_profile_id));
    $point = db_get_one($sql, $params);

    return intval($point);
}

?>

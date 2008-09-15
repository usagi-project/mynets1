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

/**
 * 認証API
 */
function xmlrpc_000_auth($message)
{
    $param = $message->getParam(0);
    if (!XML_RPC_Value::isValue($param)) {
        return false;
    }
    $params = XML_RPC_decode($param);

    if (empty($params['sid'])) {
        return false;
    }
    if (empty($params['mid'])) {
        return false;
    }
    if (empty($params['dt'])) {
        return false;
    }

    $c_member_id = $params['mid'];
    $datetime    = $params['dt'];

    if (!db_common_c_member4c_member_id_LIGHT($c_member_id)) {
        return xmlrpc_get_fault_response(56);
    }

    if (!$member_token = db_api_get_member_token($c_member_id)) {
        return xmlrpc_get_fault_response(52);
    }

    $session_id = api_get_sid($c_member_id, $member_token, $datetime);
    if ($params['sid'] != $session_id) {
        return xmlrpc_get_fault_response(52);
    }

    return xmlrpc_get_response($c_member_id);
}

?>

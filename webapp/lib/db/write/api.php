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

if (! function_exists('db_api_insert_token'))
{
    function db_api_insert_token($c_member_id, $token = '')
    {
        if (!$token) $token = create_hash();
        $data = array(
            'c_member_id' => intval($c_member_id),
            'token' => $token,
        );
        if (db_insert(MYNETS_PREFIX_NAME . 'c_api_member', $data)) {
            return $token;
        } else {
            return false;
        }
    }
}

if (! function_exists('db_api_update_token'))
{
    function db_api_update_token($c_member_id)
    {
        $token = create_hash();

        $data  = array('token' => $token);
        $where = array('c_member_id' => intval($c_member_id));
        db_update(MYNETS_PREFIX_NAME . 'c_api_member', $data, $where);

        if (!db_affected_rows()) {
            db_api_insert_token($c_member_id, $token);
        }
        return $token;
    }
}

?>

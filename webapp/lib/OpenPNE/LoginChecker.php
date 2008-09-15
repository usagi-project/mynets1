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

class OpenPNE_LoginChecker
{
    var $ip_addr;
    var $check_num;
    var $check_time;
    var $reject_time;

    var $is_rejected = false;


    function OpenPNE_LoginChecker($options = array())
    {
        // default values
        $this->ip_addr = $_SERVER[SERVER_IP_KEY];
        $this->check_num = 1000;
        $this->check_time  = 10;
        $this->reject_time = 60;

        foreach ((array)$options as $key => $value) {
            switch ($key) {
            case 'ip_addr':
                $this->$key = $value;
                break;
            case 'check_num':
            case 'check_time':
            case 'reject_time':
                if (is_numeric($value) && intval($value) > 0) {
                    $this->$key = intval($value);
                }
                break;
            }
        }

        // min. -> sec.
        $this->check_time  *= 60;
        $this->reject_time *= 60;
    }

    function is_rejected()
    {
        $sql = 'SELECT c_login_reject_id FROM ' . MYNETS_PREFIX_NAME . 'c_login_reject' .
                ' WHERE ip_addr = ? AND expired_at > ?';
        $params = array($this->ip_addr, db_now());
        return $this->is_rejected = (bool)db_get_one($sql, $params);
    }

    function fail_login()
    {
        if (!$this->is_rejected) {
            $this->insert_login_failure();
            $this->insert_login_reject();
        }

        $this->gc_login_failure();
        $this->gc_login_reject();
    }

    function insert_login_failure()
    {
        $data = array(
            'ip_addr'    => $this->ip_addr,
            'r_datetime' => db_now(),
        );
        db_insert(MYNETS_PREFIX_NAME . 'c_login_failure', $data);
    }

    function gc_login_failure()
    {
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_login_failure WHERE r_datetime < ?';
        $params = array(date('Y-m-d H:i:s', time() - $this->check_time));
        db_query($sql, $params);
    }

    function insert_login_reject()
    {
        $sql = 'SELECT COUNT(*) FROM ' . MYNETS_PREFIX_NAME . 'c_login_failure WHERE ip_addr = ?';
        $params = array($this->ip_addr);
        if (db_get_one($sql, $params) >= $this->check_num) {
            $data = array(
                'ip_addr'    => $this->ip_addr,
                'expired_at' => date('Y-m-d H:i:s', time() + $this->reject_time),
            );
            db_insert(MYNETS_PREFIX_NAME . 'c_login_reject', $data);
        }
    }

    function gc_login_reject()
    {
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_login_reject WHERE expired_at < ?';
        $params = array(db_now());
        db_query($sql, $params);
    }
}

?>

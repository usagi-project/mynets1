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
if (defined('MYNETS_DB_MODULE') && MYNETS_DB_MODULE=='mysql') {
    require_once 'OpenPNE/DB/MyNETS_DB_Writer_mysql.php';
} else {
    require_once 'OpenPNE/DB/Writer.php';
}

class OpenPNE_DBSession
{
    /**
     * @var OpenPNE_DB_Writer
     */
    var $db;

    function OpenPNE_DBSession($dsn)
    {
        if (defined('MYNETS_DB_MODULE') && MYNETS_DB_MODULE=='mysql') {
            $this->db =& new MyNETS_DB_Writer($dsn);
        } else {
            $this->db =& new OpenPNE_DB_Writer($dsn);
        }
    }

    /**
     * sess_nameを取得/変更する
     * 
     * メンバ変数で値を保持できないようなので
     * 仕方なくstatic変数で値を保持しておく
     */
    function sess_name($name = '')
    {
        static $sess_name;
        if ($name) {
            $sess_name = $name;
        }
        return $sess_name;
    }

    function open($save_path, $sess_name)
    {
        $this->sess_name($sess_name);
        return true;
    }

    function close()
    {
        return true;
    }

    function read($sess_id)
    {
        $sql = 'SELECT sess_data FROM ' . MYNETS_PREFIX_NAME . 'c_session WHERE sess_id = ? AND sess_name = ?';
        $params = array($sess_id, $this->sess_name());
        if ($res = $this->db->get_one($sql, $params)) {
            return $res;
        }
        return '';
    }

    function write($sess_id, $sess_data)
    {
        if (!$sess_id || !$sess_data) return false;

        $data = array(
            'sess_time' => time(),
            'sess_data' => $sess_data,
        );

        // update
        $where = 'sess_id = '.$this->db->quote($sess_id).
                 ' AND sess_name = '.$this->db->quote($this->sess_name());
        if ($this->db->update(MYNETS_PREFIX_NAME . 'c_session', $data, $where) &&
            $this->db->affectedRows()) {
            return true;
        }

        // insert
        $data['sess_id'] = $sess_id;
        $data['sess_name'] = $this->sess_name();
        return (bool)$this->db->insert(MYNETS_PREFIX_NAME . 'c_session', $data);
    }

    function destroy($sess_id)
    {
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_session WHERE sess_id = ? AND sess_name = ?';
        $params = array($sess_id, $this->sess_name());
        $res =& $this->db->query($sql, $params);
        if (!$res) {
            return false;
        }
        return (bool)$res;
    }

    function gc($maxlifetime)
    {
        $expire = time() - intval($maxlifetime);

        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_session WHERE sess_time < ? AND sess_name = ?';
        $params = array($expire, $this->sess_name());
        $res =& $this->db->query($sql, $params);

        if (!$res) {
            return false;
        }
        return (bool)$res;
    }
}

?>

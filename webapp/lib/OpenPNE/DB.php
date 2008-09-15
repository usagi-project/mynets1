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

// PEAR::DB依存
require_once 'DB.php';

/**
 * OpenPNE_DB (PEAR::DB依存)
 */
class OpenPNE_DB
{
    /**
     * @var DB_mysql
     */
    var $db;

    var $dsn;

    function OpenPNE_DB($dsn)
    {
        $this->dsn = $dsn;
        $this->_connect();
    }

    function &getInstance()
    {
        static $singleton;
        if (empty($singleton)) {
            $singleton = new OpenPNE_DB();
        }
        return $singleton;
    }

    /**
     * @access private
     */
    function _connect()
    {
        $this->db =& DB::connect($this->dsn);
        if (DB::isError($this->db)) {
            openpne_display_error($this->db->getMessage());
            exit;
        }

        $this->db->setFetchMode(DB_FETCHMODE_ASSOC);
        $this->db->query('SET NAMES utf8');
    }

    function get_one($sql, $params = array())
    {
        $sql = $this->db->modifyLimitQuery($sql, 0, 1, $params);
        $res =& $this->db->getOne($sql, $params);
        if (DB::isError($res)) {
            return null;
        }
        return $res;
    }

    function get_row($sql, $params = array())
    {
        $sql = $this->db->modifyLimitQuery($sql, 0, 1, $params);
        $res =& $this->db->getRow($sql, $params);
        if (DB::isError($res)) {
            return array();
        }
        return $res;
    }

    function get_col($sql, $params = array())
    {
        $res =& $this->db->getCol($sql, 0, $params);
        if (DB::isError($res)) {
            return array();
        }
        return $res;
    }

    function get_col_limit($sql, $from, $count, $params = array())
    {
        $sql = $this->db->modifyLimitQuery($sql, intval($from), intval($count), $params);
        return $this->get_col($sql, $params);
    }

    function get_col_page($sql, $page, $count, $params = array())
    {
        $from = (intval($page) - 1) * intval($count);
        return $this->get_col_limit($sql, $from, $count, $params);
    }

    function get_assoc($sql, $params = array())
    {
        $res =& $this->db->getAssoc($sql, false, $params);
        if (DB::isError($res)) {
            return array();
        }
        return $res;
    }

    function get_assoc_limit($sql, $from, $count, $params = array())
    {
        $sql = $this->db->modifyLimitQuery($sql, intval($from), intval($count), $params);
        return $this->get_assoc($sql, $params);
    }

    function get_all($sql, $params = array())
    {
        $res =& $this->db->getAll($sql, $params);
        if (DB::isError($res)) {
            return array();
        }
        return $res;
    }

    function get_all_limit($sql, $from, $count, $params = array())
    {
        $sql = $this->db->modifyLimitQuery($sql, intval($from), intval($count), $params);
        return $this->get_all($sql, $params);
    }

    function get_all_page($sql, $page, $count, $params = array())
    {
        $from = (intval($page) - 1) * intval($count);
        return $this->get_all_limit($sql, $from, $count, $params);
    }

    function quote($in)
    {
        return $this->db->quoteSmart($in);
    }

    /**
     * static method
     */
    function escapeIdentifier($str)
    {
        return preg_replace('/[^a-zA-Z0-9_]/', '', $str);
    }

    function makeWhereClause($where)
    {
        if (!is_array($where)) {
            return $where;
        }

        $_where = '';
        $first = true;
        foreach ($where as $key => $value) {
            if ($first) {
                $first = false;
            } else {
                $_where .= ' AND ';
            }
            $_where .= $key . ' = ' . $this->quote($value);
        }
        return $_where;
    }
}

?>

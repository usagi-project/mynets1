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
 * @author     shinji hyodot <shinji@hey-to.net>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.1.0
 * @since      File available since Release 1.1.0 Nighty
 * @chengelog  [2007/05/01] Ver1.1.0Nighty package
 * ======================================================================== 
 */



class MyNETS_DB
{
    /**
     * @var DB_mysql
     */
    var $db;

    var $dsn;

    function MyNETS_DB($dsn)
    {
        $this->dsn = $dsn;
        $this->_connect();
    }

    function &getInstance()
    {
        static $singleton;
        if (empty($singleton)) {
            $singleton = new MyNETS_DB();
        }
        return $singleton;
    }

    function getErrorMessage()
    {
        if (empty($this->db)) {
             return mysql_errno() . ": " . mysql_error();
        } else {
             return mysql_errno($this->db) . ": " . mysql_error($this->db);
        }
    }
    /**
     * @access private
     */
    function _connect()
    {
        $this->db = mysql_connect($this->dsn['hostspec'], $this->dsn['username'], $this->dsn['password'],$this->dsn['new_link']);
        if (!$this->db) {
            openpne_display_error($this->getErrorMessage());
            exit;
        }
        if (!mysql_select_db($this->dsn['database'], $this->db)) {
            openpne_display_error($this->getErrorMessage());
            mysql_close($this->db);
            unset($this->db);
            exit;
        }
        mysql_query('SET NAMES utf8',$this->db);
    }

    function prepareSQL($sql, $params = array())
    {
        $params = (array)$params;
        if (sizeof($params) == 0) {
            return $sql;
        }
        $tokens   = preg_split('/((?<!\\\)[&?!])/', $sql, -1,
                               PREG_SPLIT_DELIM_CAPTURE);
        $newtokens = array();
        $index = 0;
        
        foreach ($tokens as $val) {
            //&と!は使ってないので考えていない
            switch ($val) {
                case '?':
                    array_push($newtokens, $this->quoteSmart(array_shift($params)));
                    break;
                default:
                    array_push($newtokens, preg_replace('/\\\([&?!])/', "\\1", $val));
            }
        }
        
        return implode(' ', $newtokens);
        
    }
    function get_one($sql, $params = array())
    {
        $sql = MyNETS_DB::modifyLimitQuery($sql, 0, 1, $params);

        $result = mysql_query($this->prepareSQL($sql, $params), $this->db);
        if (!$result) {
            return null;
        }
        
        $row = mysql_fetch_row($result);
        mysql_free_result($result);
        
        return $row[0];
    }

    function get_row($sql, $params = array())
    {
        $sql = MyNETS_DB::modifyLimitQuery($sql, 0, 1, $params);
        
        $result = mysql_query($this->prepareSQL($sql, $params), $this->db);
        if (!$result) {
            return array();
        }
        
        $row = mysql_fetch_assoc($result);
        mysql_free_result($result);        
        if(!$row){
            return array();
        }
        return $row;
    }

    function get_col($sql, $params = array())
    {
        $result = mysql_query($this->prepareSQL($sql, $params), $this->db);
        if (!$result) {
            return array();
        }
        
        $res = array();
        while ($row = mysql_fetch_row($result)) {
            array_push($res, $row[0]);
        }
        mysql_free_result($result);        
        return $res;
    }

    function get_col_limit($sql, $from, $count, $params = array())
    {
        $sql = MyNETS_DB::modifyLimitQuery($sql, intval($from), intval($count), $params);
        return $this->get_col($sql, $params);
    }

    function get_col_page($sql, $page, $count, $params = array())
    {
        $from = (intval($page) - 1) * intval($count);
        return $this->get_col_limit($sql, $from, $count, $params);
    }

    function get_assoc($sql, $params = array())
    {
        $result = mysql_query($this->prepareSQL($sql, $params), $this->db);
        if (!$result) {
            return array();
        }

        $res = array();
        while ($row = mysql_fetch_array($result,MYSQL_BOTH)) {
            $res[$row[0]] = $row[1];
        }
        mysql_free_result($result);        
        
        return $res;
    }

    function get_assoc_limit($sql, $from, $count, $params = array())
    {
        $sql = MyNETS_DB::modifyLimitQuery($sql, intval($from), intval($count), $params);
        return $this->get_assoc($sql, $params);
    }

    function get_all($sql, $params = array())
    {
        $result = mysql_query($this->prepareSQL($sql, $params), $this->db);
        if (!$result) {
            return array();
        }

        $res = array();
        while ($row = mysql_fetch_assoc($result)) {
            array_push($res, $row);
        }
        mysql_free_result($result);        
        
        return $res;
    }

    function get_all_limit($sql, $from, $count, $params = array())
    {
        $sql = MyNETS_DB::modifyLimitQuery($sql, intval($from), intval($count), $params);
        return $this->get_all($sql, $params);
    }

    function get_all_page($sql, $page, $count, $params = array())
    {
        $from = (intval($page) - 1) * intval($count);
        return $this->get_all_limit($sql, $from, $count, $params);
    }

    function quote($in)
    {
        return $this->quoteSmart($in);
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
    
    /*PEAR:DBの関数*/
    function isManip($query)
    {
        $manips = 'INSERT|UPDATE|DELETE|REPLACE|'
                . 'CREATE|DROP|'
                . 'LOAD DATA|SELECT .* INTO|COPY|'
                . 'ALTER|GRANT|REVOKE|'
                . 'LOCK|UNLOCK';
        if (preg_match('/^\s*"?(' . $manips . ')\s+/i', $query)) {
            return true;
        }
        return false;
    }
    
    function modifyLimitQuery($query, $from, $count, $params = array())
    {
        if (MyNETS_DB::isManip($query)) {
            return $query . " LIMIT $count";
        } else {
            return $query . " LIMIT $from, $count";
        }
    }
    function quoteSmart($in)
    {
        if (is_int($in) || is_double($in)) {
            return $in;
        } elseif (is_bool($in)) {
            return $in ? 1 : 0;
        } elseif (is_null($in)) {
            return 'NULL';
        } else {
            return "'" . $this->escapeSimple($in) . "'";
        }
    }
    function escapeSimple($str)
    {
        if (function_exists('mysql_real_escape_string')) {
            return @mysql_real_escape_string($str, $this->db);
        } else {
            return @mysql_escape_string($str);
        }
    }
}

?>

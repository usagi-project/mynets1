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
 * @author     shinji hyodo <shinji@hey-to.net>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.1.0
 * @since      File available since Release 1.1.0 Nighty
 * @chengelog  [2007/05/01] Ver1.1.0Nighty package
 * ======================================================================== 
 */



class MyNETS_DB_Writer extends MyNETS_DB
{
    function MyNETS_DB_Writer($dsn)
    {
        parent::MyNETS_DB($dsn);
    }

    function &query($sql, $params = array())
    {
        return mysql_query($this->prepareSQL($sql, $params), $this->db);
    }

    function insert($table, $fields_values, $pkey = '')
    {
        $id = null;
        $seq_name = sprintf('%s_%s', $table, $pkey);
        if ($pkey && ($id = $this->nextId($seq_name))) {
            $fields_values = array($pkey => $id) + $fields_values;
        }

        $fields = array_keys($fields_values);
        $first = true;
        $names = '';
        $values = '';
        foreach ($fields as $value) {
            if ($first) {
                $first = false;
            } else {
                $names .= ',';
                $values .= ',';
            }
            $names .= $value;
            $values .= '?';
        }
        $sql = "INSERT INTO $table ($names) VALUES ($values)";
        
        if (!mysql_query($this->prepareSQL($sql, array_values($fields_values)), $this->db)) {
            return false;
        }
        return $this->insertId($id);
    }

    function nextId($seq_name = '', $ondemand = true)
    {
        return null;
    }

    function insertId($id = null)
    {
        return mysql_insert_id($this->db);
    }

    function update($table, $fields_values, $where)
    {
        $where = $this->makeWhereClause($where);
        
        $set = '';
        $first = true;
        $fields = array_keys($fields_values);
        foreach ($fields as $value) {
            if ($first) {
                $first = false;
            } else {
                $set .= ',';
            }
            $set .= "$value = ?";
        }
        $sql = "UPDATE $table SET $set";
        if ($where) {
            $sql .= " WHERE $where";
        }

        return mysql_query($this->prepareSQL($sql, array_values($fields_values)), $this->db);
    }

    function affectedRows()
    {
        return mysql_affected_rows($this->db);
    }
}

?>

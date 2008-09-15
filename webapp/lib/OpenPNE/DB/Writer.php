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

require_once 'OpenPNE/DB.php';

class OpenPNE_DB_Writer extends OpenPNE_DB
{
    function OpenPNE_DB_Writer($dsn)
    {
        parent::OpenPNE_DB($dsn);
    }

    function &query($sql, $params = array())
    {
        return $this->db->query($sql, $params);
    }

    function insert($table, $fields_values, $pkey = '')
    {
                $id = null;
        $seq_name = sprintf('%s_%s', $table, $pkey);
        if ($pkey && ($id = $this->nextId($seq_name))) {
            $fields_values = array($pkey => $id) + $fields_values;
        }

        $res = $this->db->autoExecute($table, $fields_values, DB_AUTOQUERY_INSERT);
        if (DB::isError($res)) {
            return false;
        }
        return $this->insertId($id);
    }

    function nextId($seq_name = '', $ondemand = true)
    {
        if ($this->db->phptype == 'mysql') {
            return null;
        } else {
            return $this->db->nextId($seq_name, $ondemand);
        }
    }

    function insertId($id = null)
    {
        if ($this->db->phptype == 'mysql') {
            return $this->db->getOne('SELECT LAST_INSERT_ID()');
        } else {
            return $id;
        }
    }

    function update($table, $fields_values, $where)
    {
        $where = $this->makeWhereClause($where);
        $res = $this->db->autoExecute($table, $fields_values, DB_AUTOQUERY_UPDATE, $where);
        if (DB::isError($res)) {
            return false;
        }
        return true;
    }

    function affectedRows()
    {
        return $this->db->affectedRows();
    }
}

?>

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
 * adminモジュールのページ名をハッシュ化するためのクラス
 */
class AdminHashTable
{
    var $table;

    function AdminHashTable()
    {
        $this->table = $this->_getTable();
    }

    function &singleton()
    {
        static $instance;
        if (empty($instance)) {
            $instance = new AdminHashTable();
        }
        return $instance;
    }

    function action($hash, $type = 'page')
    {
        if (empty($this->table)) return $hash;

        if ($action = array_search($hash, (array)$this->table[$type])) {
            return $action;
        } elseif (empty($this->table[$type][$hash])) {
            return $hash;
        }
        return '';
    }

    function hash($action, $type = 'page')
    {
        return !empty($this->table[$type][$action]) ? $this->table[$type][$action] : $action;
    }

    function _getTable()
    {
        $sql = "SELECT value FROM " . MYNETS_PREFIX_NAME . "c_admin_config WHERE name = 'admin_hashtable'";
        if ($v = db_get_one($sql)) {
            return unserialize($v);
        } else {
            return array();
        }
    }

    function updateTable()
    {
        $this->table = $this->_createRandomTable();

        if ($this->_getTable()) {
            $data = array(
                'value' => serialize($this->table),
            );
            $where = array('name' => 'admin_hashtable');
            db_update(MYNETS_PREFIX_NAME . 'c_admin_config', $data, $where);
        } else {
            $data = array(
                'name' => 'admin_hashtable',
                'value' => serialize($this->table),
            );
            db_insert(MYNETS_PREFIX_NAME . 'c_admin_config', $data);
        }
    }

    function deleteTable()
    {
        $sql = "DELETE FROM " . MYNETS_PREFIX_NAME . "c_admin_config WHERE name = 'admin_hashtable'";
        db_query($sql);

        $this->table = array();
    }

    function _createRandomTable()
    {
        $table = array();
        foreach ($this->_actionList() as $type => $lst) {
            foreach ($lst as $action) {
                $table[$type][$action] = $this->_createHashString();
            }
        }
        return $table;
    }

    function _createHashString($length = 12)
    {
        list($usec, $sec) = explode(' ', microtime());
        $seed = (float)$sec + ((float)$usec * 100000);
        srand($seed);

        $elem = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012345679';
        $max = strlen($elem) - 1;

        $hash = '';
        for ($i = 0; $i < $length; $i++) {
            $hash .= substr($elem, rand(0, $max), 1);
        }
        return $hash;
    }

    function _actionList()
    {
        $list = array('page' => array(), 'do' => array());
        $path = OPENPNE_MODULES_DIR . '/admin/page/*.php';
        foreach ((array)glob($path) as $filename) {
            $list['page'][] = preg_replace('/^.*\W([\w]+)\.php$/', '$1', $filename);
        }
        $path = OPENPNE_MODULES_DIR . '/admin/do/*.php';
        foreach ((array)glob($path) as $filename) {
            $list['do'][] = preg_replace('/^.*\W([\w]+)\.php$/', '$1', $filename);
        }
        return $list;
    }
}

?>

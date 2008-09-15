<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @package    MyNETS
 * @author     KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @chengelog  [2008/03/17] Ver1.2.0
 * ========================================================================
 */

class admin_Information
{
    var $tablename;

    var $information_id;

    var $page = 1;

    var $pagesize = 15;

    function admin_Information()
    {
        $this->tablename = MYNETS_PREFIX_NAME . 'c_admin_information';
    }

    function setId($id)
    {
        $this->information_id = $id;
    }

    function setCategory($category)
    {
        $this->category = $category;
    }

    function addData($option)
    {
        db_insert($this->tablename, $option);
    }

    function getData($viewflag = '0')
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . $this->tablename . " "
             . "WHERE "
                    . "c_admin_information_id = ? ";
        /*if ($viewflag === '0') {
            $sql .= "AND "
                        . "c_view_flag <> 0 ";
        }*/
        $params = array(intval($this->information_id));
        $result = db_get_row($sql, $params);
        return $result;
    }

    function delData()
    {
        $sql = "DELETE "
             . "FROM "
                    . $this->tablename . " "
             . "WHERE "
                    . "c_admin_information_id = ? ";
        $params = array(intval($this->information_id));
        db_query($sql, $params);
    }

    function chgData($flg)
    {
        $sql = "UPDATE "
                    . $this->tablename . " "
             . "SET "
                    . "c_view_flag = ? "
             . "WHERE "
                    . "c_admin_information_id = ? ";
        $params = array(intval($flg), intval($this->information_id));
        db_query($sql, $params);
    }

    function chgInfoData($data, $where)
    {
        return db_update($this->tablename, $data, $where);
    }

    function getList($page, $pagesize, &$pager, $viewflag = '')
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . $this->tablename . " ";

        if ($this->category) {
            $where = "WHERE "
                        . "category = '" . $this->category . "' ";
        }

        if ($viewflag == '0') {
            if ($where) {
                $where .= "AND "
                        . "c_view_flag = 0 ";
            } else {
                $where  = "WHERE "
                        . "c_view_flag = 0 ";
            }
        }
        $sql = $sql . $where
                . "ORDER BY "
                        . "r_datetime DESC ";
        $result = db_get_all_limit($sql, ($page-1) * $pagesize, $pagesize, $pager);

        $sql    = "SELECT "
                        . "count(*) "
                . "FROM "
                        . $this->tablename . " ";
        $sql    = $sql . $where;

        $total_num = db_get_one($sql);
        $pager     = admin_make_pager($page, $pagesize, $total_num);
        return $result;
    }

    function getCategoryList($viewflag = '0')
    {
        $sql = "SELECT "
                    . "category "
             . "FROM "
                    . $this->tablename . " ";
        if ($viewflag === '0') {
            $sql .= "AND "
                        . "c_view_flag <> 0 ";
        }
        $sql .= "GROUP BY "
                    . "category ";
        $result = db_get_all($sql);
    }
}
?>

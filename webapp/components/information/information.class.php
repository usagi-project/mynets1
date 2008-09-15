<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @project    UsagiProject 2006-2007
 * @author     Kunitsuji <kunitsuji@gmail.com>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @chengelog  [2008/03/11]
 * ========================================================================
 */

//サイトのインフォメーション情報を取得すrう

class Information
{
    var $uid;

    var $category;

    var $tablename;

    var $totalnum;

    function Information($uid = NULL)
    {
        $this->uid = $uid;
        $this->tablename = MYNETS_PREFIX_NAME . 'c_admin_information';
    }

    function setCategory($category)
    {
        $this->category = $category;
    }

    function getList($page, $pagesize)
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . $this->tablename . " ";
        $where = "WHERE "
                    . "c_view_flag = 0 ";
        if ($this->category) {
            $where = "AND "
                        . "cateogry = ? ";
        }
        $sql = $sql . $where
                . "ORDER BY "
                        . "r_datetime DESC ";
        $params = array(strval($this->category));
        $result = db_get_all_limit($sql, (intval($page) - 1) * intval($pagesize), intval($pagesize), $params);

        $sql = "SELECT count(*) "
             . "FROM "
                     . $this->tablename . " ";
        $sql = $sql . $where;
        $this->totalnum = db_get_one($sql);
        return $result;
    }

    function getBody($c_admin_information_id) {
        $sql = "SELECT "
                    . "body "
             . "FROM "
                    . $this->tablename . " "
             . "WHERE "
                    . "c_admin_information_id = " . intval($c_admin_information_id);
        $result = db_get_one($sql);
        return $result;
    }

    function getTotalNum()
    {
        return $this->totalnum;
    }
}
?>

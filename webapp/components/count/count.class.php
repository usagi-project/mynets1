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

//会員のデータの保存を行うクラス

class Data_Count
{
    var $uid;

    var $c_member_data_id = null;

    function Data_Count($uid)
    {
        $this->uid = $uid;
        $this->getData();
    }

    //会員データが存在しているかどうかを返す
    function getData()
    {
        $sql = "SELECT "
                    . "c_member_data_id "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_member_data "
             . "WHERE "
                    . "c_member_id = ? ";
        $params = array(intval($this->uid));
        $result = db_get_one($sql, $params);
        if (!$result) {
            return false;
        } else {
            $this->c_member_data_id = $result;
            return true;
        }
    }

    function addCount($column, $count = 1)
    {

        if (!$this->c_member_data_id) {
            $sql = "INSERT INTO "
                        . MYNETS_PREFIX_NAME . "c_member_data "
                 . "(`" . $column . "`,`created_at`,`updated_at`,`c_member_id`) "
                 . "VALUES "
                 . "(" . $count . ",'" . db_now() . "','" . db_now() . "'," . intval($this->uid) . ") ";
            $result = db_query($sql);
        } else {
            $sql = "UPDATE "
                        . MYNETS_PREFIX_NAME . "c_member_data "
                 . "SET "
                        . "`" . $column . "` = `" . $column . "` + " . intval($count) . ", "
                        . "`updated_at` = '" . db_now() . "' "
                 . "WHERE "
                        . "c_member_data_id = " . intval($this->c_member_data_id);
            $result = db_query($sql);
        }
        //print_r($sql);
        //exit;
        if (!$result) {
            return false;
        } else {
            return true;
        }
    }

    function getCount($column)
    {
        $sql = "SELECT "
                    . "`" . $column . "` "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_member_data_id "
             . "WHERE "
                    . "c_member_id = ? ";
        $params = array(intval($this->uid));
        $result = db_get_one($sql, $params);
        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

}
?>

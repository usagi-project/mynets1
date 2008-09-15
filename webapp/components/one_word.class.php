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
 * @chengelog  [2007/12/17]
 * ========================================================================
 */

//今日の一言を行うためのクラス

class OneWord
{
    var $uid;

    var $id_to;

    var $oid;

    var $result;

    var $oneword;

    var $total_num = 0;

    //会員IDのセット
    function setUid($uid)
    {
        $this->uid = $uid;
    }

    //コメント先IDのセット
    function setId_to($id_to)
    {
        $this->id_to = $id_to;
    }


    //ひとことIDのセット
    function setOid($oid)
    {
        $this->oid = $oid;
    }

    //会員の最新のコメントを取得
    function get()
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_one_word "
             . "WHERE "
                    . "c_member_id = ? "
             . "AND "
                    . "comment <> '' "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $params = array(intval($this->uid));
        $this->result = db_get_row($sql, $params);
        return $this->result['comment'];
    }

    //会員の最新のコメント2件を取得
    function gettwo()
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_one_word "
             . "WHERE "
                    . "c_member_id = " . intval($this->uid)
             . " AND "
                    . "comment <> '' "
             . " ORDER BY "
                    . "r_datetime DESC ";
        return db_get_all_limit($sql, 0, 2);
    }

    //一言をセット
    function set($oneword)
    {
        $this->oneword = $oneword;
    }

    //一言を書き込み
    function add()
    {
        $data = array(
                    'c_member_id' => intval($this->uid),
                    'c_one_word_id_to' => intval($this->id_to),
                    'comment'     => strval($this->oneword),
                    'r_datetime'  => db_now(),
                );
        db_insert(MYNETS_PREFIX_NAME . 'c_one_word', $data);
    }

    //一言を削除
    function delete()
    {
        $params = array(intval($this->oid), intval($this->uid));
        $sql = 'DELETE FROM ' . MYNETS_PREFIX_NAME . 'c_one_word WHERE c_one_word_id = ? AND c_member_id = ?';
        return db_query($sql, $params);
    }

    //全体のひとことを指定件数取得
    function getList($count = 10, $page = 1)
    {
        $sql = "SELECT SQL_CALC_FOUND_ROWS "
                    . "max(c_one_word_id) as id "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_one_word "
             . "WHERE "
                    . "comment <> '' "
             . "GROUP BY "
                    . "c_member_id "
             . "ORDER BY "
                    . "id DESC ";

        $idlist = db_get_all_limit($sql, (intval($page)-1)*intval($count), $count);
        $sql = "SELECT FOUND_ROWS() ";
        $total_num = db_get_one($sql);
        //ここからコメントを取得する
        $result = array();
        if ($idlist)
        {
            foreach ($idlist as $value)
            {
                $result[] = $this->getWord($value['id']);
            }
        }
        $this->total_num = $total_num;
        return $result;
    }

    //自分のひとことを指定件数取得
    function getListMember($c_member_id, $count = 10, $page = 1)
    {
        $sql = "SELECT SQL_CALC_FOUND_ROWS "
                    . "c_one_word_id as id "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_one_word "
             . "WHERE "
                    . "comment <> '' "
             . "AND "
                    . "c_member_id = ? "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $params = array(intval($c_member_id));
        $idlist = db_get_all_limit($sql, (intval($page)-1)*intval($count), $count, $params);
        $sql = "SELECT FOUND_ROWS() ";
        $total_num = db_get_one($sql);
        //ここからコメントを取得する
        $result = array();
        if ($idlist)
        {
            foreach ($idlist as $value)
            {
                $result[] = $this->getWord($value['id']);
            }
        }
        $this->total_num = $total_num;
        return $result;
    }

    //フレンドのひとことを指定件数取得
    function getListFriend($c_member_id, $count = 10, $page = 1)
    {
        $friends = db_friend_c_member_id_list($c_member_id, true);
        //フレンドがいる場合
        if ($friends)
        {
            $ids = implode(',', array_map('intval', $friends)) . ',' . $c_member_id;
        }
        else
        {
            $ids = intval($c_member_id);
        }

        $sql = "SELECT SQL_CALC_FOUND_ROWS "
                    . "c_one_word_id as id "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_one_word "
             . "WHERE "
                    . "comment <> '' "
             . "AND "
                    . "c_member_id IN (" . $ids . ") "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $params = array(intval($c_member_id));
        $idlist = db_get_all_limit($sql, (intval($page)-1)*intval($count), $count, $params);
        $sql = "SELECT FOUND_ROWS() ";
        $total_num = db_get_one($sql);
        //ここからコメントを取得する
        $result = array();
        if ($idlist)
        {
            foreach ($idlist as $value)
            {
                $result[] = $this->getWord($value['id']);
            }
        }
        $this->total_num = $total_num;
        return $result;
    }

    function getWord($id)
    {
        $sql = "SELECT c_one_word_id_to FROM "
                     . MYNETS_PREFIX_NAME . "c_one_word "
             . "WHERE c_one_word_id = " . intval($id);
        $result = db_get_one($sql);

        if($result) {
            $sql = "SELECT a.*, b.nickname, c.comment as comment_to, d.c_member_id as c_member_id_to, d.nickname as nickname_to FROM "
                         . MYNETS_PREFIX_NAME . "c_one_word as a, "
                         . MYNETS_PREFIX_NAME . "c_member as b, "
                         . MYNETS_PREFIX_NAME . "c_one_word as c, "
                         . MYNETS_PREFIX_NAME . "c_member as d "
                 . "WHERE a.c_one_word_id = " . intval($id) . " "
                 . "AND a.c_member_id = b.c_member_id "
                 . "AND a.c_one_word_id_to = c.c_one_word_id "
                 . "AND c.c_member_id = d.c_member_id ";
            $result = db_get_row($sql);
            if(empty($result)) {
                $sql = "SELECT a.*, b.nickname FROM "
                             . MYNETS_PREFIX_NAME . "c_one_word as a, "
                             . MYNETS_PREFIX_NAME . "c_member as b "
                     . "WHERE a.c_one_word_id = " . intval($id) . " "
                     . "AND a.c_member_id = b.c_member_id ";
                $result = db_get_row($sql);
            }
        } else {
            $sql = "SELECT a.*, b.nickname FROM "
                         . MYNETS_PREFIX_NAME . "c_one_word as a, "
                         . MYNETS_PREFIX_NAME . "c_member as b "
                 . "WHERE a.c_one_word_id = " . intval($id) . " "
                 . "AND a.c_member_id = b.c_member_id ";
            $result = db_get_row($sql);
        }

        return $result;
    }

    function getTotalNum()
    {
        return $this->total_num;
    }
}
?>

<?php

/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @project    OpenPNE UsagiProject 2006-2007
 * @author     Kuniharu Tsujioka <kunitsuji@m-s.co.jp>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @chengelog  [2008/01/12]
 * ========================================================================
 */

//日記関連の処理を行う

class UsagiComponentsCommunity
{
    var $uid;

    var $topicid;

    var $commentid;

    //トピックのデータ
    var $result_topic;

    //コメントのデータ
    var $result_comment;

    //トピックの更新日時
    var $topic_edittime;

    //コメントの更新日時
    var $comment_edittime;

    //自分の日記閲覧日時
    var $topic_viewtime;

    function UsagiComponentsCommunity()
    {
    }

    //会員IDのセット
    function setUid($uid)
    {
        $this->uid = $uid;
    }

    //topicIDをセット
    function setTopicId($id)
    {
        $this->topicid = $id;
    }

    //トピックコメントIDをセット
    function setTopicCommentId($id)
    {
        $this->commentid = $id;
    }

    //トピックのデータを取得する
    function setTopicData($data)
    {
        $this->result_topic = $data;
    }

    //コメントのデータを取得する
    function setCommentData($data)
    {
        $this->result_comment = $data;
    }

    //コメントIDからコメントデータを取得する
    function getCommentDataToId()
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic_comment "
             . "WHERE "
                    . "c_commu_topic_comment_id = ? ";
        $params = array(intval($this->commentid));
        $result = db_get_row($sql, $params);
        $this->result_comment = $result;
    }

    //日記IDから日記データを取得する
    function getTopicDataToId()
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic "
             . "WHERE "
                    . "c_commu_topic_id = ? ";
        $params = array(intval($this->topicid));
        $result = db_get_row($sql, $params);
        $this->result_topic = $result;
    }

    //コメントデータから更新日時を取得
    function getCommentEditTime()
    {
        $this->comment_edittime = $this->result_comment['e_datetime'];
    }

    //自分の最新コメントのIDを取得する
    function getMyCommentId()
    {
        $sql = "SELECT "
                    . "c_commu_topic_comment_id "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic_comment "
             . "WHERE "
                    . "c_member_id = ? "
             . "AND "
                    . "c_commu_topic_id  = ? "
             . "ORDER BY "
                    . "r_datetime DESC "
             . "LIMIT "
                    . "0, 1 ";
        $params = array(intval($this->uid), intval($this->topicid));
        $result = db_get_one($sql, $params);
        $this->setDiaryCommentId($result);
    }

    //自分の最新コメントの日時を取得する
    //処理後、日記の最新更新日時を取得する
    function getMyCommentDateTime()
    {
        $sql = "SELECT "
                    . "r_datetime "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic_comment "
             . "WHERE "
                    . "c_member_id = ? "
             . "AND "
                    . "c_commu_topic_id  = ? "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $params = array(intval($this->uid), intval($this->topicid));
        $result = db_get_row($sql, $params);
        $this->comment_edittime = $result['r_datetime'];
        //日記の更新日時をセットしておく
        $this->getDiaryEditTime();
    }

    //最新コメントが自分かどうかを判定
    function chkLastComment()
    {
        $sql = "SELECT "
                    . "c_member_id "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic_comment "
             . "WHERE "
                    . "c_commu_topic_id  = ? "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $params = array(intval($this->topicid));
        $result = db_get_row($sql, $params);
        //echo $result['c_member_id']."<br>";
        if ($result['c_member_id'] == $this->uid) {
            return true;
        } else {
            return false;
        }
    }

    //日記の最新コメントの日時を取得する
    function getDiaryEditTime()
    {
        $sql = "SELECT "
                    . "e_datetime "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic "
             . "WHERE "
                    . "c_commu_topic_id = ? ";

        $params = array(intval($this->topicid));
        $result = db_get_one($sql, $params);
        $this->diary_edittime = $result;
    }

    /*
     *自分がコメントをつけた後に、日記の更新日時が変わったのか？
     *
     *@return bool true/false
     *
     */
    function chkCommentNew()
    {
        if (strtotime($this->comment_edittime) < strtotime($this->topic_edittime)) {
            return true;
        } else {
            return false;
        }
    }

    /*
     *自分が閲覧した後に、日記の更新日時が変わったのか？
     *
     *@return bool true/false
     *
     */
    function getMyViewTime()
    {
        //日記のIDと閲覧テーブルの日記IDから
        //自分が閲覧した日記の日時を取得
        $sql = "SELECT "
                    . "r_datetime "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_etsuran "
             . "WHERE "
                    . "c_member_id_from = ? "
             . "AND "
                    . "c_commu_topic_id = ? "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $params = array(intval($this->uid), intval($this->topicid));
        $result = db_get_row($sql, $params);
        $this->diary_viewtime = $result['r_datetime'];
        //echo $result['r_datetime']."<BR>";
        //日記の更新日時をセットしておく
        $this->getDiaryEditTime();
    }


    /*
     *自分が閲覧後に、日記の更新日時が変わったのか？
     *
     *@return bool true/false
     *
     */
    function chkMyViewNew()
    {
        //見てコメントをつけた場合、閲覧よりも確実にコメント更新日時が上になるので、
        //最新コメントが自分かどうかを判定して返す。
        if ($this->chkLastComment()) {
            return false;
        }
        if (strtotime($this->topic_viewtime) < strtotime($this->topic_edittime)) {
            return true;
        } else {
            return false;
        }
    }

    function chkCommentEditFlag($u, $topic_id)
    {
        //$comment_flag = new UsagiComponentsDiary();
        $this->setUid($u);
        $this->setTopcId($topic_id);
        $this->getMyCommentDateTime();
        $flag = $this->chkCommentNew();
        return $flag;
    }

    function chkCommentViewFlag($u, $topic_id)
    {
        //$comment_flag = new UsagiComponentsDiary();
        $this->setUid($u);
        $this->setTopicId($topic_id);
        $this->getMyViewTime();
        $flag = $this->chkMyViewNew();
        return $flag;
    }


}
?>

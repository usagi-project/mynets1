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

//コミュニティ検索用クラス
class Community_Search
{
    var $keyword ;

    var $result = array();
    var $resultCommu  = array();
    var $resultTopic  = array();
    var $resultComent = array();

    var $target_commu_id;
    var $target_commu_topic_id;
    var $target_commu_topic_comment_id;

    var $page = 1;
    var $pagesize = 20;

    var $numrows;
    var $_total_num = 0;

    function Community_Search()
    {
        $this->__construct();
    }

    function __construct()
    {
    }

    function setKeyword($keyword)
    {
        //KeyWORDがスペースで区切られている可能性
        if (!$keyword) {
            return false;
        }
        //全角を半角に変換
        $keyword = mb_convert_kana($keyword, 's');
        //$keyword = str_replace('　', ' ', $keyword);
        //配列に変換
        $arrKeyword = preg_split('/[\s]+/',$keyword);
        //$arrKeyword = explode(' ', $keyword);
        $this->keyword = $arrKeyword;
    }

    function setTargetCommuId($target_commu_id)
    {
        $this->target_commu_id = $target_commu_id;
    }

    function setTargetCommuTopicId($target_commu_topic_id)
    {
        $this->target_commu_topic_id = $target_commu_topic_id;
    }

    function setTargetCommuTopicCommentId($target_commu_topic_coment_id)
    {
        $this->target_commu_topic_comment_id = $target_commu_topic_comment_id;
    }

    function setLimitOffset($page, $pagesize)
    {
        $this->page     = $page;
        $this->pagesize = $pagesize;
    }

    function getResult()
    {
        return $this->result;
    }
    function getResultComment()
    {
        return $this->resultComment;
    }
    function getResultTopic()
    {
        return $this->resultTopic;
    }
    function getResultCommu()
    {
        return $this->resultCommu;
    }

    function getKeyword()
    {
        return $this->keyword;
    }
    function numrows()
    {
        return $this->numrows;
    }

    function searchComment($flag = 'AND')
    {
        $data = array();
        //コメントを検索
        $sql = "SELECT  SQL_CALC_FOUND_ROWS "
                    . "tc.* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic_comment as tc, "
                    . MYNETS_PREFIX_NAME . "c_commu as c ";

        $tmp = array();
        foreach($this->keyword as $val)
        {
            if ($val)
            {
                $tmp[] = " tc.body LIKE '%".mysql_real_escape_string($val)."%' ";
            }
        }
        //2009-01-10 kuniharu tsujioka update 非公開コミュのぶんを取り除く
        $sql .= "WHERE c.public_flag <> 'auth_commu_member' "
                    . "AND c.c_commu_id = tc.c_commu_id ";
        if(count($tmp) > 0)
        {
            // AND なり OR で連結してWHERE を作成
            $sql .= 'AND (' . implode($flag, $tmp) . ') ';
        }
        $sql .= "GROUP BY tc.c_commu_topic_comment_id "
              . "ORDER BY "
                    . "tc.r_datetime DESC";

        $result  = db_get_all_limit($sql, ($this->page-1)*$this->pagesize, $this->pagesize);
        $numrows = db_get_one("SELECT FOUND_ROWS() ");
        //ここでコメントデータにTOPIC題名とコミュニティ題名、個別コメントへのリンクを追加する
        foreach ($result as $key=>$value) {
            $topic = $this->getTopicData($value['c_commu_topic_id']);
            $result[$key]['topic_name'] = $topic['name'];
            $commu = $this->getCommuData($value['c_commu_id']);
            $result[$key]['commu_name'] = $commu['name'];
            $result[$key]['commu_info'] = $commu['info'];
            $result[$key]['commu_image'] = $commu['image_filename'];
            $topickind = ($topic['event_flag']) ? 'event' : 'topic';
            $result[$key]['url'] = './?m=pc&a=page_c_' . $topickind . '_detail&target_c_commu_topic_id=' .$value['c_commu_topic_id']. '&page='
            .$this->getCommentPage($value['c_commu_topic_id'],$value['c_commu_topic_comment_id'],$value['number']);
        }
        $this->numrows = $numrows;
        return $result;
    }


    function searchTopic()
    {
        $data = array();
        //コメントを検索
        $sql = "SELECT "
                    . "c_commu_topic_id "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic "
             . "WHERE "
                    . "name LIKE ? "
             . "ORDER BY "
                    . "r_datetime DESC ";
        foreach ($this->keyword as $value) {
            $params = array('%'.strval($value).'%');
            //DB接続はMyNETS::DBを使う
            if (!$value) {
                continue;
            }
            $result = db_get_all($sql, $params);
            if ($result) {
                foreach ($result as $id) {
                    $data[] = $id['c_commu_topic_id'];
                }
            }
        }
        $data = array_merge($data);
        $this->resultTopic = $data;
    }
    function getTopic()
    {
        $inkey = implode(',', $this->resultTopic);
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic "
             . "WHERE "
                    . "c_commu_topic_id IN (" . $inkey . ") "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $result = db_get_all_limit($sql, ($this->page-1)*$this->pagesize, $this->pagesize);
        //ここでTOPICデータにコミュニティ題名を追加する
        foreach ($result as $key=>$value) {
            $commu = $this->getCommuData($value['c_commu_id']);
            $result[$key]['commu_name'] = $commu['name'];
            $result[$key]['commu_info'] = $commu['info'];
        }
        return $result;
    }
    function searchCommu()
    {
        $data = array();

        $sql = "SELECT "
                    . "c_commu_id "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu "
             . "WHERE "
                    . "( name LIKE ? "
                    . "OR "
                            . "info LIKE ? )"
             //. "AND "
             //       . "public_flag <> 'auth_commu_member' "
             . "ORDER BY "
                    . "r_datetime DESC ";
        foreach ($this->keyword as $value) {
            $params = array('%'.strval($value).'%', '%'.strval($this->value).'%');
            //DB接続はMyNETS::DBを使う
            if (!$value) {
                continue;
            }
            $result = db_get_all($sql, $params);
            if ($result) {
                foreach ($result as $id) {
                    $data[] = $id['c_commu_id'];
                }
            }
        }
        $data = array_merge($data);
        $this->resultCommu = $data;
    }


    function getCommu()
    {
        $inkey = implode(',', $this->resultCommu);
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu "
             . "WHERE "
                    . "c_commu_id IN (" . $inkey . ") "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $result = db_get_all_limit($sql, ($this->page-1)*$this->pagesize, $this->pagesize);
        return $result;
    }
    function getCommuData($id)
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu "
             . "WHERE "
                    . "c_commu_id = " . intval($id) ;
        $result = db_get_row($sql);
        return $result;
    }
    function getTopicData($id)
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic "
             . "WHERE "
                    . "c_commu_topic_id = " . intval($id) ;
        $result = db_get_row($sql);
        return $result;
    }

    //2008-08-06 KUNIHARU Tsujioka 新着コミュニティリスト from encafe kazu_a thanks
    /**
     * 新着コミュニティを取得する
     *
     */
    function getNewCommunity()
    {
        $sql = "SELECT "
                    . "c.name AS title, "
                    . "ct.name AS category, "
                    . "m.nickname AS auther, "
                    . "c.r_datetime AS PubDate, "
                    . "c.info AS description "
             . "FROM "
                    . "(" . MYNETS_PREFIX_NAME . "c_commu as c "
                    . "INNER JOIN "
                          . MYNETS_PREFIX_NAME . "c_commu_category as ct "
                          . "ON "
                          . "c.c_commu_category_id = ct.c_commu_category_id"
                    . ") "
                    . "INNER JOIN "
                          . MYNETS_PREFIX_NAME . "c_member as m "
                          . "ON "
                          . "c.c_member_id_admin = m.c_member_id "
             . "WHERE "
                    . "c.public_flag = 'public' "
             . "OR "
                    . "c.public_flag = 'authority' "
             . "ORDER BY "
                    . "c.r_datetime DESC ";
        $result = db_get_all_limit($sql, ($this->page-1)*$this->pagesize, $this->pagesize);
        return $result;
    }

    //コメントの存在するページとページ内の位置を取得
    function getCommentPage($c_commu_topic_id, $c_commu_topic_comment_id, $number)
    {
        $sql =
        'SELECT count(*)' .
        ' FROM ' . MYNETS_PREFIX_NAME . "c_commu_topic_comment" .
        ' WHERE c_commu_topic_id = ' . intval($c_commu_topic_id);
        $comment_num = db_get_one($sql);

        $sql =
        'SELECT count(*)' .
        ' FROM ' . MYNETS_PREFIX_NAME . "c_commu_topic_comment" .
        ' WHERE c_commu_topic_comment_id < ' . $c_commu_topic_comment_id .
        ' AND c_commu_topic_id = ' . $c_commu_topic_id;
        $self_comment_num = db_get_one($sql);

        if($self_comment_num != 0) {
            $page = floor(($comment_num-$self_comment_num-1)/10)+1 . '#' . $number;
        } else {
            $page = '1';
        }
        return $page;
    }
}
?>

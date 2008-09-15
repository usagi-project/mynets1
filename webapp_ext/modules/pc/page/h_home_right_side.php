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
 * @author     Tetsuji,Katsuki <info@usagi.mynets.jp>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @chengelog  [2007/09/10] Ver1.1.1Nighty package
 *             [2007/12/20] Add getSiteNewReview and getSiteNewCommunity.
 *                          Add max days and time parameters. by Naoya Shimada.
 * ========================================================================
 */


/*
*日記の更新日付順で取得する
*※旧バージョンはe_datetimeがdate型になっているので、日付のみとなる（変更必要）
*プライベート以外、全体へ公開以上をFLAGで判定
*/
function getSiteDiary($size = 5, $public_chk = '')
{
    $sql = "SELECT "
                . "d.c_diary_id, "
                . "d.r_datetime, "
                . "d.subject, "
                . "m.nickname, "
                . "d.comment_count, "
                . "d.etsuran_count, "
                . "m.c_member_id "
          . "FROM "
                . MYNETS_PREFIX_NAME."c_diary as d, "
                . MYNETS_PREFIX_NAME."c_member as m " ;

    $wherecond = " WHERE "
                . "m.c_member_id = d.c_member_id "
                . "AND ";
    switch ($public_chk) {
        case '': //全体へ公開を取得
            $wherecond .= " (d.public_flag = 'public' or d.public_flag = 'open') ";
            break;
        case 'friend':
            $wherecond .= " d.public_flag <> 'private' ";
            break;
        case 'open':
            $wherecond .= " d.public_flag = 'open' ";
            break;
    }
    $sql .= $wherecond . " ORDER BY "
                            . "d.r_datetime DESC ";

    $result = db_get_all_limit($sql , 0, intval($size));
    return $result;
}

/*
*コミュを最新順に並べる
*topicとeventを判断する
*/
function getNewUpdateTopic($size = 5, $event = 'topic')
{
    $sql = "SELECT "
                . "ct.*, "
                . "c.name as c_commu_name, "
                . "c.c_commu_id "
          . "FROM "
                . MYNETS_PREFIX_NAME . "c_commu_topic as ct, "
                . MYNETS_PREFIX_NAME."c_commu as c " ;
    $wherecond = "WHERE "
                        . "ct.c_commu_id = c.c_commu_id "
               . "AND "
                        . "c.public_flag IN ('public', 'auth_sns') "
               . "AND ";
    switch ($event) {
        case "topic":
            $wherecond .= " ct.event_flag = 0 ";
            $sql .= $wherecond . " ORDER BY "
                                    . "e_datetime DESC";
            break;
        case "event":
            $wherecond .= " ct.event_flag = 1 ";
            //////////////////////////////////////////////////////
            //イベントの場合は過去日付を表示しないようにする
            $date = date("Y-m-d H:i:s", strtotime("now"));
            $wherecond .= "AND "
                            . "open_date >= '" . $date ."' ";
            $sql .= $wherecond . " ORDER BY "
                                    . "open_date ";
            break;
    }
    $result =  db_get_all_limit($sql , 0, intval($size));
    foreach($result as $key=>$value) {
        $number = db_commu_get_max_number4topic($value['c_commu_topic_id']);
        $result[$key]['number'] = $number;
    }
    return $result;
}

/*
*サイトの新規会員を最新順に並べる
*第２引数で登録してからの経過日数を指定可能
*/
function getSiteNewMember($size = 5, $days = 90)
{
    $sql = "SELECT "
                . "c_member_id, "
                . "nickname, "
                . "r_date "
          . "FROM "
                . MYNETS_PREFIX_NAME . "c_member "
          . "WHERE "
                . "TO_DAYS(NOW()) - TO_DAYS(r_date) <= " . $days . " "
          . "ORDER BY "
                . "c_member_id DESC ";

    $result = db_get_all_limit($sql , 0, intval($size));
    return $result;
}

/*
*サイトのログイン会員を最新ログイン順に並べる
*現在、5分以内のメンバーを抽出しているが、ここを変えれば時間を調整できる
*5分60X5=300、10分60X10=600
*/
function getSiteOnlineMember($size = 5, $minute = 5)
{
    $sql = "SELECT "
                . "c_member_id, "
                . "nickname "
          . "FROM "
                . MYNETS_PREFIX_NAME."c_member "
          . " WHERE "
                . "access_date >= '" . date("Y-m-d H:i:s", time() - 60 * $minute) . "' "
          . "ORDER BY "
                . "access_date DESC ";

    $result = db_get_all_limit($sql , 0, intval($size));
    return $result;
}

/*
*レビューの情報をレビューコメントの日付順で最新順に並べる
*/
function getSiteNewReview($size = 5)
{
    // カテゴリを表示しないなら c_review_category をINNER JOIN せず、
    // crc2.category_disp を取得しないように書き換えると速くなるかな
    $sql = "SELECT "
                . "cr.*, "
//                . "crc2.category_disp, "
                . "crc.r_datetime AS r_datetime "
          . "FROM "
                . MYNETS_PREFIX_NAME . "c_review AS cr "
                . "INNER JOIN "
                            . MYNETS_PREFIX_NAME . "c_review_comment AS crc ON (cr.c_review_id = crc.c_review_id) "
//                . "INNER JOIN "
//                            . MYNETS_PREFIX_NAME . "c_review_category AS crc2 ON (cr.c_review_category_id = crc2.c_review_category_id) "
          . "GROUP BY "
                . "crc.c_review_id "
          . "ORDER BY "
                . "crc.r_datetime DESC";

    $result = db_get_all_limit($sql , 0, intval($size));
    return $result;
}

/*
*コミュニティ自体の新着を並べる
*第２引数で作成されてからの経過日数を指定可能
*/
function getSiteNewCommunity($size = 5, $days = 90)
{
    $sql = "SELECT "
                . "* "
          . "FROM "
                . MYNETS_PREFIX_NAME . "c_commu "
          . "WHERE "
                . "TO_DAYS(NOW()) - TO_DAYS(r_date) <= " . $days . " "
          . "ORDER BY "
                . "r_datetime DESC";
    $result = db_get_all_limit($sql , 0, intval($size));
    return $result;
}
?>

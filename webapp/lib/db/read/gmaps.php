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

if (! function_exists('getDiaryDataGmaps'))
{
    function getDiaryDataGmaps($c_diary_id) {
        $sql = "select * from ".MYNETS_PREFIX_NAME."c_diary where c_diary_id = ? ";
        $params = array(intval($c_diary_id));
        $diary_data = db_get_row($sql,$params);
        $c_member = db_common_c_member4c_member_id_LIGHT($diary_data['c_member_id']);
        $diary_data['nickname'] = $c_member['nickname'];
        $diary_data['c_member_id'] = $c_member['c_member_id'];
        return $diary_data;
    }
}

if (! function_exists('getTopicDataGmaps'))
{
    function getTopicDataGmaps($c_commu_topic_id) {
        $sql = "select * from ".MYNETS_PREFIX_NAME."c_commu_topic where c_commu_topic_id = ? ";
        $params = array(intval($c_commu_topic_id));
        $topic_data = db_get_row($sql,$params);
        $c_member = db_common_c_member4c_member_id_LIGHT($topic_data['c_member_id']);
        $topic_data['nickname'] = $c_member['nickname'];
        $commu = k_p_c_home_c_commu4c_commu_id($topic_data['c_commu_id']);
        $topic_data['c_commu_id'] = $commu['c_commu_id'];
        $topic_data['communame'] = $commu['name'];
        $topic_data['image_filename'] = $commu['image_filename'];
        return $topic_data;
    }
}

if (! function_exists('db_one_diary_4c_diary_id'))
{
    function db_one_diary_4c_diary_id($c_diary_id)
    {
        $sql = "select * from ".MYNETS_PREFIX_NAME."c_diary where c_diary_id = ? ";
        $params = array(intval($c_diary_id));
        $diary_data = db_get_row($sql,$params);
        $c_member = db_common_c_member4c_member_id_LIGHT($diary_data['c_member_id']);
        $diary_data['nickname'] = $c_member['nickname'];
        $diary_data['image_filename'] = $c_member['image_filename'];
        $diary_data['c_member_id'] = $c_member['c_member_id'];
        return $diary_data;
    }
}

if (! function_exists('db_one_diary_commnet_4c_diary_comment_id'))
{
    function db_one_diary_commnet_4c_diary_comment_id($c_diary_comment_id) {
        $sql = "select * from ".MYNETS_PREFIX_NAME."c_diary_comment where c_diary_comment_id = ? ";
        $params = array(intval($c_diary_comment_id));
        $diary_comment_data = db_get_row($sql,$params);
        $c_member = db_common_c_member4c_member_id_LIGHT($diary_comment_data['c_member_id']);
        $diary_comment_data['nickname'] = $c_member['nickname'];
        $diary_comment_data['image_filename'] = $c_member['image_filename'];
        $diary_comment_data['c_member_id'] = $c_member['c_member_id'];
        $owner_diary = getDiaryDataGmaps($diary_comment_data['c_diary_id']);
        $diary_comment_data['ownernickname'] = $owner_diary['nickname'];
        $diary_comment_data['ownermemberid'] = $owner_diary['c_member_id'];
        $diary_comment_data['ownersubject'] = $owner_diary['subject'];
        return $diary_comment_data;
    }
}

if (! function_exists('db_one_topic_commnet_4c_topic_comment_id'))
{
    function db_one_topic_commnet_4c_topic_comment_id($c_topic_comment_id) {
        $sql = "select * from ".MYNETS_PREFIX_NAME."c_commu_topic_comment where c_commu_topic_comment_id = ? ";
        $params = array(intval($c_topic_comment_id));
        $topic_data = db_get_row($sql,$params);
        $c_member = db_common_c_member4c_member_id_LIGHT($topic_data['c_member_id']);
        $topic_data['nickname'] = $c_member['nickname'];
        $topic_data['image_filename'] = $c_member['image_filename'];
        $topic_data['c_member_id'] = $c_member['c_member_id'];
        $topic = getTopicDataGmaps($topic_data['c_commu_topic_id']);
        $topic_data['ownernickname'] = $topic['nickname'];
        $topic_data['ownermemberid'] = $topic['c_member_id'];
        $topic_data['topicname'] = $topic['name'];
        $topic_data['c_commu_id'] = $topic['c_commu_id'];
        $topic_data['communame'] = $topic['communame'];
        $topic_data['commu_image_filename'] = $topic['image_filename'];
        return $topic_data;
    }
}

if (! function_exists('db_diary_count_c_diary_commentself4c_diary_id'))
{
    function db_diary_count_c_diary_commentself4c_diary_id($c_dairy_id,$c_diary_comment_id)
    {
        $sql =
        ' SELECT count(*)' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment' .
        ' WHERE c_diary_comment_id < ' . $c_diary_comment_id .
        ' AND c_diary_id =' . $c_dairy_id;
        return db_get_one($sql);
    }
}

if (! function_exists('db_commu_count_c_topic_comment4c_topic_id'))
{
    function db_commu_count_c_topic_comment4c_topic_id($c_commu_topic_id)
    {
        $sql =
        'SELECT count(*)' .
        ' FROM ' . MYNETS_PREFIX_NAME . "c_commu_topic_comment" .
        ' WHERE c_commu_topic_id = ' . $c_commu_topic_id;
        return db_get_one($sql);
    }
}

if (! function_exists('db_commu_count_c_topic_commentself4c_topic_id'))
{
    function db_commu_count_c_topic_commentself4c_topic_id($c_commu_topic_id,$c_commu_topic_comment_id)
    {
        $sql =
        'SELECT count(*)' .
        ' FROM ' . MYNETS_PREFIX_NAME . "c_commu_topic_comment" .
        ' WHERE c_commu_topic_comment_id < ' . $c_commu_topic_comment_id .
        ' AND c_commu_topic_id = ' . $c_commu_topic_id;
        return db_get_one($sql);
    }
}

if (! function_exists('p_h_gmaps_list_all_search_c_diary4c_diary'))
{
    function p_h_gmaps_list_all_search_c_diary4c_diary($keyword, $page_size, $page)
    {

        //and検索を実装
        //subject,body を検索
        if ($keyword) {
            //全角空白を半角に統一
            $keyword = str_replace('　', ' ', $keyword);

            $keyword_list = explode(' ', $keyword);
            foreach ($keyword_list as $word) {
                $word = check_search_word($word);
                $where_d .= ' AND ('. MYNETS_PREFIX_NAME .'c_diary.subject '
                            . 'LIKE "%'.$word.'%" OR '. MYNETS_PREFIX_NAME .'c_diary.body '
                            . 'LIKE "%'.$word.'%")';
                $where_dc .= ' AND ('. MYNETS_PREFIX_NAME .'c_diary.subject '
                            . 'LIKE "%'.$word.'%" OR '. MYNETS_PREFIX_NAME .'c_diary_comment.body '
                            . 'LIKE "%'.$word.'%")';
            }
        }

        $sql_d =
            ' SELECT ' . MYNETS_PREFIX_NAME . 'c_diary.c_member_id, '
                       . MYNETS_PREFIX_NAME . 'c_diary.subject, '
                       . MYNETS_PREFIX_NAME . 'c_diary.body, '
                       . MYNETS_PREFIX_NAME . 'c_diary.r_datetime, '
                       . MYNETS_PREFIX_NAME . 'c_diary.image_filename_1, '
                       . MYNETS_PREFIX_NAME . 'c_diary.c_diary_id, '
                       . '"top" AS c_diary_comment_id, '
                       . '"top" AS comment_number' .
            ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary' .
            " WHERE " . MYNETS_PREFIX_NAME . "c_diary.body like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
            " AND " . MYNETS_PREFIX_NAME . "c_diary.public_flag IN ('public','open')" .
        $where_d;

        $sql_dc =
            ' SELECT ' . MYNETS_PREFIX_NAME . 'c_diary_comment.c_member_id, '
                       . MYNETS_PREFIX_NAME . 'c_diary.subject, '
                       . MYNETS_PREFIX_NAME . 'c_diary_comment.body, '
                       . MYNETS_PREFIX_NAME . 'c_diary_comment.r_datetime, '
                       . MYNETS_PREFIX_NAME . 'c_diary_comment.image_filename_1,'
                       . MYNETS_PREFIX_NAME . 'c_diary_comment.c_diary_id, '
                       . MYNETS_PREFIX_NAME . 'c_diary_comment.c_diary_comment_id, '
                       . MYNETS_PREFIX_NAME . 'c_diary_comment.comment_number' .
            ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment,' . MYNETS_PREFIX_NAME . 'c_diary' .
            " WHERE " . MYNETS_PREFIX_NAME . "c_diary_comment.body like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
            ' AND ' . MYNETS_PREFIX_NAME . 'c_diary_comment.c_diary_id = '
                    . MYNETS_PREFIX_NAME . 'c_diary.c_diary_id' .
            " AND " . MYNETS_PREFIX_NAME . "c_diary.public_flag IN ('public','open')" .
        $where_dc;

        $list_d = db_get_all($sql_d);
        $list_dc = db_get_all($sql_dc);
        $list_all = array_merge_recursive($list_d,$list_dc);
        foreach($list_all as $key => $row) {
            $c_member_id[$key] = $row["c_member_id"];
            $subject[$key] = $row["subject"];
            $body[$key] = $row["body"];
            $r_datetime[$key] = $row["r_datetime"];
            $image_filename_1[$key] = $row["image_filename_1"];
            $c_diary_id[$key] = $row["c_diary_id"];
            $c_diary_comment_id[$key] = $row["c_diary_comment_id"];
            $comment_number[$key] = $number["comment_number"];
        }
        if (count($list_all) !== 0) {
            array_multisort($r_datetime, SORT_DESC, $list_all);
        }
        $list = array_slice($list_all,(intval($page) - 1) * intval($page_size),$page_size);

        $regexp = '<cmd\s+src="gmaps"(?:\s+args="([^,&<>]+(,[\w\-\+%]+)*)?")?\s*>';
        foreach ($list as $key => $value) {
            $list[$key]['c_member'] = db_common_c_member_with_profile($value['c_member_id']);
            preg_match("/".$regexp."/i",$value['body'],$match);
            $pt = explode(',', $match[1]);
            $list[$key]['lat'] =$pt[1].'.'.$pt[2];
            $list[$key]['lon'] =$pt[3].'.'.$pt[4];
            $list[$key]['zoom'] =$pt[0];
            $list[$key]['body'] = preg_replace("/".$regexp."/i","",$value['body']);
            if($value['c_diary_comment_id'] != 'top') {
                $dnum = db_diary_count_c_diary_comment4c_diary_id($value['c_diary_id']);
                $dnum_self = db_diary_count_c_diary_commentself4c_diary_id($value['c_diary_id'],$value['c_diary_comment_id']);
                $list[$key]['c_diary_link'] = floor(($dnum-$dnum_self-1)/20)+1 . '#' . $value['comment_number'];
            } else {
                $list[$key]['c_diary_link'] = '1';
            }
        }
        return array($list,count($list_all));
    }
}

if (! function_exists('p_h_gmaps_list_all_search_c_topic4c_topic'))
{
    function p_h_gmaps_list_all_search_c_topic4c_topic($keyword, $page_size, $page)
    {

        //and検索を実装
        //subject,body を検索
        if ($keyword) {
            //全角空白を半角に統一
            $keyword = str_replace('　', ' ', $keyword);

            $keyword_list = explode(' ', $keyword);
            foreach ($keyword_list as $word) {
                $word = check_search_word($word);
                $where_d .= ' AND ('. MYNETS_PREFIX_NAME .'c_commu.name '
                            . 'LIKE "%'.$word.'%" OR '. MYNETS_PREFIX_NAME .'c_commu_topic.name '
                            . 'LIKE "%'.$word.'%" OR '. MYNETS_PREFIX_NAME .'c_commu_topic_comment.body '
                            . 'LIKE "%'.$word.'%")';
            }
        }

        $sql =
        ' SELECT ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_member_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu.name AS communame, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic.name AS commutopicname, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.body, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.image_filename1, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.r_datetime, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_commu_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic.c_commu_topic_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_commu_topic_comment_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.number, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic.event_flag' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment, '
                 . MYNETS_PREFIX_NAME . 'c_commu_topic, '
                 . MYNETS_PREFIX_NAME . 'c_commu' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.body "
                 . "like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_id = "
                 . MYNETS_PREFIX_NAME . "c_commu.c_commu_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_topic_id = "
                 . MYNETS_PREFIX_NAME . "c_commu_topic.c_commu_topic_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu.public_flag IN ('public','auth_sns')" .
        $where_d .
        " ORDER BY ". MYNETS_PREFIX_NAME ."c_commu_topic_comment.r_datetime DESC";

        $list = db_get_all_page($sql, $page, $page_size);
        $regexp = '<cmd\s+src="gmaps"(?:\s+args="([^,&<>]+(,[\w\-\+%]+)*)?")?\s*>';
        foreach ($list as $key => $value) {
            $list[$key]['c_member'] = db_common_c_member_with_profile($value['c_member_id']);
            preg_match("/".$regexp."/i",$value['body'],$match);
            $pt = explode(',', $match[1]);
            $list[$key]['lat'] =$pt[1].'.'.$pt[2];
            $list[$key]['lon'] =$pt[3].'.'.$pt[4];
            $list[$key]['zoom'] =$pt[0];
            $list[$key]['body'] = preg_replace("/".$regexp."/i","",$value['body']);
            $cnum = db_commu_count_c_topic_comment4c_topic_id($value['c_commu_topic_id']);
            $cnum_self = db_commu_count_c_topic_commentself4c_topic_id($value['c_commu_topic_id'],$value['c_commu_topic_comment_id']);
            if($cnum_self != 0) {
                $list[$key]['c_topic_link'] = floor(($cnum-$cnum_self-1)/10)+1 . '#' . $value['number'];
            } else {
                $list[$key]['c_topic_link'] = '1';
            }
        }

        $sql =
        'SELECT COUNT(*)' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment, '
                 . MYNETS_PREFIX_NAME . 'c_commu_topic, '
                 . MYNETS_PREFIX_NAME . 'c_commu' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.body "
                 . "like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_id = "
                 . MYNETS_PREFIX_NAME . "c_commu.c_commu_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_topic_id = "
                 . MYNETS_PREFIX_NAME . "c_commu_topic.c_commu_topic_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu.public_flag IN ('public','auth_sns')" .
        $where_d;
        $total_num = db_get_one($sql);
        return array($list,$total_num);
    }
}

if (! function_exists('p_h_gmaps_list_all_search_c_diary4c_diary_area'))
{
    function p_h_gmaps_list_all_search_c_diary4c_diary_area($area, $page_size, $page)
    {

        if ($area) {
            $areas = explode('_', $area);
            $n = $areas[0];
            $s = $areas[1];
            $e = $areas[2];
            $w = $areas[3];
        }

        $sql_d =
        ' SELECT ' . MYNETS_PREFIX_NAME . 'c_diary.c_member_id, '
                   . MYNETS_PREFIX_NAME . 'c_diary.subject, '
                   . MYNETS_PREFIX_NAME . 'c_diary.body, '
                   . MYNETS_PREFIX_NAME . 'c_diary.r_datetime, '
                   . MYNETS_PREFIX_NAME . 'c_diary.image_filename_1, '
                   . MYNETS_PREFIX_NAME . 'c_diary.c_diary_id, '
                   . '"top" AS c_diary_comment_id, '
                   . '"top" AS comment_number' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_diary.body "
                  . "LIKE '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        " AND " . MYNETS_PREFIX_NAME . "c_diary.public_flag IN ('public','open')";

        $sql_dc =
        ' SELECT ' . MYNETS_PREFIX_NAME . 'c_diary_comment.c_member_id, '
                   . MYNETS_PREFIX_NAME . 'c_diary.subject, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.body, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.r_datetime, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.image_filename_1,'
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.c_diary_id, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.c_diary_comment_id, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.comment_number' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment,' . MYNETS_PREFIX_NAME . 'c_diary' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_diary_comment.body "
                  . "LIKE '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        ' AND ' . MYNETS_PREFIX_NAME . 'c_diary_comment.c_diary_id = '
                  . MYNETS_PREFIX_NAME . 'c_diary.c_diary_id' .
        " AND " . MYNETS_PREFIX_NAME . "c_diary.public_flag IN ('public','open')";

        $list_d = db_get_all($sql_d);
        $list_dc = db_get_all($sql_dc);
        $list_all = array_merge_recursive($list_d,$list_dc);

        $regexp = '<cmd\s+src="gmaps"(?:\s+args="([^,&<>]+(,[\w\-\+%]+)*)?")?\s*>';
        $list_area = array();
        foreach ($list_all as $key => $value) {
            preg_match("/".$regexp."/i",$value['body'],$match);
            $pt = explode(',', $match[1]);
            $ns =$pt[1].'.'.$pt[2];
            $ew =$pt[3].'.'.$pt[4];
            if($ns > $s && $ns < $n) {
                if($e > $w) {
                    if($ew > $w && $ew < $e) {
                        $list_all[$key]['lat'] =$ns;
                        $list_all[$key]['lon'] =$ew;
                        $list_all[$key]['zoom'] =$pt[0];
                        array_push($list_area,$list_all[$key]);
                    }
                } else {
                    if($ew > $w || $ew < $e) {
                        $list_all[$key]['lat'] =$ns;
                        $list_all[$key]['lon'] =$ew;
                        $list_all[$key]['zoom'] =$pt[0];
                        array_push($list_area,$list_all[$key]);
                    }
                }
            }
        }

        foreach($list_area as $key => $row) {
            $c_member_id[$key] = $row["c_member_id"];
            $lat[$key] = $row["lat"];
            $lon[$key] = $row["lon"];
            $zoom[$key] = $row["zoom"];
            $subject[$key] = $row["subject"];
            $body[$key] = $row["body"];
            $r_datetime[$key] = $row["r_datetime"];
            $image_filename_1[$key] = $row["image_filename_1"];
            $c_diary_id[$key] = $row["c_diary_id"];
            $c_diary_comment_id[$key] = $row["c_diary_comment_id"];
            $comment_number[$key] = $row["comment_number"];
        }
        if (count($list_area) !== 0) {
            array_multisort($r_datetime, SORT_DESC, $list_area);
        }
        $list = array_slice($list_area,(intval($page) - 1) * intval($page_size),$page_size);

        foreach ($list as $key => $value) {
            $list[$key]['c_member'] = db_common_c_member_with_profile($value['c_member_id']);
            $list[$key]['body'] = preg_replace("/".$regexp."/i","",$value['body']);
            if($value['c_diary_comment_id'] != 'top') {
                $dnum = db_diary_count_c_diary_comment4c_diary_id($value['c_diary_id']);
                $dnum_self = db_diary_count_c_diary_commentself4c_diary_id($value['c_diary_id'],$value['c_diary_comment_id']);
                $list[$key]['c_diary_link'] = floor(($dnum-$dnum_self-1)/20)+1 . '#' . $value['comment_number'];
            } else {
                $list[$key]['c_diary_link'] = '1';
            }
        }
        return array($list,count($list_area));
    }
}

if (! function_exists('p_h_gmaps_list_all_search_c_topic4c_topic_area'))
{
    function p_h_gmaps_list_all_search_c_topic4c_topic_area($area, $page_size, $page)
    {

        if ($area) {
            $areas = explode('_', $area);
            $n = $areas[0];
            $s = $areas[1];
            $e = $areas[2];
            $w = $areas[3];
        }

        $sql =
        ' SELECT ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_member_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu.name AS communame, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic.name AS commutopicname, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.body, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.image_filename1, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.r_datetime, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_commu_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic.c_commu_topic_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_commu_topic_comment_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.number, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic.event_flag' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic, '
                   . MYNETS_PREFIX_NAME . 'c_commu' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.body "
                   . "like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_id = "
                   . MYNETS_PREFIX_NAME . "c_commu.c_commu_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_topic_id = "
                   . MYNETS_PREFIX_NAME . "c_commu_topic.c_commu_topic_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu.public_flag IN ('public','auth_sns')" .
        " ORDER BY ". MYNETS_PREFIX_NAME ."c_commu_topic_comment.r_datetime DESC";

        $list_c = db_get_all($sql);

        $regexp = '<cmd\s+src="gmaps"(?:\s+args="([^,&<>]+(,[\w\-\+%]+)*)?")?\s*>';
        $list_area = array();
        foreach ($list_c as $key => $value) {
            preg_match("/".$regexp."/i",$value['body'],$match);
            $pt = explode(',', $match[1]);
            $ns =$pt[1].'.'.$pt[2];
            $ew =$pt[3].'.'.$pt[4];
            if($ns > $s && $ns < $n) {
                if($e > $w) {
                    if($ew > $w && $ew < $e) {
                        $list_c[$key]['lat'] =$ns;
                        $list_c[$key]['lon'] =$ew;
                        $list_c[$key]['zoom'] =$pt[0];
                        array_push($list_area,$list_c[$key]);
                    }
                } else {
                    if($ew > $w || $ew < $e) {
                        $list_c[$key]['lat'] =$ns;
                        $list_c[$key]['lon'] =$ew;
                        $list_c[$key]['zoom'] =$pt[0];
                        array_push($list_area,$list_c[$key]);
                    }
                }
            }
        }

        $list = array_slice($list_area,(intval($page) - 1) * intval($page_size),$page_size);

        foreach ($list as $key => $value) {
            $list[$key]['c_member'] = db_common_c_member_with_profile($value['c_member_id']);
            $list[$key]['body'] = preg_replace("/".$regexp."/i","",$value['body']);
            $cnum = db_commu_count_c_topic_comment4c_topic_id($value['c_commu_topic_id']);
            $cnum_self = db_commu_count_c_topic_commentself4c_topic_id($value['c_commu_topic_id'],$value['c_commu_topic_comment_id']);
            if($cnum_self != 0) {
                $list[$key]['c_topic_link'] = floor(($cnum-$cnum_self-1)/10)+1 . '#' . $value['number'];
            } else {
                $list[$key]['c_topic_link'] = '1';
            }
        }

        return array($list,count($list_area));
    }
}

if (! function_exists('p_h_gmaps_list_all_search_c_diary4c_diary_id'))
{
    function p_h_gmaps_list_all_search_c_diary4c_diary_id($id, $page_size, $page)
    {

        $sql_d =
        ' SELECT ' . MYNETS_PREFIX_NAME . 'c_diary.c_member_id, '
                   . MYNETS_PREFIX_NAME . 'c_diary.subject, '
                   . MYNETS_PREFIX_NAME . 'c_diary.body, '
                   . MYNETS_PREFIX_NAME . 'c_diary.r_datetime, '
                   . MYNETS_PREFIX_NAME . 'c_diary.image_filename_1, '
                   . MYNETS_PREFIX_NAME . 'c_diary.c_diary_id, '
                   . '"top" AS c_diary_comment_id, '
                   . '"top" AS comment_number' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_diary.body like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        " AND " . MYNETS_PREFIX_NAME . "c_diary.public_flag IN ('public','open')" .
        " AND " . MYNETS_PREFIX_NAME . "c_diary.c_diary_id = " . $id;

        $sql_dc =
        ' SELECT ' . MYNETS_PREFIX_NAME . 'c_diary_comment.c_member_id, '
                   . MYNETS_PREFIX_NAME . 'c_diary.subject, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.body, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.r_datetime, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.image_filename_1,'
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.c_diary_id, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.c_diary_comment_id, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.comment_number' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment,' . MYNETS_PREFIX_NAME . 'c_diary' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_diary_comment.body like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        ' AND ' . MYNETS_PREFIX_NAME . 'c_diary_comment.c_diary_id = ' . MYNETS_PREFIX_NAME . 'c_diary.c_diary_id' .
        " AND " . MYNETS_PREFIX_NAME . "c_diary.public_flag IN ('public','open')" .
        " AND " . MYNETS_PREFIX_NAME . "c_diary_comment.c_diary_id = " . $id;

        $list_d = db_get_all($sql_d);
        $list_dc = db_get_all($sql_dc);
        $list_all = array_merge_recursive($list_d,$list_dc);

        foreach($list_all as $key => $row) {
            $c_member_id[$key] = $row["c_member_id"];
            $subject[$key] = $row["subject"];
            $body[$key] = $row["body"];
            $r_datetime[$key] = $row["r_datetime"];
            $image_filename_1[$key] = $row["image_filename_1"];
            $c_diary_id[$key] = $row["c_diary_id"];
            $c_diary_comment_id[$key] = $row["c_diary_comment_id"];
            $comment_number[$key] = $row["comment_number"];
        }
        if (count($list_all) !== 0) {
            array_multisort($r_datetime, SORT_DESC, $list_all);
        }
        $list = array_slice($list_all,(intval($page) - 1) * intval($page_size),$page_size);

        $regexp = '<cmd\s+src="gmaps"(?:\s+args="([^,&<>]+(,[\w\-\+%]+)*)?")?\s*>';
        foreach ($list as $key => $value) {
            $list[$key]['c_member'] = db_common_c_member_with_profile($value['c_member_id']);
            preg_match("/".$regexp."/i",$value['body'],$match);
            $pt = explode(',', $match[1]);
            $list[$key]['lat'] =$pt[1].'.'.$pt[2];
            $list[$key]['lon'] =$pt[3].'.'.$pt[4];
            $list[$key]['zoom'] =$pt[0];
            $list[$key]['body'] = preg_replace("/".$regexp."/i","",$value['body']);
            if($value['c_diary_comment_id'] != 'top') {
                $dnum = db_diary_count_c_diary_comment4c_diary_id($value['c_diary_id']);
                $dnum_self = db_diary_count_c_diary_commentself4c_diary_id($value['c_diary_id'],$value['c_diary_comment_id']);
                $list[$key]['c_diary_link'] = floor(($dnum-$dnum_self-1)/20)+1 . '#' . $value['comment_number'];
            } else {
                $list[$key]['c_diary_link'] = '1';
            }
        }
        return array($list,count($list_all));
    }
}

if (! function_exists('p_h_gmaps_list_all_search_c_topic4c_topic_id'))
{
    function p_h_gmaps_list_all_search_c_topic4c_topic_id($id, $page_size, $page)
    {

        $sql =
        ' SELECT ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_member_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu.name AS communame, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic.name AS commutopicname, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.body, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.image_filename1, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.r_datetime, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_commu_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic.c_commu_topic_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_commu_topic_comment_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.number, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic.event_flag' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic, '
                   . MYNETS_PREFIX_NAME . 'c_commu' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.body "
                   . "like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_id = "
                   . MYNETS_PREFIX_NAME . "c_commu.c_commu_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_topic_id = "
                   . MYNETS_PREFIX_NAME . "c_commu_topic.c_commu_topic_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu.public_flag IN ('public','auth_sns')" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_topic_id = " . $id .
        " ORDER BY ". MYNETS_PREFIX_NAME ."c_commu_topic_comment.r_datetime DESC";

        $list = db_get_all_page($sql, $page, $page_size);
        $regexp = '<cmd\s+src="gmaps"(?:\s+args="([^,&<>]+(,[\w\-\+%]+)*)?")?\s*>';
        foreach ($list as $key => $value) {
            $list[$key]['c_member'] = db_common_c_member_with_profile($value['c_member_id']);
            preg_match("/".$regexp."/i",$value['body'],$match);
            $pt = explode(',', $match[1]);
            $list[$key]['lat'] =$pt[1].'.'.$pt[2];
            $list[$key]['lon'] =$pt[3].'.'.$pt[4];
            $list[$key]['zoom'] =$pt[0];
            $list[$key]['body'] = preg_replace("/".$regexp."/i","",$value['body']);
            $cnum = db_commu_count_c_topic_comment4c_topic_id($value['c_commu_topic_id']);
            $cnum_self = db_commu_count_c_topic_commentself4c_topic_id($value['c_commu_topic_id'],$value['c_commu_topic_comment_id']);
            if($cnum_self != 0) {
                $list[$key]['c_topic_link'] = floor(($cnum-$cnum_self-1)/10)+1 . '#' . $value['number'];
            } else {
                $list[$key]['c_topic_link'] = '1';
            }
        }

        $sql =
        'SELECT COUNT(*)' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment, '
                 . MYNETS_PREFIX_NAME . 'c_commu_topic, '
                 . MYNETS_PREFIX_NAME . 'c_commu' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.body "
                 . "like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_id = "
                 . MYNETS_PREFIX_NAME . "c_commu.c_commu_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_topic_id = "
                 . MYNETS_PREFIX_NAME . "c_commu_topic.c_commu_topic_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu.public_flag IN ('public','auth_sns')" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_topic_id = " . $id;
        $total_num = db_get_one($sql);
        return array($list,$total_num);
    }
}

if (! function_exists('p_h_gmaps_list_all_search_c_topic4c_commu_id'))
{
    function p_h_gmaps_list_all_search_c_topic4c_commu_id($cmid, $page_size, $page)
    {

        $sql =
        ' SELECT ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_member_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu.name AS communame, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic.name AS commutopicname, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.body, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.image_filename1, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.r_datetime, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_commu_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_commu_topic_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_commu_topic_comment_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.number, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic.event_flag' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic, '
                   . MYNETS_PREFIX_NAME . 'c_commu' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.body "
                   . "like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_id = "
                   . MYNETS_PREFIX_NAME . "c_commu.c_commu_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_topic_id = "
                   . MYNETS_PREFIX_NAME . "c_commu_topic.c_commu_topic_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu.public_flag IN ('public','auth_sns')" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_id = " . $cmid .
        " ORDER BY ". MYNETS_PREFIX_NAME ."c_commu_topic_comment.r_datetime DESC";

        $list = db_get_all_page($sql, $page, $page_size);
        $regexp = '<cmd\s+src="gmaps"(?:\s+args="([^,&<>]+(,[\w\-\+%]+)*)?")?\s*>';
        foreach ($list as $key => $value) {
            $list[$key]['c_member'] = db_common_c_member_with_profile($value['c_member_id']);
            preg_match("/".$regexp."/i",$value['body'],$match);
            $pt = explode(',', $match[1]);
            $list[$key]['lat'] =$pt[1].'.'.$pt[2];
            $list[$key]['lon'] =$pt[3].'.'.$pt[4];
            $list[$key]['zoom'] =$pt[0];
            $list[$key]['body'] = preg_replace("/".$regexp."/i","",$value['body']);
            $cnum = db_commu_count_c_topic_comment4c_topic_id($value['c_commu_topic_id']);
            $cnum_self = db_commu_count_c_topic_commentself4c_topic_id($value['c_commu_topic_id'],$value['c_commu_topic_comment_id']);
            if($cnum_self != 0) {
                $list[$key]['c_topic_link'] = floor(($cnum-$cnum_self-1)/10)+1 . '#' . $value['number'];
            } else {
                $list[$key]['c_topic_link'] = '1';
            }
        }

        $sql =
        'SELECT COUNT(*)' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment, '
                 . MYNETS_PREFIX_NAME . 'c_commu_topic, '
                 . MYNETS_PREFIX_NAME . 'c_commu' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.body "
                 . "like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_id = "
                 . MYNETS_PREFIX_NAME . "c_commu.c_commu_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_topic_id = "
                 . MYNETS_PREFIX_NAME . "c_commu_topic.c_commu_topic_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu.public_flag IN ('public','auth_sns')" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_id = " . $cmid;
        $total_num = db_get_one($sql);
        return array($list,$total_num);
    }
}

if (! function_exists('p_h_gmaps_list_all_search_c_diary4c_member_id'))
{
    function p_h_gmaps_list_all_search_c_diary4c_member_id($mid, $page_size, $page)
    {

        $sql_d =
        ' SELECT ' . MYNETS_PREFIX_NAME . 'c_diary.c_member_id, '
                   . MYNETS_PREFIX_NAME . 'c_diary.subject, '
                   . MYNETS_PREFIX_NAME . 'c_diary.body, '
                   . MYNETS_PREFIX_NAME . 'c_diary.r_datetime, '
                   . MYNETS_PREFIX_NAME . 'c_diary.image_filename_1, '
                   . MYNETS_PREFIX_NAME . 'c_diary.c_diary_id, '
                   . '"top" AS c_diary_comment_id, '
                   . '"top" AS comment_number' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_diary.body like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        " AND " . MYNETS_PREFIX_NAME . "c_diary.public_flag IN ('public','open')" .
        " AND " . MYNETS_PREFIX_NAME . "c_diary.c_member_id = " . $mid;

        $sql_dc =
        ' SELECT ' . MYNETS_PREFIX_NAME . 'c_diary_comment.c_member_id, '
                   . MYNETS_PREFIX_NAME . 'c_diary.subject, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.body, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.r_datetime, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.image_filename_1,'
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.c_diary_id, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.c_diary_comment_id, '
                   . MYNETS_PREFIX_NAME . 'c_diary_comment.comment_number' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_diary_comment,' . MYNETS_PREFIX_NAME . 'c_diary' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_diary_comment.body like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        ' AND ' . MYNETS_PREFIX_NAME . 'c_diary_comment.c_diary_id = ' . MYNETS_PREFIX_NAME . 'c_diary.c_diary_id' .
        " AND " . MYNETS_PREFIX_NAME . "c_diary.public_flag IN ('public','open')" .
        " AND " . MYNETS_PREFIX_NAME . "c_diary_comment.c_member_id = " . $mid;

        $list_d = db_get_all($sql_d);
        $list_dc = db_get_all($sql_dc);
        $list_all = array_merge_recursive($list_d,$list_dc);

        foreach($list_all as $key => $row) {
            $c_member_id[$key] = $row["c_member_id"];
            $subject[$key] = $row["subject"];
            $body[$key] = $row["body"];
            $r_datetime[$key] = $row["r_datetime"];
            $image_filename_1[$key] = $row["image_filename_1"];
            $c_diary_id[$key] = $row["c_diary_id"];
            $c_diary_comment_id[$key] = $row["c_diary_comment_id"];
            $comment_number[$key] = $row["comment_number"];
        }
        if (count($list_all) !== 0) {
            array_multisort($r_datetime, SORT_DESC, $list_all);
        }
        $list = array_slice($list_all,(intval($page) - 1) * intval($page_size),$page_size);

        $regexp = '<cmd\s+src="gmaps"(?:\s+args="([^,&<>]+(,[\w\-\+%]+)*)?")?\s*>';
        foreach ($list as $key => $value) {
            $list[$key]['c_member'] = db_common_c_member_with_profile($value['c_member_id']);
            preg_match("/".$regexp."/i",$value['body'],$match);
            $pt = explode(',', $match[1]);
            $list[$key]['lat'] =$pt[1].'.'.$pt[2];
            $list[$key]['lon'] =$pt[3].'.'.$pt[4];
            $list[$key]['zoom'] =$pt[0];
            $list[$key]['body'] = preg_replace("/".$regexp."/i","",$value['body']);
            if($value['c_diary_comment_id'] != 'top') {
                $dnum = db_diary_count_c_diary_comment4c_diary_id($value['c_diary_id']);
                $dnum_self = db_diary_count_c_diary_commentself4c_diary_id($value['c_diary_id'],$value['c_diary_comment_id']);
                $list[$key]['c_diary_link'] = floor(($dnum-$dnum_self-1)/20)+1 . '#' . $value['comment_number'];
            } else {
                $list[$key]['c_diary_link'] = '1';
            }
        }
        return array($list,count($list_all));
    }
}

if (! function_exists('p_h_gmaps_list_all_search_c_topic4c_member_id'))
{
    function p_h_gmaps_list_all_search_c_topic4c_member_id($mid, $page_size, $page)
    {

        $sql =
        ' SELECT ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_member_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu.name AS communame, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic.name AS commutopicname, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.body, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.image_filename1, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.r_datetime, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_commu_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic.c_commu_topic_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.c_commu_topic_comment_id, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic_comment.number, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic.event_flag' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment, '
                   . MYNETS_PREFIX_NAME . 'c_commu_topic, '
                   . MYNETS_PREFIX_NAME . 'c_commu' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.body "
                   . "like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_id = "
                   . MYNETS_PREFIX_NAME . "c_commu.c_commu_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_topic_id = "
                   . MYNETS_PREFIX_NAME . "c_commu_topic.c_commu_topic_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu.public_flag IN ('public','auth_sns')" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_member_id = " . $mid .
        " ORDER BY ". MYNETS_PREFIX_NAME ."c_commu_topic_comment.r_datetime DESC";

        $list = db_get_all_page($sql, $page, $page_size);
        $regexp = '<cmd\s+src="gmaps"(?:\s+args="([^,&<>]+(,[\w\-\+%]+)*)?")?\s*>';
        foreach ($list as $key => $value) {
            $list[$key]['c_member'] = db_common_c_member_with_profile($value['c_member_id']);
            preg_match("/".$regexp."/i",$value['body'],$match);
            $pt = explode(',', $match[1]);
            $list[$key]['lat'] =$pt[1].'.'.$pt[2];
            $list[$key]['lon'] =$pt[3].'.'.$pt[4];
            $list[$key]['zoom'] =$pt[0];
            $list[$key]['body'] = preg_replace("/".$regexp."/i","",$value['body']);
            $cnum = db_commu_count_c_topic_comment4c_topic_id($value['c_commu_topic_id']);
                $cnum_self = db_commu_count_c_topic_commentself4c_topic_id($value['c_commu_topic_id'],$value['c_commu_topic_comment_id']);
            if($cnum_self != 0) {
                $list[$key]['c_topic_link'] = floor(($cnum-$cnum_self-1)/10)+1 . '#' . $value['number'];
            } else {
                $list[$key]['c_topic_link'] = '1';
            }
        }

        $sql =
        'SELECT COUNT(*)' .
        ' FROM ' . MYNETS_PREFIX_NAME . 'c_commu_topic_comment, '
                 . MYNETS_PREFIX_NAME . 'c_commu_topic, '
                 . MYNETS_PREFIX_NAME . 'c_commu' .
        " WHERE " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.body "
                 . "like '%<cmd src=\"gmaps\" args=\"%,%,%,%,%\">%'" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_id = "
                 . MYNETS_PREFIX_NAME . "c_commu.c_commu_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_commu_topic_id = "
                 . MYNETS_PREFIX_NAME . "c_commu_topic.c_commu_topic_id" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu.public_flag IN ('public','auth_sns')" .
        " AND " . MYNETS_PREFIX_NAME . "c_commu_topic_comment.c_member_id = " . $mid;
        $total_num = db_get_one($sql);
        return array($list,$total_num);
    }
}
?>
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


//タグの抽出

/**
 * タグリスト取得
 *
 * ORDER BY タグ名称//後日変更可能性あり
 * @return array タグリスト
 */
if (! function_exists('getTagList'))
{
    function getTagList()
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_tags ' .
                ' ORDER BY RAND()';
        $result = db_get_all_limit($sql,0,20);
        return $result ;
    }
}

/**
 * タグ名称取得
 * @param タグID
 *
 * @return タグ名
 */
if (! function_exists('getTagName'))
{
    function getTagName($c_tags_id)
    {
        $sql = 'SELECT c_tags_name FROM ' . MYNETS_PREFIX_NAME . 'c_tags ' .
                ' WHERE c_tags_id = ? ';
        return db_get_row($sql,array(intval($c_tags_id)));
    }
}

/**
 * タグID取得
 * @param タグ名
 *
 * @return タグID
 */
if (! function_exists('getTagID'))
{
    function getTagID($c_tags_name)
    {
        $sql = 'SELECT c_tags_id FROM ' . MYNETS_PREFIX_NAME . 'c_tags ' .
                ' WHERE c_tags_name = ? ';
        return db_get_one($sql,array($c_tags_name));
    }
}

/**
 * 日記で利用されているタグの抽出
 *
 * @param c_entry_id 日記またはトピックID
 * @param c_entry_flag　デフォルト０＝日記、１はトピック。９は両方
 * @return array タグリスト
 */
if (! function_exists('getEntryTag'))
{
    function getEntryTag($c_entry_id, $c_entry_flag = '0')
    {
        $sql = 'SELECT c_tags_id FROM ' . MYNETS_PREFIX_NAME . 'c_entry_tag ' ;
        if ($c_entry_flag == '0') {
            $sql .= ' WHERE c_entry_id = ? AND c_entry_flag = 0';
        } else {
            $sql .= ' WHERE c_entry_id = ? AND c_entry_flag = 1';
        }
        $list = db_get_col($sql,array(intval($c_entry_id)));
        $ids = join(',', $list);
        $sql = 'SELECT * FROM '.MYNETS_PREFIX_NAME.'c_tags' .
            ' WHERE c_tags_id IN ('.$ids.')';
        $tag_list = db_get_all($sql);
        return $tag_list;
    }
}


/**
 * 該当メンバーの利用タグ一覧
 *
 */
if (! function_exists('getUseTag'))
{
    function getUseTag($c_member_id, $c_entry_flag = '0')
    {
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_entry_tag ' ;
        if ($c_entry_flag == '0') {
            $sql .= ' WHERE c_member_id = ? AND c_entry_flag = 0';
        } elseif ($c_entry_flag == '1') {
            $sql .= ' WHERE c_emember_id = ? AND c_entry_flag = 1';
        } else {
            $sql .= ' WHERE c_member_id = ?';
        }
        $sql .= " GROUP BY c_tags_id";
        $list = db_get_all($sql,array(intval($c_member_id)));
        foreach($list as $key => $value) {
            $list[$key]['c_tags_name'] = getTagName($value['c_tags_id']);
        }
        return $list;
    }
}

/**
 * tagIDから該当メンバーの日記を得る
 *
 * @param int $c_diary_category_id
 * @param int c_member_id     Targetmember
 * @param int c_tags_id
 * @param int c_entry_flag      diary or topic
 * @return array
 */
if (! function_exists('getDiaryList4Tags'))
{
    function getDiaryList4Tags($c_member_id, $c_tags_id, $page, $page_size, $c_entry_flag = '0',$u = null)
    {
        $sql = 'SELECT c_entry_id FROM '.MYNETS_PREFIX_NAME.'c_entry_tag WHERE c_tags_id = ?';
        $diary_list = db_get_col($sql, array(intval($c_tags_id)));
        $ids = join(',', $diary_list);

        $pf_cond = db_diary_public_flag_condition($c_member_id, $u);
        $sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM '.MYNETS_PREFIX_NAME.'c_diary' .
            ' WHERE c_diary_id IN ('.$ids.') AND c_member_id = ? ' . $pf_cond . ' ORDER BY r_datetime DESC';
        $params = array(intval($c_member_id));
        $list = db_get_all_page($sql, $page, $page_size, $params);
        $sql = "SELECT FOUND_ROWS() ";
        $total_num = db_get_one($sql);

        return array($list, false, false, $total_num);
    }
}


?>

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

//タグ機能を実装
//2007/01/30 KT

/**
 * タグを追加する
 *@param c_entry_id       日記のID、またはトピックのID
 *@oaram c_entry_flag       日記またはトピックの切り分け　０＝日記、１＝トピック
 *@param c_tags_id    タグのID
 *@param c_member_id     登録するメンバーID
 */
if (! function_exists('setEntryTag'))
{
    function setEntryTag($c_entry_id, $c_entry_flag = '0', $c_tags_id, $c_member_id)
    {

        $data = array(
            'c_entry_id' => intval($c_entry_id),
            'c_entry_flag' => intval($c_entry_flag),
            'c_tags_id' => intval($c_tags_id),
            'c_member_id' => intval($c_member_id),
            'r_datetime' => db_now(),
        );
        return db_insert(MYNETS_PREFIX_NAME . 'c_entry_tag', $data);
    }
}

/**
 * タグを追加する
 *@param c_member_id         タグを作成した人のID
 *@oaram c_tags_name          タグそのもの
 */
if (! function_exists('setTagName'))
{
    function setTagName($c_member_id = '1', $c_tags_name)
    {

        $data = array(
            'c_member_id' => intval($c_member_id),
            'c_tags_name' => strval($c_tags_name),
            'r_datetime' => db_now(),
        );
        return db_insert(MYNETS_PREFIX_NAME . 'c_tags', $data);
    }
}

/*タグを1こ削除する
 *
 *@param c_entry_tag_id     タグのID
 *
 */
if (! function_exists('delTagID'))
{
    function delTagID($c_entry_tag_id)
    {
        $sql = "DELETE FROM " . MYNETS_PREFIX_NAME . "c_entry_tag WHERE c_entry_tag_id = ?";
        $params = intval($c_entry_tag_id);
        db_query($sql, array($params));
        return true;
    }
}
/*
 *エントリーIDに関連するタグを削除
 *@param c_entry_id
 *@param c_entry_flag
 */
if (! function_exists('delEntryIDTag'))
{
    function delEntryIDTag($c_entry_id, $c_entry_flag = '0')
    {
        $sql = "DELETE FROM ".MYNETS_PREFIX_NAME."c_entry_tag WHERE c_entry_id = ? " ;
        $sql .= " AND c_entry_flag = ".intval($c_entry_flag) ;
        $params = intval($c_entry_id);
        db_query($sql, array($params));
        return true;
    }
}
?>

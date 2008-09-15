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

//ログイン画面表示データ取得クラス
class Login_View
{


    var $page = 0;
    var $pagesize = 3;

    function Login_View()
    {
        $this->__construct();
    }

    function __construct()
    {
    }


    //外部公開可能日記の取得
    function getOpenDiary()
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_diary "
             . "WHERE "
                    . "public_flag = 'open' "
             . "ORDER BY "
                    . "r_datetime DESC ";
        $result = db_get_all_limit($sql, $this->page, $this->pagesize);
        if ($result) {
            foreach ($result as $key=>$value) {
                $result[$key]['url'] = $this->getUrl($value['c_diary_id'], 'pc', 'diary');
                $c_member = db_common_c_member4c_member_id($value['c_member_id']);
                $result[$key]['c_member'] = $c_member['nickname'];
                $result[$key]['c_member_image'] = $c_member['image_filename_1'];
            }
        }
        return $result;
    }

    //外部公開可能コミュの取得
    function getOpenCommu($flag = '')
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu "
             . "WHERE "
                    . "open_flag = 1 "
             . "ORDER BY ";
        if (!$flag) {
            $sql .=  "r_datetime DESC ";    //作成日順
        } else {
            $sql .= "RAND() ";              //ランダム3件
        }
        $result = db_get_all_limit($sql, $this->page, $this->pagesize);
        if ($result) {
            foreach ($result as $key=>$value) {
                $result[$key]['url'] = $this->getUrl($value['c_commu_id'], 'pc', 'commu');
            }
        }
        return $result;
    }

    //外部公開可能トピックの取得
    function getOpenTopic()
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic "
             . "WHERE "
                    . "open_flag = 1 "
             . "AND "
                    . "event_flag = 0 "
             . "ORDER BY "
                    . "e_datetime DESC ";

        $result = db_get_all_limit($sql, $this->page, $this->pagesize);
        if ($result) {
            foreach ($result as $key=>$value) {
                $result[$key]['url'] = $this->getUrl($value['c_commu_topic_id'], 'pc', 'topic');
            }
        }
        return $result;
    }

    //外部公開可能イベントの取得
    function getOpenEvent()
    {
        $sql = "SELECT "
                    . "* "
             . "FROM "
                    . MYNETS_PREFIX_NAME . "c_commu_topic "
             . "WHERE "
                    . "open_flag = 1 "
             . "AND "
                    . "event_flag = 1 "
             . "ORDER BY "
                    . "e_datetime DESC ";

        $result = db_get_all_limit($sql, $this->page, $this->pagesize);
        if ($result) {
            foreach ($result as $key=>$value) {
                $result[$key]['url'] = $this->getUrl($value['c_commu_topic_id'], 'pc', 'event');
            }
        }
        return $result;
    }

    //外部公開のIDからの対象URL生成
    //@param string データタイプ　初期値Diary
    function getUrl($id, $module = 'pc', $dataType = 'diary')
    {
        $genUrl = '';
        switch ($dataType) {
            case 'diary':
                $genUrl .= "./?m=diary&a=page_detail&target_c_diary_id=" . $id;
                break;
            case 'commu':
                $genUrl .= "./?m=pc&a=page_c_home&target_c_commu_id=" . $id;
                break;
            case 'topic':
                $genUrl .= "./?m=pc&a=page_c_topic_detail&target_c_commu_topic_id=" . $id;
                break;
            case 'event':
                $genUrl .= "./?m=pc&a=page_c_event_detail&target_c_commu_topic_id=" . $id;
                break;
        }
        return $genUrl;
    }

    /**
     * カスタムCSSの情報を取得する
     * 2008-04-22 KUNIHARU Tsujioka
     *
     */
    function getCustumCss()
    {
        return p_common_c_siteadmin4target_pagename('inc_custom_css');
    }

    /**
     * border_**、bg_**の情報を取得する
     * 2008-04-22 KUNIHARU Tsujioka
     * sample $bg=getBorderBg()
     * border_01 = $bg['boder_01']
     * bg_01     = $bg['bg_01']
     */
    function getBorderBg()
    {
        $c_sns_config = db_select_c_sns_config();
        return $c_sns_config;
    }


}
?>

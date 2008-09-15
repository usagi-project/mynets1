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

require_once OPENPNE_WEBAPP_DIR.'/components/community/Community_Search.class.php';
require_once OPENPNE_WEBAPP_DIR.'/components/Pager.class.php';
class pc_page_h_commu_keyword extends OpenPNE_Action
{
    function execute($requests)
    {

        $keyword = $requests['keyword'];
        $page    = $requests['page'];
        $target  = $requests['target'];
        $submit  = $requests['submit'];
        if (!$page) {
            $page = 1;
        }
        switch ($target) {
            case '0':
                $target_name = 'コミュニティ';
                breaak;
            case '1':
                $target_name = 'トピック';
                breaak;
            case '2':
            default:
                $target_name = 'トピックコメント';
                break;
        }
        $pagesize = 20;
        if ($submit == 'OR検索')
        {
            $searchflag = 'OR';
        }
        else
        {
            $searchflag = 'AND';
        }
        //keyword未入力の場合
        //スルーする
        if ($keyword) {
            $search = new Community_Search();
            $search->setKeyword($keyword);
            $search->setLimitOffset($page, $pagesize);
            switch ($target) {
                case '2':
                default:
                    //$search->searchComment();
                    $resultComment = $search->searchComment($searchflag);
                    $this->set('resultComment', $resultComment);
                    break;
                case '1':
                    $resultTopic   = $search->searchTopic($searchflag);
                    $this->set('resultTopic', $resultTopic);
                    break;
                case '0':
                    $resultCommu   = $search->searchCommu($searchflag);
                    $this->set('resultCommu', $resultCommu);
                    break;
            }
            $numrows = $search->numrows();
            ///////////////////////
            //Pagerセット
            $pager = new Usagi_Pager();
            $returnurl = "?m=pc&a=page_h_commu_keyword"
                        . "&target=".$target."&page=%d&keyword=".urlencode($keyword);
            $page_link = $pager->set($numrows, $pagesize, $returnurl);
        } else {
            $msg = "キーワードが未入力です。";
        }
///////////////////////
        $this->set('msg', $msg);
        $this->set('keyword', $keyword);
        $this->set('numrows', $numrows);
        $this->set('target_name', $target_name);
        $this->set('page_link', $page_link);
        return 'success';
    }
}

?>

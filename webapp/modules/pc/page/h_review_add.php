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

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

class pc_page_h_review_add extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $keyword = $requests['keyword'];
        $category_id = $requests['category_id'];
        $page = $requests['page'];
        $search_flag = $requests['search_flag'];
        // ----------
        $page_size = 10; //固定

        $this->set('inc_navi', fetch_inc_navi("h"));
        $this->set('category_disp', p_h_review_add_category_disp());
        $this->set('category_id', $category_id);
        $this->set('keyword', $keyword);

        if ($search_flag) {
            if (empty($keyword) || empty($category_id)) {
                if (empty($keyword)) $err_msg[] = 'キーワードを入力してください';
                if (empty($category_id)) $err_msg[] = 'カテゴリを選択してください';
            } else {
                list($search_result, $page, $pages, $total_num)
                    = p_h_review_add_search_result($keyword, $category_id, $page);
            }
        }

        $this->set('search_result', $search_result);
        $this->set('page', $page);
        $this->set('is_prev', (bool)($pages && $page > 1));
        $this->set('is_next', (bool)($pages && $page < $pages));
        $this->set('err_msg', $err_msg);

        $start_num = ($page - 1) * $page_size + 1;
        $end_num = $page * $page_size;
        if ($page_size > count($search_result)) {
            $end_num = ($page - 1) * $page_size + count($search_result);
        }

        $this->set('total_num', $total_num);
        $this->set('start_num', $start_num);
        $this->set('end_num', $end_num);

        return 'success';
    }
}

?>

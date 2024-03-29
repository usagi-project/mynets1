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
 * @author     UsagiProject <info@usagi-project.org>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi-project.org/member.html>
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

class pc_page_h_review_list_product extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $c_review_id = $requests['c_review_id'];
        $direc = $requests['direc'];
        $page = $requests['page'];
        // ----------
        $page_size = 30;
        $page = $page + $direc;

        $this->set('inc_navi', fetch_inc_navi('h'));


        $asin = p_h_review_list_product_c_review4c_review_id($c_review_id);
        $c_review = p_h_review_write_product4asin($asin['asin']);
        if (is_array($c_review['ItemAttributes']['Author']))
        {
            $authors = array_unique($c_review['ItemAttributes']['Author']);
            $c_review['author'] = implode(', ', $authors);
        }
        else
        {
            $c_review['author'] = $c_review['ItemAttributes']['Author'];
        }
        if (is_array($c_review['ItemAttributes']['Aritst']))
        {
            $artists = array_unique($c_review['ItemAttributes']['Aritst']);
            $c_review['artist'] = implode(', ', $artists);
        }
        else
        {
            $c_review['artist'] = $c_review['ItemAttributes']['Aritst'];
        }
        $c_review['asin'] = $asin['asin'];
        $c_review['category_disp'] = $asin['category_disp'];
        $c_review['c_review_category_id'] = $asin['c_review_category_id'];
        //2009-03-11 KUNIHARU Tsujioka update
        // fix #202
        $c_review['c_review_id'] = $c_review_id;
        $this->set('c_review', $c_review);
//print_r($asin);
//exit;
        list($c_review_list, $is_prev, $is_next, $total_num, $start_num, $end_num) = p_h_review_list_product_c_review_list4c_review_id($c_review_id, $page, $page_size);
        $this->set('c_review_list', $c_review_list);
        $this->set("is_prev", $is_prev);
        $this->set("is_next", $is_next);
        $this->set("page", $page);
        $this->set("total_num", $total_num);
        $this->set('start_num', $start_num);
        $this->set('end_num', $end_num);

        return 'success';
    }
}

?>

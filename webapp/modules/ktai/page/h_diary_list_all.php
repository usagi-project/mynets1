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

class ktai_page_h_diary_list_all extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $direc = $requests['direc'];
        $page = $requests['page'];
        $keyword = $requests['keyword'];
        // ----------

        //日記一覧
        $page = $page + $direc;
        $page_size = 10;

        //検索結果
        $result = p_h_diary_list_all_search_c_diary4c_diary($keyword, $page_size, $page);

        $this->set('new_diary_list', $result[0]);
        $this->set('is_prev', $result[1]);
        $this->set('is_next', $result[2]);
        $this->set('c_diary_search_list_count', $result[3]);

        $pager = array();
        $pager['start'] = $page_size * ($page - 1) + 1;
        if (($pager['end'] = $page_size * $page) > $result[3]) {
            $pager['end'] = $result[3];
        }
        $this->set('page', $page);
        $this->set('pager', $pager);

        // 半角空白を全角に統一
        $keyword = str_replace(' ', '　', $keyword);

        $this->set('keyword', $keyword);

        return 'success';
    }
}

?>

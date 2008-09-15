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

class ktai_page_h_friend_find_all extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        // --- リクエスト変数
        $nickname = $requests['nickname'];
        $birth_year = $requests['birth_year'];
        $birth_month = $requests['birth_month'];
        $birth_day = $requests['birth_day'];
        $page = $requests['page'];
        // ----------

        $profiles = array();
        if ($_REQUEST['profile']) {
            $profiles = p_h_search_result_check_profile($_REQUEST['profile']);
        }
        $this->set('profiles', $profiles);

        $limit = 20;
        $this->set("page", $page);

        //検索デフォルト値表示用
        $cond = array(
            'birth_year' => $birth_year,
            'birth_month' => $birth_month,
            'birth_day' => $birth_day,
        );
        $cond_like = array(
            'nickname' => $nickname,
        );
        $this->set("nickname", $nickname);
        $this->set("cond", array_merge($cond, $cond_like));


        $result = p_h_search_result_search($cond, $cond_like, $limit, $page, $u, $profiles);
        $this->set("target_friend_list", $result[0]);
        $pager = array(
            "page_prev" => $result[1],
            "page_next" => $result[2],
            "total_num" => $result[3],
        );

        $pager["disp_start"] = $limit * ($page - 1) + 1;
        if (($disp_end  = $limit * $page) > $pager['total_num']) {
            $pager['disp_end'] = $pager['total_num'];
        } else {
            $pager['disp_end'] = $disp_end;
        }

        $this->set("pager", $pager);


        $tmp = array();
        foreach ($cond as $key => $value) {
            if ($value) {
                $tmp[] = $key . '=' . urlencode(mb_convert_encoding($value, 'SJIS-win', 'UTF-8'));
            }
        }
        foreach ($cond_like as $key => $value) {
            if ($value) {
                $tmp[] = $key . '=' . urlencode(mb_convert_encoding($value, 'SJIS-win', 'UTF-8'));
            }
        }
        foreach ($profiles as $key => $value) {
            if ($value['c_profile_option_id']) {
                $v = $value['c_profile_option_id'];
            } else {
                $v = urlencode(mb_convert_encoding($value, 'SJIS-win', 'UTF-8'));
            }
            $tmp[] = urlencode("profile[{$key}]") . '=' . $v;
        }
        $search_condition = implode("&", $tmp);
        $this->set("search_condition", $search_condition);


        $this->set('profile_list', db_common_c_profile_list());
        return 'success';
    }
}

?>

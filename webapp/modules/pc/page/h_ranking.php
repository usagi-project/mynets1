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

class pc_page_h_ranking extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $kind = $requests['kind'];
        // ----------

        $this->set('inc_navi', fetch_inc_navi('h'));

        $this->set('kind', $kind);


        $limit = 10;
        switch ($kind) {
        case "friend":
            $list = pne_cache_call(3600, 'p_h_ranking_c_friend_ranking', $limit);
            foreach ($list as $key => $value) {
                $list[$key]['c_member'] = db_common_c_member_with_profile($value['c_member_id']);
            }
            break;
        case "com_member":
            $list = pne_cache_call(3600, 'p_h_ranking_c_commu_member_ranking', $limit);
            foreach ($list as $key => $value) {
                $list[$key]['c_commu'] = _db_c_commu4c_commu_id($value['c_commu_id']);
            }
            break;
        case "com_comment":
            $list = pne_cache_call(3600, 'p_h_ranking_c_commu_topic_comment_ranking', $limit);
            foreach ($list as $key => $value) {
                $list[$key]['c_commu'] = _db_c_commu4c_commu_id($value['c_commu_id']);
            }
            break;
        case "ashiato":
        default:
            $list = pne_cache_call(3600, 'p_h_ranking_c_ashiato_ranking', $limit);
            foreach ($list as $key => $value) {
                $list[$key]['c_member'] = db_common_c_member_with_profile($value['c_member_id']);
                if (!$list[$key]['c_member']) {
                    unset($list[$key]);
                }
            }
            break;
        }

        $rank_list = array();
        if ($list) {
            $rank = 1;
            $current_count = null;
            foreach ($list as $item) {
                if ($item['count'] != $current_count) {
                    $rank = $rank + count($rank_list[$rank]);
                    $current_count = $item['count'];
                }
                $rank_list[$rank][] = $item;
            }
        }
        $this->set("rank_list", $rank_list);

        return 'success';
    }
}

?>

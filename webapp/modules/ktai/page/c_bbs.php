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

class ktai_page_c_bbs extends OpenPNE_Action
{
    function execute($requests)
    {
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];


        // --- リクエスト変数
        $target_c_commu_topic_id = $requests['target_c_commu_topic_id'];
        $direc      = $requests['direc'];
        $page       = $requests['page'];
        $sort_order = $requests['sort_order'];
        // ----------

        $page_size = 5;
        $page += $direc;

        //ページ
        $this->set("page", $page);

        //画面切り替えのために自分の情報を取得する
        $c_member = db_common_c_member4c_member_id($u);
        $this->set('c_member',$c_member);
        //自分のディスプレイを判定する
        $MyDisplayTemplate = getMyDisplay($c_member['mobile_view']);
        $this->set('MyDisplayTemplate',$MyDisplayTemplate['template_foldername']);
        //トピックのコメントリスト
        $list = k_p_c_bbs_c_commu_topic_comment_list4c_c_commu_topic_id($target_c_commu_topic_id,
                                                                        $u,
                                                                        $page_size,
                                                                        $page,
                                                                        $sort_order
                                                                        );
        //sort_orderをつける
        $this->set("sort_order", $sort_order);
        $this->set("c_commu_topic_comment_list", $list[0]);
        $this->set("is_prev", $list[1]);
        $this->set("is_next", $list[2]);
        //print_r($list);

        //トピック名
        $this->set("c_commu_topic_name", k_p_c_bbs_c_commu_topic_name4c_commu_topic_id($target_c_commu_topic_id));
        //トピックID,トピック
        $this->set("c_commu_topic_id", $target_c_commu_topic_id);
        $this->set("c_commu_topic", c_event_detail_c_topic4c_commu_topic_id($target_c_commu_topic_id));

        //コミュニティ
        $c_commu = k_p_c_bbs_c_commu4c_commu_topic_id($target_c_commu_topic_id);
        $c_commu_id = $c_commu['c_commu_id'];
        $this->set("c_commu", $c_commu);

        //--- 権限チェック
        //コミュニティの存在の有無
        if (!$c_commu) {
            handle_kengen_error();
        }

        //コミュニティ掲示板閲覧権限
        if (!p_common_is_c_commu_view4c_commu_idAc_member_id($c_commu_id, $u)) {
            handle_kengen_error();
        }

        //掲示板の閲覧権限 tplでやっている
        $this->set("is_c_commu_view", p_common_is_c_commu_view4c_commu_idAc_member_id($c_commu['c_commu_id'], $u));
        $this->set("is_c_commu_member", _db_is_c_commu_member($c_commu['c_commu_id'], $u));
        $this->set("is_c_event_member", _db_is_c_event_member($target_c_commu_topic_id, $u));
        $this->set("is_c_event_admin", _db_is_c_event_admin($target_c_commu_topic_id, $u));


        //メンバーがコミュニティ管理者かどうか
        $this->set("is_admin", k_p_c_bbs_is_admin4c_member_id_c_commu_topic_id($u, $target_c_commu_topic_id));
        //コミュニティ管理者
        $this->set("c_member_admin", k_p_c_bbs_c_member_admin4c_commu_topic_id($target_c_commu_topic_id));

        if (MAIL_ADDRESS_HASHED) {
            $mail_address = "t{$target_c_commu_topic_id}-".t_get_user_hash($u)."@".MAIL_SERVER_DOMAIN;
        } else {
            $mail_address = "t{$target_c_commu_topic_id}"."@".MAIL_SERVER_DOMAIN;
        }
        $mail_address = urlencode(MAIL_ADDRESS_PREFIX) . $mail_address;
        if (MAIL_ADDRESS_HASHED) {
            $mail_address2 = "et{$target_c_commu_topic_id}-".t_get_user_hash($u)."@".MAIL_SERVER_DOMAIN;
        } else {
            $mail_address2 = "et{$target_c_commu_topic_id}"."@".MAIL_SERVER_DOMAIN;
        }
        $mail_address2 = urlencode(MAIL_ADDRESS_PREFIX) . $mail_address2;
        if($GLOBALS['__Framework']['ktai_carrier'] == 'docomo') {
            $gps_address = OPENPNE_URL.'gmaps/gpsdocomo.php/'.$GLOBALS['KTAI_URL_TAIL'].'/'.$mail_address;
            $gps_address2 = OPENPNE_URL.'gmaps/gpsdocomo.php/'.$GLOBALS['KTAI_URL_TAIL'].'/'.$mail_address2;
            $gps_type = 'docomo';
        } elseif($GLOBALS['__Framework']['ktai_carrier'] == 'au') {
            $gps_address = 'device:gpsone?url='.OPENPNE_URL.'gmaps/gpsau.php/'.$GLOBALS['KTAI_URL_TAIL'].'/'.$mail_address.'&ver=1&datum=0&unit=1&acry=0&number=0';
            $gps_address2 = 'device:gpsone?url='.OPENPNE_URL.'gmaps/gpsau.php/'.$GLOBALS['KTAI_URL_TAIL'].'/'.$mail_address2.'&ver=1&datum=0&unit=1&acry=0&number=0';
            $gps_type = 'au';
        } elseif($GLOBALS['__Framework']['ktai_carrier'] == 'softbank') {
            $gps_address = 'location:auto?url='.OPENPNE_URL.'gmaps/gpssoftbank.php/'.$GLOBALS['KTAI_URL_TAIL'].'/'.$mail_address;
            $gps_address2 = 'location:auto?url='.OPENPNE_URL.'gmaps/gpssoftbank.php/'.$GLOBALS['KTAI_URL_TAIL'].'/'.$mail_address2;
            $gps_type = 'softbank';
        }
        $this->set("mail_address", $mail_address);
        $this->set("mail_address2", $mail_address2);
        $this->set('gps_address', $gps_address);
        $this->set('gps_address2', $gps_address2);
        $this->set('gps_type', $gps_type);
        return 'success';
    }
}

?>

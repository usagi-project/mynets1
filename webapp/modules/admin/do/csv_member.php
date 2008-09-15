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
 * @version    MyNETS,v 1.1.0
 * @since      File available since Release 1.1.0 Nighty
 * @chengelog  [2007/04/22] Ver1.1.0Nighty package
 * ========================================================================
 */

/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class admin_do_csv_member extends OpenPNE_Action
{
    function execute($requests)
    {
        $start_id = $requests['start_id'];
        $end_id = $requests['end_id'];

        $member_key_string = $this->get_key_list();
        $c_member_list = $this->db_get_c_member_list($start_id,$end_id);
        $member_csv_data = $this->create_csv_data($member_key_string,$c_member_list);

        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=member.csv");
        echo $member_csv_data;
        exit;
    }

    /**
     * メンバーリスト取得
     * バグのため修正。。。KT
     */
    function db_get_c_member_list($start_id,$end_id)
    {
        $params=array();
        $sql = 'SELECT c_member_id FROM ' . MYNETS_PREFIX_NAME . 'c_member ';
        $sql .= ' WHERE 1 ' ;
        if($start_id!=""){
            $sql .= ' AND c_member_id >= ? ';
            $params[] = $start_id;
        }
        if($end_id!=""){
            $sql .= ' AND c_member_id <= ? ';
            $params[] = $end_id;
        }
        $sql .= ' ORDER BY c_member_id' ;
        $ids = db_get_col($sql,$params);

        $c_member_list = array();
        foreach ($ids as $id) {
            $tmp_c_member = array();
            $_tmp_c_member = db_common_c_member4c_member_id($id, false, false, 'private');

            $tmp_c_member['c_member_id'] = $_tmp_c_member['c_member_id'];
            $tmp_c_member['nickname'] = $_tmp_c_member['nickname'];
            $tmp_c_member['access_date'] = $_tmp_c_member['access_date'];
            $tmp_c_member['r_date'] = $_tmp_c_member['r_date'];
            $tmp_c_member['c_member_id_invite'] = $_tmp_c_member['c_member_id_invite'];
            $tmp_c_member['image_filename_1'] = $_tmp_c_member['image_filename_1'];
            $tmp_c_member['image_filename_2'] = $_tmp_c_member['image_filename_2'];
            $tmp_c_member['image_filename_3'] = $_tmp_c_member['image_filename_3'];
            $tmp_c_member['birth_year'] = $_tmp_c_member['birth_year'];
            $tmp_c_member['birth_month'] = $_tmp_c_member['birth_month'];
            $tmp_c_member['birth_day'] = $_tmp_c_member['birth_day'];

            $tmp_profile_list = db_common_c_member_profile_list4c_member_id($id, 'private');
            $c_profile_list = db_common_c_profile_list4null();
            foreach($c_profile_list as $key=>$tmp_profile ){
                if (is_array($tmp_profile_list[$tmp_profile['name']]['value'])){
                    foreach ($tmp_profile_list[$tmp_profile['name']]['value'] as $itm){
                        $tmp_c_member[$tmp_profile['name']] .= $itm . " ";
                    }
                } else {
                    $tmp_c_member[$tmp_profile['name']] = $tmp_profile_list[$tmp_profile['name']]['value'];
                }
            }
            $tmp_secure = db_common_c_member_secure4c_member_id($id);
            $tmp_c_member['pc_address'] = $tmp_secure['pc_address'];
            $tmp_c_member['ktai_address'] = $tmp_secure['ktai_address'];
            $tmp_c_member['regist_address'] = $tmp_secure['regist_address'];

            $c_member_list[]=$tmp_c_member;
        }

        return $c_member_list;
    }

    function get_key_list(){
        $c_profile_list = db_common_c_profile_list4null();

        $ley_list[]="メンバーID";
        $ley_list[]="ニックネーム";
        $ley_list[]="最終ログイン";
        $ley_list[]="登録日";
        $ley_list[]="招待者ID";
        $ley_list[]="画像1";
        $ley_list[]="画像2";
        $ley_list[]="画像3";
        $ley_list[]="誕生年";
        $ley_list[]="誕生月";
        $ley_list[]="誕生日";
        foreach($c_profile_list as $profile){
            $ley_list[]= $profile['caption'];
        }
        $ley_list[]="PCアドレス";
        $ley_list[]="携帯アドレス";
        $ley_list[]="登録時アドレス";

        return $ley_list;
    }

    function create_csv_data($key_string,$value_list){
        $csv = "";
        foreach($key_string as $each_key){
            if($csv != "")$csv .= ",";
            $csv .= '"'.mb_convert_encoding($each_key ,"SJIS", "auto").'"';
        }
        $csv .= "\n";

        foreach($value_list as $key => $value){
            $temp = "";
            foreach($value as $key2 => $value2){
                $value2 = mb_convert_encoding($value2 ,"SJIS", "auto");
                if ($value2 != null) $value2 = str_replace('"', '""', $value2);//クォート
                if ($value2 != null) $value2 = str_replace("\r","",$value2);//改行コードを変換
                $temp .= "\"".$value2."\",";
            }
            $csv .= $temp."\n";
        }
        return $csv;
    }
}

?>

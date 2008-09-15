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

class admin_do_csv_delete_member extends OpenPNE_Action
{
    function execute($requests)
    {
        $start_id = $requests['start_id'];
        $end_id = $requests['end_id'];

        $member_key_string = $this->get_key_list();
        $c_delete_member_list = $this->db_get_c_member_list();
        $member_csv_data = $this->create_csv_data($member_key_string,$c_delete_member_list);

        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=delete_member.csv");
        echo $member_csv_data;
        exit;
    }

    /**
     * メンバーリスト取得
     * バグのため修正。KT
     */
    function db_get_c_member_list()
    {
        $params=array();
        $sql = 'SELECT * FROM ' . MYNETS_PREFIX_NAME . 'c_delete_member_data ';
        $sql .= ' ORDER BY delete_datetime' ;
        $c_delete_member_list = db_get_all($sql);
        
        return $c_delete_member_list;
    }

    function get_key_list(){
        $ley_list[]="退会ID";
        $ley_list[]="メンバーID";
        $ley_list[]="ニックネーム";
        $ley_list[]="PCアドレス";
        $ley_list[]="携帯アドレス";
        $ley_list[]="登録時アドレス";
        $ley_list[]="簡単ログインID";
        $ley_list[]="IPアドレス";
        $ley_list[]="ユーザーエージェント";
        $ley_list[]="退会時コメント";
        $ley_list[]="退会フラグ";
        $ley_list[]="登録日時";
        $ley_list[]="退会日時";
        $ley_list[]="紹介者ID";

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

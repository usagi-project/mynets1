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

class pc_page_h_inquiry_add_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        //変数の受け取り
        $data_id = $requests['data_id'];
        $data_flag = $requests['data_flag'];
        $target_c_member_id = $requests['target_c_member_id'];
        $category_flag = $requests['category_flag'];
        $body = $requests['body'];

        //内容が未入力の場合はエラーで戻す
        if (is_null($body) || $body === '') {
            $p = array(
                'target_c_member_id' => $target_c_member_id,
                'data_id' => $data_id,
                'data_flag' => $data_flag,
                'category_flag' => $category_flag,
                'msg' => "本文を入力してください。"
            );
            openpne_redirect("pc","page_h_inquiry",$p);
        }
        //相手のID（でーた保存では使わない）
        
        if ($target_c_member_id !== 0) {        //相手がいる場合は取得
            $target_c_member = db_common_c_member4c_member_id($target_c_member_id);
        }
        //自分の情報を取得
        $c_member = db_common_c_member4c_member_id($u);

        switch ($data_flag) {
            case "2":
                $data_flag_name = "メッセージ";
                break;
            case "0":
                $data_flag_name = "問い合わせ";
                break;
            case "1":
                $data_flag_name = "日記";
                break;
            case "3":
                $data_flag_name = "トピック";
                break;
        }
        $this->set("data_flag_name",$data_flag_name);

        switch ($category_flag) {
            case "2":
                $category_flag_name = "通報";
                break;
            case "1":
                $category_flag_name = "問い合わせ";
                break;
        }
        
        $this->set("category_flag_name",$category_flag_name);
        $this->set("data_id",$data_id);
        $this->set("data_flag",$data_flag);
        $this->set("target_c_member",$target_c_member);
        $this->set("category_flag",$category_flag);
        $this->set('inc_navi', fetch_inc_navi('h'));
        $this->set("body",$body);
        return 'success';
    }
}

?>

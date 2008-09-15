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
 * @author     Kunitsuji UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.1.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/06/19] Ver1.1.0Nighty package
 * ======================================================================== 
 */


class ktai_page_h_admin_delete_user extends OpenPNE_Action
{
    function execute($requests)
    {
        $login_msg = "";
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];
        //携帯用管理画面ユーザーチェック
        if (checkAuthMobileAdmin($u)) {
            $login_msg = "退会会員のデータ";
            $this->set('login_msg',$login_msg);
        }
        //年月日を取得フェーズ１ではリクエストには入らないが、今後日付指定を実施
        $year = $requests['year'] ? $requests['year'] : date('Y');
        $month = $requests['month'] ? $requests['month'] : date('n');
        $day = $requests['day'] ? $requests['day'] : date('j');
        
        //退会者数の累計をチェック
        $total_user = getMobileAdminDeleteData();
        $this->set("total_user",$total_user);
        //退会者数の本日分を表示
        $date1 = mktime(0, 0, 0, $month, $day, $year);
        $date1 = date("Y-m-d", $date1);
        $today_user = getMobileAdminDeleteData(" where delete_datetime >= '".$date1."'");
        $this->set("today_user",$today_user);
        //退会者数昨日分を表示
        $date1 = mktime(0, 0, 0, $month, $day, $year);
        $date2 = mktime(0, 0, 0, $month, $day-1, $year);
        $date1 = date("Y-m-d", $date1);
        $date2 = date("Y-m-d", $date2);
        $yesterday_user = getMobileAdminDeleteData(" where delete_datetime < '".$date1."' and delete_datetime >='".$date2."'");
        $this->set("yesterday_user",$yesterday_user);
        //退会者数今月累計
        $date1 = mktime(0, 0, 0, $month, 1, $year);
        $date2 = mktime(0, 0, 0, $month+1, 1, $year);
        $date1 = date("Y-m-d", $date1);
        $date2 = date("Y-m-d", $date2);
        $tomonth_user = getMobileAdminDeleteData(" where delete_datetime >= '".$date1."' and delete_datetime < '".$date2."'");
        $this->set("tomonth_user",$tomonth_user);
        //退会者数先月分
        $date1 = mktime(0, 0, 0, $month, 1, $year);
        $date2 = mktime(0, 0, 0, $month-1, 1, $year);
        $date1 = date("Y-m-d", $date1);
        $date2 = date("Y-m-d", $date2);
        $premonth_user = getMobileAdminDeleteData(" where delete_datetime < '".$date1."' and delete_datetime >= '".$date2."'");
        $this->set("premonth_user",$premonth_user);
        //あとは、フェーズ２で期間指定を組み入れる
        
        return 'success';
    }
}

?>

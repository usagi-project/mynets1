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


class ktai_page_h_admin_access_count extends OpenPNE_Action
{
    function execute($requests)
    {
        $login_msg = "";
        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];
        //携帯用管理画面ユーザーチェック
        if (checkAuthMobileAdmin($u)) {
            $login_msg = "サイト訪問データ";
            $this->set('login_msg',$login_msg);
        }
        //年月日を取得フェーズ１ではリクエストには入らないが、今後日付指定を実施
        $year = $requests['year'] ? $requests['year'] : date('Y');
        $month = $requests['month'] ? $requests['month'] : date('n');
        $day = $requests['day'] ? $requests['day'] : date('j');
        
        //投稿数の累計をチェック
        $total_access = getMobileAdminAccessData(" where ktai_flag = 0");
        $this->set("total_access",$total_access);
        //本日分を表示
        $date1 = mktime(0, 0, 0, $month, $day, $year);
        $date2 = mktime(0, 0, 0, $month, $day-1, $year);
        $date1 = date("Y-m-d", $date1);
        $date2 = date("Y-m-d", $date2);
        $today_access = getMobileAdminAccessData(" where r_datetime >= '".$date1."' and ktai_flag = 0");
        $this->set("today_access",$today_access);
        //昨日分を表示
        $date1 = mktime(0, 0, 0, $month, $day, $year);
        $date2 = mktime(0, 0, 0, $month, $day-1, $year);
        $date1 = date("Y-m-d", $date1);
        $date2 = date("Y-m-d", $date2);
        $yesterday_access = getMobileAdminAccessData(" where r_datetime < '".$date1."' and r_datetime >='".$date2."' and ktai_flag = 0");
        $this->set("yesterday_access",$yesterday_access);
        //今月累計
        $date1 = mktime(0, 0, 0, $month, 1, $year);
        $date2 = mktime(0, 0, 0, $month+1, 1, $year);
        $date1 = date("Y-m-d", $date1);
        $date2 = date("Y-m-d", $date2);
        $tomonth_access = getMobileAdminAccessData(" where r_datetime >= '".$date1."' and r_datetime < '".$date2."' and ktai_flag = 0");
        $this->set("tomonth_access",$tomonth_access);
        //先月分
        $date1 = mktime(0, 0, 0, $month, 1, $year);
        $date2 = mktime(0, 0, 0, $month-1, 1, $year);
        $date1 = date("Y-m-d", $date1);
        $date2 = date("Y-m-d", $date2);
        $premonth_access = getMobileAdminAccessData(" where r_datetime < '".$date1."' and r_datetime >= '".$date2."' and ktai_flag = 0");
        $this->set("premonth_access",$premonth_access);

        //ここからコメントをチェック
        //投稿数の累計をチェック
        $total_access_mb = getMobileAdminAccessData(" where ktai_flag = 1");
        $this->set("total_access_mb",$total_access_mb);
        //本日分を表示
        $date1 = mktime(0, 0, 0, $month, $day, $year);
        $date1 = date("Y-m-d", $date1);
        $today_access_mb = getMobileAdminAccessData(" where r_datetime >= '".$date1."' and where ktai_flag = 1");
        $this->set("today_access_mb",$today_access_mb);
        
        //昨日分を表示
        $date1 = mktime(0, 0, 0, $month, $day, $year);
        $date2 = mktime(0, 0, 0, $month, $day-1, $year);
        $date1 = date("Y-m-d", $date1);
        $date2 = date("Y-m-d", $date2);
        $yesterday_access_mb = getMobileAdminAccessData(" where r_datetime < '".$date1."' and r_datetime >='".$date2."' and where ktai_flag = 1");
        $this->set("yesterday_access_mb",$yesterday_access_mb);
        //今月累計
        $date1 = mktime(0, 0, 0, $month, 1, $year);
        $date2 = mktime(0, 0, 0, $month+1, 1, $year);
        $date1 = date("Y-m-d", $date1);
        $date2 = date("Y-m-d", $date2);
        $tomonth_access_mb = getMobileAdminAccessData(" where r_datetime >= '".$date1."' and r_datetime < '".$date2."' and where ktai_flag = 1");
        $this->set("tomonth_access_mb",$tomonth_access_mb);
        //先月分
        $date1 = mktime(0, 0, 0, $month, 1, $year);
        $date2 = mktime(0, 0, 0, $month-1, 1, $year);
        $date1 = date("Y-m-d", $date1);
        $date2 = date("Y-m-d", $date2);
        $premonth_access_mb = getMobileAdminAccessData(" where r_datetime < '".$date1."' and r_datetime >= '".$date2."' and where ktai_flag = 1");
        $this->set("premonth_access_mb",$premonth_access_mb);
        //あとは、フェーズ２で期間指定を組み入れる
        
        return 'success';
    }
}

?>

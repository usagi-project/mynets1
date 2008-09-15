<?php
/**
 * @copyright 2005-2006 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 *
 * @copyright 2007 Kei Kubo
 */


class diary_page_sitemap extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function handleError()
    {
        openpne_redirect('diary', 'page_home');
    }

    function execute($requests)
    {

        $date_list = p_public_diary_list_date_list4c_member_id();
        foreach ($date_list as $key => $value){
            //日記のカレンダー
            $date_list[$key]['calendar'] = db_common_public_diary_monthly_calendar($value['year'], $value['month']);
        }
        $this->set('date_list', $date_list);

        $c_member_list = db_public_diary_get_c_member_id4sitemap();

        foreach ($c_member_list as $key => $value){
            $c_member_list[$key]['date_list'] = p_public_diary_list_date_list4c_member_id($value['c_member_id']);
            foreach ($c_member_list[$key]['date_list'] as $item => $date){
                //日記のカレンダー
                $c_member_list[$key]['date_list'][$item]['calendar'] = db_common_public_diary_monthly_calendar($date['year'], $date['month'], $value['c_member_id']);
            }
        }
        $this->set('c_member_list', $c_member_list);
        //最新日記

        $c_diary_list = db_public_diary_get_c_diary_id4sitemap();
        $this->set('c_diary_list', $c_diary_list);

        return 'success';
    }

}

?>

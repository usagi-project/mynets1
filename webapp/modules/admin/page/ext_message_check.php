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
 * @chengelog  [2007/05/29] Ver1.1.0Nighty package
 * ======================================================================== 
 */


// c_ashiato,c_access_log table cleanup

class admin_page_ext_message_check extends OpenPNE_Action
{
    function getTitle()
    {
        return "メッセージの閲覧";
    }

    function execute($requests)
    {
        $v = array();
        $pager = array();
        $sort_no = $requests['sort_no'];
        $page = $requests['page'];
        $page_size = $requests['page_size'];
        $keyword = $requests['keyword'];
        //一覧表示をカットする場合は
        //IF文のコメントをはずしてスペースの場合は出力しないようにする
        //if ($keyword !== "") {
            $message_list = getMessageDataListAdmin($keyword, $page, $page_size, $pager);
        //}
        
        $v['SNS_NAME'] = SNS_NAME;
        $v['OPENPNE_VERSION'] = OPENPNE_VERSION;
        $v['pager'] = $pager;
        $this->set("keyword",urlencode($keyword));
        $this->set("message_list",$message_list);
        
        $this->set($v);
        return 'success';
    }
}

?>

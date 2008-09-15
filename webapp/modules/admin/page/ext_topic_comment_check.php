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

class admin_page_ext_topic_comment_check extends OpenPNE_Action
{
    function getTitle()
    {
        return "トピックコメントの閲覧";
    }

    function execute($requests)
    {
        $v = array();
        $pager = array();
        $sort_no = $requests['sort_no'];
        $page = $requests['page'];
        $page_size = $requests['page_size'];
        $keyword = $requests['keyword'];
        $topic_comment_data = getTopicCommentDataListAdmin($keyword, $sort_no, $page, $page_size, $pager);
        

        $v = array();
        $v['SNS_NAME'] = SNS_NAME;
        $v['OPENPNE_VERSION'] = OPENPNE_VERSION;
        $this->set("topic_comment_list",$topic_comment_data);
        $v['pager'] = $pager;
        $this->set($v);
        return 'success';
    }
}

?>

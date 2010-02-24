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
 * @author     UsagiProject <info@usagi-project.org>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi-project.org/member.html>
 * @version    MyNETS,v 1.1.0
 * @since      File available since Release 1.1.0 Nighty
 * @chengelog  [2007/05/29] Ver1.1.0Nighty package
 * ======================================================================== 
 */

class admin_page_view_topic_comment_data extends OpenPNE_Action
{
    function execute($requests)
    {
        //トピックID
        $target_c_commu_topic_comment_id = $requests['target_c_commu_topic_comment_id'];
        $topic_comment_data = getTopicCommentDataAdmin($target_c_commu_topic_comment_id);
        $v = array();
        $v['SNS_NAME'] = SNS_NAME;
        $v['OPENPNE_VERSION'] = OPENPNE_VERSION;
        
        //作成されたトピックを集計
        $this->set($v);
        $this->set("topic_comment_data",$topic_comment_data);
        
        return 'success';
    }
}

?>

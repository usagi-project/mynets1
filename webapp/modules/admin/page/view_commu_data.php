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


// c_ashiato,c_access_log table cleanup

class admin_page_view_commu_data extends OpenPNE_Action
{
    function execute($requests)
    {
        //トピックID
        $target_c_commu_id = $requests['target_c_commu_id'];
        $commu_data = getCommuDataAdmin($target_c_commu_id);
        $v = array();
        $v['SNS_NAME'] = SNS_NAME;
        $v['OPENPNE_VERSION'] = OPENPNE_VERSION;
        //作成されたトピックを集計
        $this->set($v);
        $this->set("commu_data",$commu_data);
        return 'success';
    }
}

?>

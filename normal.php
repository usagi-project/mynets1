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
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ======================================================================== 
 */

/*
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 */
// Left for compatibility

require_once './config.inc.php';
require_once OPENPNE_WEBAPP_DIR . '/init.inc';

$q = $_GET;

$changed_page = array(
    'login_do_login'=>'login',
);
if (!empty($q['p'])) {
    if (array_key_exists($q['p'], $changed_page)) {
        $q['p'] = $changed_page[$q['p']];
    }
    $action = 'page_o_' . $q['p'];
    unset($q['p']);
}
unset($q['m']);

$_REQUEST['url'] = openpne_gen_url('pc', $action, $q);
openpne_forward('pc', 'page', 'o_url_changed');

?>

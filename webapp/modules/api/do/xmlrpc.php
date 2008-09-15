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

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

require_once 'XML/RPC/Server.php';
require_once OPENPNE_WEBAPP_DIR . '/modules/api/lib/xmlrpc.php';

class api_do_xmlrpc extends OpenPNE_Action
{
    function execute($requests)
    {
        $dispMap = $this->getDispMap();
        $server = new XML_RPC_Server($dispMap, 1, OPENPNE_DEBUGGING);
        exit;
    }

    function getDispMap()
    {
        $dispMap = array();
        $dir = OPENPNE_WEBAPP_DIR . '/modules/api/lib/xmlrpc';
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if (substr($file, -4, 4) != '.php') continue;
                    include_once realpath("$dir/$file");
                    $name = substr($file, 0, -4);
                    $dispMap[$name] = array('function' => 'xmlrpc_' . $name);
                }
                closedir($dh);
            }
        }
        return $dispMap;
    }
}

?>

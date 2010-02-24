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

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

function smarty_function_t_url($params, &$smarty)
{
    $urlencode = false;
    if (isset($params['_urlencode'])) {
        $urlencode = (bool)$params['_urlencode'];
        unset($params['_urlencode']);
    }

    $absolute = false;
    if (isset($params['_absolute'])) {
        $absolute = (bool)$params['_absolute'];
        unset($params['_absolute']);
    }

    $html = true;
    if (isset($params['_html'])) {
        $html = (bool)$params['_html'];
        unset($params['_html']);
    }

    $module = $params['m'];
    $action = $params['a'];

    $url = openpne_gen_url($module, $action, $params, $absolute);
    if ($html) {
        $url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
    }

    if ($urlencode) {
        $url = urlencode($url);
    }

    return $url;
}

?>

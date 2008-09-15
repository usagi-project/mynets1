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

function smarty_function_t_form($params, &$smarty)
{
    $method = 'post';
    if (isset($params['_method'])) {
        if ($params['_method'] == 'get') {
            $method = 'get';
        }
        unset($params['_method']);
    }

    $enctype = '';
    if (isset($params['_enctype'])) {
        if ($params['_enctype'] == 'file' || $params['_enctype'] == 'multipart') {
            $enctype = 'multipart/form-data';
            $params['MAX_FILE_SIZE'] = IMAGE_MAX_FILESIZE * 1024;
        }
        unset($params['_enctype']);
    }

    //FORMÇÃNameÉpÉâÉÅÅ[É^èàóùÇÃí«â¡
    $formname = '';
    if (isset($params['_name'])) {
        $formname = $params['_name'];
        unset($params['_name']);
    }

    $attr = '';
    if (isset($params['_attr'])) {
        $attr = $params['_attr'];
        unset($params['_attr']);
    }

    $form_action = openpne_gen_url_head($params['m'], $params['a'], false);
    if (need_ssl_param($params['m'], $params['a'])) {
        $params['ssl_param'] = 1;
    }

    $html = sprintf('<form action="%s" method="%s"', $form_action, $method);
    if ($enctype) {
        $html .= sprintf(' enctype="%s"', $enctype);
    }
    if ($formname) {
        $html .= sprintf(' name="%s"', $formname);
    }
    if ($attr) {
        $html .= sprintf(' %s', $attr);
    }
    $html .= '>';
    foreach ($params as $key => $value) {
        $html .= "\n";
        $html .= sprintf('<input type="hidden" name="%s" value="%s">',
                         htmlspecialchars($key, ENT_QUOTES, 'UTF-8'),
                         htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
    }
    return $html;
}

?>

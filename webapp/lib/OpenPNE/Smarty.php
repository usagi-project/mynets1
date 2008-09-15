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

require_once 'Smarty/Smarty.class.php';

class OpenPNE_Smarty extends Smarty
{
    var $templates_dir;
    var $output_charset;

    function OpenPNE_Smarty($configs=array())
    {
        $this->Smarty();

        // 設定値をセット
        foreach ($configs as $key => $value) {
            if (isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }

    // extディレクトリ対応 SMARTY->display() ラッパー
    function ext_display($resource_name, $cache_id = null, $compile_id = null)
    {
        // とりあえず携帯用にSJISのみ対応
        if ($this->output_charset == 'SJIS') {
            $this->register_outputfilter('smarty_outputfilter_convert_utf82sjis');
            $this->register_outputfilter('smarty_outputfilter_unescape_emoji');
            $this->register_outputfilter('smarty_outputfilter_unescape_emoji_entity');
            $this->register_outputfilter('smarty_outputfilter_unescape_softbank_emoji');
        }
        $this->sendContentType();
        $this->ext_fetch($resource_name, $cache_id, $compile_id, true);
    }

    function ext_fetch($resource_name, $cache_id = null, $compile_id = null, $display = false)
    {
        if ($this->templates_dir) {
            $place = '';
            $template = $this->templates_dir . '/' . $resource_name;

            if (!$tpl = $this->ext_search($template, $place)) {
                return false;
            }
            $tpl = 'file:' . $tpl;
            $cache_id = $compile_id = $place . '_' . str_replace('/', '_', $this->templates_dir);
        } else {
            $tpl = $resource_name;
        }

        return $this->fetch($tpl, $cache_id, $compile_id, $display);
    }

    function ext_search($path, &$place)
    {
        $dft = OPENPNE_MODULES_DIR . '/' . $path;
        $ext = OPENPNE_MODULES_EXT_DIR . '/' . $path;

        if (USE_EXT_DIR && is_readable($ext)) {
            $place = 'ext';
            return $ext;
        } elseif (is_readable($dft)) {
            $place = 'dft';
            return $dft;
        }

        return false;
    }

    function setOutputCharset($charset)
    {
        $this->output_charset = $charset;
    }

    function sendContentType()
    {
        if ($this->output_charset == 'SJIS') {
            header('Content-Type: text/html; charset=Shift_JIS');
        } else {
            header('Content-Type: text/html; charset=UTF-8');
        }
    }
}

function smarty_outputfilter_convert_utf82sjis($tpl_output, &$smarty)
{
    return mb_convert_encoding($tpl_output, 'SJIS-win', 'UTF-8');
}

function smarty_outputfilter_unescape_emoji($tpl_output, &$smarty)
{
    return emoji_unescape($tpl_output, true);
}

function smarty_outputfilter_unescape_emoji_entity($tpl_output, &$smarty)
{
    return emoji_entity_unescape($tpl_output, false);
}
function smarty_outputfilter_unescape_softbank_emoji($tpl_output, &$smarty)
{
    return emoji_unescape_softbank($tpl_output);
}
?>

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 *
 * @category
 * @package    Session Class
 * @author     KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @copyright  Copyright (c) 2008 KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @copyright  Copyright (c) 2006-2008 Usagi Project (URL:http://usagi-project.org)
 * @license    New BSD License
 */

class MY_Config extends CI_Config {

    var $is_ssl = null;

    /**
     * Constructor
     *
     */
    function MY_Config()
    {
        parent::CI_Config();
        //2008-04-21 KUNIHARU Tsujioka
        $this->_is_ssl();
    }

    // --------------------------------------------------------------------

    /**
     * Site URL
     *
     * @access  public
     * @param   string  the URI string
     * @param   bool SSL true/false 2008-04-21 KUNIHARU Tsujioka updated
     * @return  string
     */
    function site_url($uri = '', $ssl = FALSE)
    {
        if (is_array($uri))
        {
            $uri = implode('/', $uri);
        }

        if ($uri == '')
        {
            if ($ssl)
            {
                return $this->slash_item('base_url_ssl').$this->item('index_page');
            }
            else
            {
                return $this->slash_item('base_url').$this->item('index_page');
            }
        }
        else
        {
            $suffix = ($this->item('url_suffix') == FALSE) ? '' : $this->item('url_suffix');
            if ($ssl)
            {
                return $this->slash_item('base_url_ssl').$this->slash_item('index_page').preg_replace("|^/*(.+?)/*$|", "\\1", $uri).$suffix;
            }
            else
            {
                return $this->slash_item('base_url').$this->slash_item('index_page').preg_replace("|^/*(.+?)/*$|", "\\1", $uri).$suffix;
            }
        }
    }

    //2008-04-21 KUNIHARU Tsujioka update
    /**
     * 現在の通信がSSLかどうかを判定する
     * @access plivate
     *
     * @return bool
     *
     */
    function _is_ssl()
    {
        static $is_ssl;
        if (!isset($is_ssl)) {
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
                $is_ssl = true;
            } else {
                $is_ssl = false;
            }
        }
        $this->is_ssl = $is_ssl;
    }

    function is_ssl()
    {
        return $this->is_ssl;
    }

}
?>
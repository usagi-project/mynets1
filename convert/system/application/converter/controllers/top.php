<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 *
 * @category
 * @package    convert top controller
 * @author     KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @copyright  Copyright (c) 2008 KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @copyright  Copyright (c) 2006-2008 Usagi Project (URL:http://usagi.mynets.jp)
 * @license    New BSD License
 */


class top extends Controller
{
    function top()
    {
        parent::Controller();
    }
    function index()
    {
        $this->load->helper('form');
        //MyNETSのconfig.phpを読み込んでDB情報を取得する
        $error_msg = "";
        if (! isset($GLOBALS['_OPENPNE_DSN_LIST']['main']['dsn']))
        {
            //読み込みエラー。つまりコンバートできない
            $error_msg = "config.phpが読み込めません。";
            $vData = array(
                'error_msg' => $error_msg,
                'header'    => 'header/header.html',
                'footer'    => 'header/footer.html',
            );
        }
        else
        {
            $this->load->library('session');
            $this->session->start();

            $dbconf = $GLOBALS['_OPENPNE_DSN_LIST']['main']['dsn'];
            $username = $dbconf['username'];
            $password = $dbconf['password'];
            $dbname   = $dbconf['database'];
            $hostname = $dbconf['hostspec'];
            $dbprefix = MYNETS_PREFIX_NAME;
            $this->session->set('username', $username);
            $this->session->set('password', $password);
            $this->session->set('dbname', $dbname);
            $this->session->set('hostname', $hostname);
            $this->session->set('dbprefix', $dbprefix);
            $vData = array(
                'username'  => $username,
                'password'  => $password,
                'dbname'    => $dbname,
                'hostname'  => $hostname,
                'dbprefix'  => $dbprefix,
                'header'    => 'header/header.html',
                'footer'    => 'header/footer.html',
                'error_msg' => $error_msg,
            );
        }

        $this->load->view('top.html', $vData);
    }

}
?>

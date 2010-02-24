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

// PEAR::Auth
require_once 'Auth.php';


class OpenPNE_Auth
{
    /**
     * @var Auth
     */
    var $auth;

    var $storage;
    var $options;
    var $expire = 0;
    var $idle   = 0;
    var $uid;
    var $sess_id;
    var $cookie_path;

    function OpenPNE_Auth($storageDriver = 'DB', $options = '')
    {
        ini_set('session.use_cookies', 0);
        if (!empty($_COOKIE[session_name()])) {
            $this->sess_id = $_COOKIE[session_name()];
            session_id($this->sess_id);
        }
        $this->storage = $storageDriver;
        $this->options = $options;
        $this->set_cookie_params();
    }

    function set_cookie_params()
    {
        $url = parse_url(OPENPNE_URL);
        if (substr($url['path'], -1) != '/') {
            $url['path'] .= '/';
        }
        $this->cookie_path = $url['path'];
    }

    function &factory($login = false)
    {
        if ($login) {
            $auth = new Auth($this->storage, $this->options, '', false);
            $auth->setAllowLogin(true);
        } else {
            $auth = new Auth('null');
            $auth->setAllowLogin(false);
        }
        $auth->setExpire($this->expire);
        $auth->setIdle($this->idle);
        return $auth;
    }

    function login($is_save_cookie = false, $is_encrypt_username = false)
    {
        $this->auth =& $this->factory(true);
        if ($is_encrypt_username) {
            $this->auth->post[$this->auth->_postUsername] =
                t_encrypt($this->auth->post[$this->auth->_postUsername]);
        }

        $this->auth->start();
        if ($this->auth->getAuth()) {
            if (OPENPNE_SESSION_CHECK_URL) {
                $this->auth->setAuthData('OPENPNE_URL', OPENPNE_URL);
            }

            $this->sess_id = session_id();
            if ($is_save_cookie) {
                $expire = time() + 2592000; // 30 days
            } else {
                $expire = 0;
            }
            //PHP5.2対応 cookie_httponly option
            $version = '5.2.0';
            if (version_compare(PHP_VERSION, $version) < 0)
            {
                setcookie(session_name(), session_id(), $expire, $this->cookie_path);
            }
            else
            {
                setcookie(
                    session_name(),
                    session_id(),
                    $expire,
                    $this->cookie_path,
                    ini_get('session.cookie_domain'),
                    ini_get('session.cookie_secure'),
                    ini_get('session.cookie_httponly')
                    );
            }
            return true;
        } else {
            return false;
        }
    }

    function auth()
    {
        if (!$this->sess_id) {
            return false;
        }
        $this->auth =& $this->factory();
        return $this->checkAuth();
    }

    function logout()
    {
        if (!$this->auth) {
            if (!$this->sess_id) {
                return true;
            }
            $this->auth =& $this->factory();
        }

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, $this->cookie_path);
        }
        $_SESSION = array();
        session_destroy();
        unset($this->auth);

        $this->set_session_save_handler();
    }

    function setExpire($expiretime)
    {
        $this->expire = $expiretime;
    }

    function setIdle($idletime)
    {
        $this->idle = $idletime;
    }

    function uid($uid = '')
    {
        if ($uid) {
            $this->uid = $uid;
        }
        return $this->uid;
    }

    function getUsername()
    {
        return $this->auth->getUsername();
    }

    /**
     * static set_session_save_handler()
     */
    function set_session_save_handler()
    {
        if (SESSION_SAVE_DB) {
            static $dbsess;
            if (is_null($dbsess)) {
                include_once 'OpenPNE/DBSession.php';
                $dbsess = new OpenPNE_DBSession(db_get_dsn('session'));
            }
            session_set_save_handler(array(&$dbsess, 'open'),
                                     array(&$dbsess, 'close'),
                                     array(&$dbsess, 'read'),
                                     array(&$dbsess, 'write'),
                                     array(&$dbsess, 'destroy'),
                                     array(&$dbsess, 'gc'));
        }
    }

    function checkAuth()
    {
        if ($this->auth->checkAuth()) {
            if (OPENPNE_SESSION_CHECK_URL) {
                $openpne_url = $this->auth->getAuthData('OPENPNE_URL');
                if ($openpne_url == OPENPNE_URL) {
                    return true;
                }
            } else {
                return true;
            }
        }
        return false;
    }
}

?>

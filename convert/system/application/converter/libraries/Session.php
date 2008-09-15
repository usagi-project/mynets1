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
 * @copyright  Copyright (c) 2006-2008 Usagi Project (URL:http://usagi.mynets.jp)
 * @license    New BSD License
 */

class Session {

    // the ONE TIME TOKEN NAME
    var $_Token = 'OneTimeToken';

    // constructor
    function Session()
    {
    }

    /**
     * 値を返却
     *
     * @param   string  key名
     * @param   string  namespace default='default'
     * @return  string  値
     * @access  public
     */
    function get($key = null, $namespace = 'default')
    {
        if(isset($key))
        {
            return isset($_SESSION[$namespace][$key]) ? $_SESSION[$namespace][$key] : null;
        }
        else
        {
            return isset($_SESSION[$namespace]) ? $_SESSION[$namespace] : null;
        }
    }

    /**
     * 値をセット
     *
     * @param   string  key名
     * @param   string  値
     * @param   string  namespace default='default'
     * @access  public
     */
    function set($key, $value, $namespace = 'default')
    {
        if (!$key)
        {
            $_SESSION[$namespace] = $value;
        }
        else
        {
            $_SESSION[$namespace][$key] = $value;
        }
    }

    /**
     * Keyの値を削除する
     * パラメータを渡さない場合は、現在のセッション情報をすべてクリアする
     *
     * @param   string  key名
     * @param   string  namespace default='default'
     * @access  public
     */
    function remove($key = null, $namespace = 'default')
    {
        if(isset($key) && ($key !== null))
        {
            unset($_SESSION[$namespace][$key]);
        }
        else
        {
            unset($_SESSION[$namespace]);
        }
    }

    /**
     * セッション開始
     *
     * @access  public
     */
    function start()
    {
        @session_start();
    }

    /**
     * セッション終了
     *
     * @access  public
     */
    function close()
    {
        $_SESSION = array();
        session_destroy();
    }

    /**
     * セッション名を返却
     *
     * @return  string  セッション名
     * @access  public
     */
    function getName()
    {
        return session_name();
    }

    /**
     * セッションIDをセット
     *
     * @param   string  セッションID
     * @access  public
     */
    function setID($id = '')
    {
        if ($id) {
            session_id($id);
        }
    }

    /**
     * セッションIDを返す
     *
     * @return  string  セッションID
     * @access  public
     */
    function getID()
    {
        return session_id();
    }

    /**
     * save_pathをセット
     *
     * @param   string  path
     * @access  public
     */
    function setPath($path)
    {
        if(isset($path) && ($path !== null))
        {
            session_save_path($path);
        }
        else
        {
            return;
        }
    }

    /**
     * use_cookies をセット
     *
     * @param   bool  use_cookies default true
     * @access  public
     */
    function setUseCookies($useCookies = TRUE)
    {
        if ($useCookies)
        {
            ini_set('session.use_cookies', 1);
        }
        else
        {
            ini_set('session.use_cookies', 0);
        }
    }

    /**
     * session.gc_maxlifetime をセット
     *
     * @param   int     maxlifetime default 432000(5days) 秒で指定
     * @access  public
     */
    function setSessionMaxLifetime($time = 432000)
    {
        ini_set('session.gc_maxlifetime', $time);
    }

    /**
     * ONE TIME Tokenの名前を返す
     *
     * @return  string  One Time Tokenの名前
     * @access  public
     */
    function getTokenName()
    {
        return $this->_Token;
    }

    /**
     * ONE TIME Tokenの名前を設定
     *
     * @param   string  One Time Tokenの名前
     * @access  public
     */
    function setTokenName($token)
    {
        $this->_Token = $token;
    }

    /**
     * ONE TIME Tokenの値を返却
     *
     * @return  string  One Time Tokenの値を返却
     * @access  public
     */
    function getToken()
    {
        return $this->get($this->getTokenName());
    }

    /**
     * ONE TIME Tokenの値を生成
     *
     * @access  public
     */
    function buildToken()
    {
        $this->set($this->getTokenName(), md5(uniqid(rand(),1)));
    }

    /**
     * ONE TIME Tokenの値を比較
     *
     * @param   string  One Time Tokenの値
     * @return  bool    TRUE or FALSE
     * @access  public
     */
    function checkToken($value)
    {
        if ($this->getToken() !== $value)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * ONE TIME Tokenの初期化
     *
     * @access  public
     */
    function initToken()
    {
        $this->remove($this->getTokenName());
    }

}
?>

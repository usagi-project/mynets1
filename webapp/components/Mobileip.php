<?php
/**
 * Code Igniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package    CodeIgniter
 * @author     Yoshiyuki Kadotani
 * @copyright  Copyright (c) 2009 Yoshiyuki Kadotani <kado@miscast.org>
 * @license    http://www.codeignitor.com/user_guide/license.html
 * @since      Version 1.0
 *
 */

/**
 * MyNETS用にコンバート(OpenPNE未検証)
 * @author kuniharu tsujioka
 *
 *
 *
 */

/**
 * IPアドレスが日本の携帯IPリストに一致するか検索する
 */
class Mobileip
{
    //private $CI;
    private $_cachedir;
    private $_carrier_url;
    private $_carrier_file;
    private $_carrier_name;
    private $_reload;

    private $_remote_ip;
    private $_remote_carrier = "other";
    private $_is_mobile      = FALSE;
    //UAチェックを追加
    private $_mobile_get_id;
    private $_yahoo_remote_pc_ip;
    function __construct()
    {

        //初期化
        //$this->CI =& get_instance();
        //$this->CI->load->helper('file');
        require_once OPENPNE_WEBAPP_DIR.'/components/mobileip/mobileip_config.php';

        require_once OPENPNE_WEBAPP_DIR.'/components/mobile_get_id.class.php';
        //$this->CI->load->config('mobileip_config');

        $this->_remote_ip = $_SERVER['REMOTE_ADDR'];

        $this->_mobile_get_id = new Usagi_Get_Mobile_Id();

        //Config値読み込み
        $this->_cachedir     = $config['mobileip_cache_dir'];
        $this->_carrier_url  = $config['mobileip_carrier_url'];
        $this->_reload       = $config['mobileip_reload_time'];
        $this->_carrier_name = $config['mobileip_carrier_name'];

        $this->_yahoo_remote_pc_ip = $config['yahoo_pc_remote_pc_ip'];
        //IPキャッシュ生成
        $this->_set_iplist();

        //IP判定
        $this->_judge_ip();

    }

    // public functions

    function is_mobile()
    {
        return $this->_is_mobile;
    }

    function get_remote_carrier()
    {
        return $this->_remote_carrier;
    }

    function set_remote_ip($ip)
    {
        $this->_remote_ip = $ip;
        $this->_judge_ip();
    }

    // local functions

    function _judge_ip()
    {
        if (is_array($this->_carrier_file))
        {
            foreach ($this->_carrier_file as $carrier => $file)
            {
                $fp = fopen($file, 'r');
                while ($line = fgets($fp, 1024))
                {
                    $carrier_ip = explode('/', $line);

                    $ipc = $this->_get_ip_bit($carrier_ip[0]);
                    $mask = $this->_get_mask_bit($carrier_ip[1]);
                    $ipr = $this->_get_ip_bit($this->_remote_ip);

                    if (($ipc & $mask) == ($ipr & $mask))
                    {
                        $this->_remote_carrier = $this->_carrier_name[$carrier];
                        if ($this->_match_mobile_ua())
                        {
                            $this->_is_mobile = TRUE;
                            return TRUE;
                        }
                        //キャリアとUAがマッチしない
                    }
                }

                fclose($fp);
            }
        }
        return FALSE;
    }

    function _set_iplist()
    {
        //IPキャッシュがあるか
        if (is_array($this->_carrier_url))
        {
            foreach ($this->_carrier_url as $carrier => $url)
            {
                $this->_carrier_file[$carrier] = $file =  $this->_cachedir .'ip_'. $carrier .'.txt';

                if (!file_exists($file) OR (filemtime($file) < time() - $this->_reload))
                {
                    //なければ作る
                    $iptext = $this->_get_iplist_from_url($url);
                    write_file($file, $iptext);
                }
            }
        }
    }

    function _get_iplist_from_url($_url)
    {
        $html = file_get_contents($_url);
        if (strpos($_url, 'au'))
        {
            $pattern = "/(\d{2,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}).+\n.+(\/\d{2})/";
            if (preg_match_all($pattern, $html, $matches))
            {
                $iptext = "";
                for ($i=0; $i<=count($matches[0])-1; $i++)
                {
                    $iptext .= $matches[1][$i] . $matches[2][$i] ."\n";
                }

                return $iptext;
            }
        }
        else
        {
            $pattern = "/\d{2,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\/\d{2}/";
            if (preg_match_all($pattern, $html, $matches))
            {
                $iptext = "";
                for ($i=0; $i<=count($matches[0])-1; $i++)
                {
                    //ソフトバンクのPCからのIP大域をカット
                    if (in_array($matches[0][$i], $this->_yahoo_remote_pc_ip) == FALSE)
                    {
                        $iptext .= $matches[0][$i] ."\n";
                    }
                }

                return $iptext;
            }
        }
    }

    function _get_mask_bit($_bit)
    {
        $mask = 0;
        for ($i=1; $i<=$_bit; $i++)
        {
            $mask++;
            $mask = $mask << 1;
        }

        $mask = $mask << 32-$_bit;

        return $mask;
    }

    function _get_ip_bit($ip)
    {
        $ips = explode('.', $ip);
        $ipb = ($ips[0] << 24) | ($ips[1] << 16) | ($ips[2] << 8) | ($ips[3]);

        return $ipb;
    }


    //mobileのUAとマッチするかどうか
    function _match_mobile_ua()
    {
        $ua_carrier = $this->_mobile_get_id->getCarrier();
        if ($this->_remote_carrier != $ua_carrier)
        {
            return FALSE;
        }
        return TRUE;
    }
}

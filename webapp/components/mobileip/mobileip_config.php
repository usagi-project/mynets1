<?php

// ------------------------------------------------------------------------
// mobile ip
// ------------------------------------------------------------------------

// cache directory
$config['mobileip_cache_dir'] = OPENPNE_VAR_DIR . '/mobile_ip/';

// carrier URL
$config['mobileip_carrier_url']['au'] = 'http://www.au.kddi.com/ezfactory/tec/spec/ezsava_ip.html';
$config['mobileip_carrier_url']['docomo'] = 'http://www.nttdocomo.co.jp/service/imode/make/content/ip/';
$config['mobileip_carrier_url']['softbank'] = 'http://creation.mb.softbank.jp/web/web_ip.html';
$config['mobileip_carrier_url']['willcom'] = 'http://www.willcom-inc.com/ja/service/contents_service/create/center_info/';
$config['mobileip_carrier_url']['em'] = 'http://developer.emnet.ne.jp/ipaddress.html';

// carrier name
$config['mobileip_carrier_name']['au'] = 'au';
$config['mobileip_carrier_name']['docomo'] = 'docomo';
$config['mobileip_carrier_name']['softbank'] = 'softbank';
$config['mobileip_carrier_name']['willcom'] = 'willcom';
$config['mobileip_carrier_name']['em'] = 'emobile';

// ip list reload time
$config['mobileip_reload_time'] = 60*60*24;

//yahooのPCからのIP帯域
$config['yahoo_pc_remote_pc_ip'] = array(
                                '123.108.237.224/27',
                                '202.253.96.0/28',
                                );
?>

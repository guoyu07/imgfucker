<?php
    /**
     * Author: WenJun
     * Date:   2013-01-10 下午9:09
     * Email:  wenjun1055@gmail.com
     *
     * File:   refer.class.php
     * 获取来访者来路、IP、还有浏览器类型
     */
    class Refer
    {
        /**
         * 构造函数
         */
        public function __construct() {}

        /**
         * @return null | string
         */
        public function getRefer()
        {
            if ($_SERVER['HTTP_REFERER']) {
                $refer = trim($_SERVER['HTTP_REFERER']);
                $refer = substr($refer, 7);
                return substr($refer, 0, strpos($refer, '/'));
            }
            return false;
        }

        /**
         * @return string
         */
//        public function getIp()
//        {
//            if (getenv("HTTP_CLIENT_IP")) {
//                $ip = getenv("HTTP_CLIENT_IP");
//            } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
//                $ip = getenv("HTTP_X_FORWARDED_FOR");
//            } elseif (getenv("REMOTE_ADDR")) {
//                $ip = getenv("REMOTE_ADDR");
//            } else {
//                $ip = '';
//            }
//            if ($ip) {
//                $ip = trim($ip);
//                $ip = substr($ip, 0, strpos($ip, ','));
//                $ip = ip2long($ip);
//            }
//            return $ip;
//        }

        public function getIp()
        {
            if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
                $ip = getenv('HTTP_CLIENT_IP');
            } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
                $ip = explode(',', getenv('HTTP_X_FORWARDED_FOR'));
                $ip = $ip[count($ip) - 1];
            } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
                $ip = getenv('REMOTE_ADDR');
            } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
                $ip = $_SERVER['REMOTE_ADDR'];
            } else {
                $ip = '';
            }
            if ($ip) {
                $ip = trim($ip);
                $ip = ip2long($ip);
            }
            return $ip;
        }



        public function getUserAgent()
        {
            return $_SERVER['HTTP_USER_AGENT'];
        }
    }

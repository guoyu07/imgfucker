<?php
    /**
     * Author: WenJun
     * Date:   2013-01-10 下午10:00
     * Email:  wenjun1055@gmail.com
     *
     * File:   moderator.class.php
     * 设置和获得版主IP
     */
    class Moderator
    {
        /**
         * @var DBResource
         */
        private $kvdb;

        /**
         * @var array
         */
        public $siteInfo = array();

        /**
         * @param Kvdb $kvdb
         */
        public function __construct(Kvdb $kvdb)
        {
            $this->kvdb = $kvdb;
        }


        /**
         * 判断是否为当前板块或者全站所有版主中的一个版主
         * @param        $ip
         * @param string $falg
         *
         * @return mixed
         */
        public function isModerator($ip, $falg = 'form')
        {
            if ($falg == 'form') {
                $key = "Moderator.{$this->siteInfo[0]}.{$ip}.{$this->siteInfo[1]}";
                return $this->kvdb->get($key);
            } elseif ($falg == 'site') {
                $key = "Moderator.{$this->siteInfo[0]}.{$ip}";
                return $this->kvdb->pkrget($key);
            } else {
                return false;
            }
        }

        /**
         * 往kvdb里面加入版主信息
         * @param $ip
         *
         * @return mixed
         */
        public function addModeratorIp($ip)
        {
            $key    = "Moderator.{$this->siteInfo[0]}.{$ip}.{$this->siteInfo[1]}";
            $value  = '1';
            return $this->kvdb->add($key, $value);
        }

        /**
         * 分割传递回来的图片名称 duowan.1234.23232.jpg
         * @param string $img
         *
         * @return array
         */
        public function spliteImg($img = '')
        {
            $img = explode('.', $img);
            if (count($img) == 4) {
                array_pop($img);
                $this->siteInfo = $img;
                return true;
            }
            return false;

        }

    }

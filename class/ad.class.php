<?php
    /**
     * Author: WenJun
     * Date:   2013-01-12 下午2:59
     * Email:  wenjun1055@gmail.com
     *
     * File:   ad.class.php
     * Desc:   控制广告的投放
     */
    class Ad
    {

        /**
         * @var string
         */
        private $prefix = 'Ad.';

        /**
         * @var string
         */
        private $statusPrefix = 'AdStatus.';

        /**
         * @var Resource
         */
        private $kvbd;

        /**
         * @var string
         */
        private $ad;

        public function __construct(Kvdb $kvdb)
        {
            $this->kvbd = $kvdb;
        }

        /**
         * 根据来路域名板块信息投放广告
         * @param array $site
         *
         * @return bool
         */
        public function adSelect(array $site)
        {
            if ($site) {
                $key = $this->prefix . $site[0];
                $ad  = $this->kvbd->get($key);
                if ($ad) {
                    $this->ad = explode(';', $ad);
                    return TRUE;
                }
            }
            return FALSE;
        }

        /**
         * 随机选择一个广告显示
         */
        public function adSender()
        {
            $adNum = count($this->ad);
            header("Location:" . $this->ad[rand(0, ($adNum - 1))]);
            //header("Location:http://zhende.me/100x100");
            //echo "我是广告！<br>";
        }

        /**
         * 增加广告配置
         * @param string $site
         * @param string $ad
         *
         * @return bool
         */
        public function addAd($site = '', $ad = '')
        {
            $key = $this->prefix . $site;
            return $this->kvbd->add($key, $ad);
        }

        /**
         * 打开某个站点的广告
         * @param string $site
         */
        public function openAd($site = '')
        {
            $this->handleAd($site, 1);
        }

        /**
         * 关闭某个站点的广告
         * @param string $site
         */
        public function closeAd($site = '')
        {
            $this->handleAd($site, 0);
        }

        /**
         * 获取当前站点广告的状态
         * @param string $site
         *
         * @return mixed
         */
        public function getAdStatus($site = '')
        {
            return $this->handleAd($site);
        }

        /**
         * 操作当前的站点的广告
         * @param string $site
         * @param string $value
         *
         * @return mixed
         */
        private function handleAd($site = '', $value = null)
        {
            $key = $this->statusPrefix . $site;
            if (isset($value)) {
                if (!$this->kvbd->get($key)) {
                    if (!$this->kvbd->replace($key, $value)) {
                        $this->kvbd->add($key, $value);
                    }
                }
            } else {
                return $this->kvbd->get($key);
            }
        }
    }

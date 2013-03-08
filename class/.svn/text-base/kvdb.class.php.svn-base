<?php
    /**
     * Author: WenJun
     * Date:   2013-01-10 下午10:06
     * Email:  wenjun1055@gmail.com
     *
     * File:   kvdb.class.php
     * nosql缓存
     */
    class Kvdb
    {
        /**
         * @var Resource
         */
        private $kvdb;

        /**
         * construct
         */
        public function __construct()
        {
            $this->kvdb = new SaeKV();
            $this->kvdb->init();
        }

        /**
         * 根绝key获得值
         * @param string $key
         *
         * @return mixed
         */
        public function get($key = '')
        {
            return $this->kvdb->get($key);
        }

        /**
         * 往缓存中加入值
         * @param string $key
         * @param string $value
         *
         * @return mixed
         */
        public function add($key = '', $value = '')
        {
            return $this->kvdb->add($key, $value);
        }

        /**
         * 替换当前key所对应的值
         * @param string $key
         * @param string $value
         */
        public function replace($key = '', $value = '')
        {
            return $this->kvdb->replace($key, $value);
        }

        /**
         * 删除键值对
         * @param string $key
         *
         * @return mixed
         */
        public function delete($key = '')
        {
            return $this->kvdb->delete($key);
        }

        /**
         * 按照前缀查找20个值
         * @param string $prefix
         * @param int    $count
         *
         * @return mixed
         */
        public function pkrget($prefix = '', $count = 20)
        {
            return $this->kvdb->pkrget($prefix, $count);
        }
    }

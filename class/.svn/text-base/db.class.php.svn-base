<?php
    /**
     * Author: WenJun
     * Date:   2013-01-10 下午10:47
     * Email:  wenjun1055@gmail.com
     *
     * File:   db.class.php
     * Desc:   数据库操作
     */
    class Db
    {
        const
        /**
         * @var PDO
         */
        private $db;

        /**
         * construct
         */
        public function __construct()
        {
            $this->db = new PDO('mysql:host='.DB_HOST.':'.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASS);
        }

        /**
         * 往数据库插入数据
         * @param string $param
         *
         * @return bool
         */
        public function insert($sql = '')
        {
            return $this->query($sql);
        }

        /**
         * 获取数据
         * @param string $sql
         *
         * @return bool|PDOStatement
         */
        public function get($sql = '')
        {
            if ($sql) {
                return $this->db->query($sql)
                                 ->setFetchMode(PDO::FETCH_ASSOC)
                                 ->fetchAll();
            }
            return FALSE;
        }

        /**
         * 更新数据
         * @param string $sql
         *
         * @return bool
         */
        public function update($sql = '')
        {
            return $this->query($sql);
        }

        /**
         * 删除数据
         * @param string $sql
         *
         * @return bool
         */
        public function delete($sql = '')
        {
            return $this->query($sql);
        }

        /**
         * 执行sql语句
         * @param string $sql
         *
         * @return bool|int
         */
        private function query($sql = '')
        {
            if ($sql) {
                return $this->db->exec($sql);
            }
            return FALSE;
        }
    }

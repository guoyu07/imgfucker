<?php
    /**
     * Author: WenJun
     * Date:   2013-01-12 下午10:10
     * Email:  wenjun1055@gmail.com
     *
     * File:   record.class.php
     * Desc:    做来访者的记录
     */
    class Record
    {
        /**
         * @var string
         */
        private $numPrefix = 'LogofUserCurrentNum.';

        /**
         * @var string
         */
        private $logPrefox = 'LogofUser.';

        /**
         * @var string
         */
        private $lastTimePrefix = 'LogofLastUserTime.';

        /**
         * kvdb对象
         * @var Object
         */
        private $kvdb;

        public function __construct(Kvdb $kvdb)
        {
            $this->kvdb  = $kvdb;
        }

        private function getCurrentNum($site, $form, $tid)
        {
            $keyNum = $this->numPrefix . $site . '.' . $form . '.' . $tid;
            return $this->kvdb->get($keyNum);
        }

        public function recoder($siteInfo, $ip)
        {
            $site = $siteInfo[0];
            $form = $siteInfo[1];
            $tid  = $siteInfo[2];
            $num = $this->getCurrentNum($site, $form, $tid);
            $keyTime = $this->lastTimePrefix . $site . '.' . $form . '.' . $tid;
            if ($num) {
                if ($num == 20) {
                    // 第20个记录的时候
                    $keyLog = $this->logPrefox . $site . '.' . $form . '.' . $tid . '.1';
                    $keyNum = $this->numPrefix . $site . '.' . $form . '.' . $tid;
                    $this->kvdb->replace($keyLog, $ip);
                    $this->kvdb->replace($keyNum, '1');
                    $this->kvdb->replace($keyTime, time());
                } else {
                    $num++;
                    $keyLog = $this->logPrefox . $site . '.' . $form . '.' . $tid . '.' . $num;
                    $keyNum = $this->numPrefix . $site . '.' . $form . '.' . $tid;
                    if ($this->kvdb->get($keyLog)) {
                        $this->kvdb->replace($keyLog, $ip);
                        $this->kvdb->replace($keyNum, $num);
                        $this->kvdb->replace($keyTime, time());
                    } else {
                        $this->kvdb->add($keyLog, $ip);
                        $this->kvdb->replace($keyNum, $num);
                        $this->kvdb->replace($keyTime, time());
                    }

                }
            } else {
                //TODO $num=false 没有记录的时候
                $keyLog  = $this->logPrefox . $site . '.' . $form . '.' . $tid . '.1';
                $keyNum  = $this->numPrefix . $site . '.' . $form . '.' . $tid;
                $this->kvdb->add($keyLog, $ip);
                $this->kvdb->add($keyNum, '1');
                $this->kvdb->add($keyTime, time());
            }
        }


    }

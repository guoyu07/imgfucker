<?php
    /**
     * Author: WenJun
     * Date:   2013-01-10 下午9:56
     * Email:  wenjun1055@gmail.com
     *
     * File:  index.php
     * 外链图片的链接
     */

    require_once 'class/refer.class.php';
    require_once 'class/moderator.class.php';
    require_once 'class/kvdb.class.php';
    require_once 'class/ad.class.php';
    require_once 'class/record.class.php';
    require_once 'config.php';

    if ($_GET['img']) {
        $refer      = new Refer();
        $ip         = $refer->getIp();
        $referUrl   = $refer->getRefer();
        if ($refer->getUserAgent() && $ip && $referUrl) {
            //根据$_GET['img']判断用户来自哪个论坛的某个版块，再根据IP判断是否为版主
            $moderator = new Moderator(new Kvdb());
            //分解图片名称成功
            if ($moderator->spliteImg($_GET['img'])) {
                $ad = new Ad(new Kvdb());
                if ($ad->getAdStatus($moderator->siteInfo[0])) {
                    //判断当前IP用户是否为当前板块的版主
                    if (!$moderator->isModerator($ip)) {
                        //不是当前板块的版主
                        if ($ad->adSelect($moderator->siteInfo)) {
                            $record = new Record(new Kvdb());
                            $record->recoder($moderator->siteInfo, $ip);
                            $ad->adSender();
                            exit();
                        }
                    }
                }
            }
        }
    }
    //echo "1像素<br>";
    header("Location:http://zhende.me/50x50");